<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Models\Wechat;
use EasyWeChat\Kernel\Messages\Message;
use EasyWeChat\Kernel\Messages\Transfer;
use App\Handlers\TextMessageHandler;
use App\Handlers\EventMessageHandler;

class WeChatController extends Controller
{

    /**
     * 处理微信的请求消息
     *
     * @param Wechat $safeWechat
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\BadRequestException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function serve(Wechat $safeWechat)
    {
        #Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        # $app = app('wechat.official_account');
        $app = $safeWechat->app();

//        $app->server->push(function ($message) {
//            return "您好！欢迎使用 EasyWeChat!";
//        });


        $app->server->push(function($message) use ($safeWechat){
            return app(EventMessageHandler::class)->handle($safeWechat, $message);
        }, Message::EVENT);

        $app->server->push(function($message) use ($safeWechat){
            return app(TextMessageHandler::class)->handle($safeWechat, $message);
        }, Message::TEXT);

        // 转发收到的消息给客服
        $app->server->push(function($message) {
            return new Transfer();
        });

        return $app->server->serve();
    }
}
