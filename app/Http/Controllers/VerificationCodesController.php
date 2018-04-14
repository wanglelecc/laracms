<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\VerificationCodeRequest;
use Overtrue\EasySms\EasySms;


class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request, EasySms $easySms)
    {
        $key = 'verificationCode_' . $request->phone;
        $captchaData = \Cache::get($key);

        $mobileSmsSendData = \Cache::remember('mobileSmsSendData_' . trim($request->phone), now()->addDays(0), function() use ($request){
            return [
                'phone' => $request->phone,
                'count' => 0,
            ];
        });

        if($mobileSmsSendData['count'] >= 3){
            return $this->response->error('已达上限,请稍后再试.', 422);
        }

        if (!app()->environment('production')) {
            $code = '123456';
            $phone = $request->phone;
        } elseif( $captchaData ){
            $code = $captchaData['code'];
            $phone = $captchaData['phone'];
        } else {
            // 生成4位随机数，左侧补0
            $code = str_pad(random_int(1, 999999), 6, 0, STR_PAD_LEFT);
            $phone = trim($request->phone);

            try {
                $result = $easySms->send($phone, [
                    'content' => "【LaraCMS】您的验证码是{$code}。如非本人操作，请忽略本短信。"
                ]);
                $mobileSmsSendData['count'] = $mobileSmsSendData['count'] + 1;
            } catch (\GuzzleHttp\Exception\ClientException $exception) {
                $response = $exception->getResponse();
                $result = json_decode($response->getBody()->getContents(), true);
                return $this->response->errorInternal($result['msg'] ?? '短信发送异常');
            }
        }

        $key = 'verificationCode_' . $phone;
        $expiredAt = now()->addMinutes(10);
        // 缓存验证码 10分钟过期。
        \Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);
        \Cache::put('mobileSmsSendData_' . $phone, $mobileSmsSendData, now()->addDays(0));

        return $this->response->array([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
            'status' => 0,
            'msg' => 'success',
        ])->setStatusCode(201);
    }
}
