<?php
/**
 * LaraCMS - CMS based on laravel
 *
 * @category  LaraCMS
 * @package   Laravel
 * @author    Wanglelecc <wanglelecc@gmail.com>
 * @date      2018/06/06 09:08:00
 * @copyright Copyright 2018 LaraCMS
 * @license   https://opensource.org/licenses/MIT
 * @github    https://github.com/wanglelecc/laracms
 * @link      https://www.laracms.cn
 * @version   Release 1.0
 */

namespace App\Handlers;
use App\Http\Requests\Request;
use App\Models\WechatMenu;
use App\Models\Wechat;
use App\Models\WechatResponse;
use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

/**
 * 微信文本消息处理
 *
 * Class TextMessageHandler
 * @package App\Handlers
 */
class TextMessageHandler
{

    public function handle(Wechat $wechat, $message = []){
        return $this->text($wechat,$message['Content']);
    }

    /**
     * 文本响应处理
     *
     * @param Wechat $wechat
     * @param $key
     * @return null
     */
    protected function text(Wechat $wechat, $key){
        $response = WechatResponse::where('wechat_id',$wechat->id)->where('key', $key)->first();

        return $response ? $response->handle() : WechatResponse::defaultResponse($wechat->id);
    }


}