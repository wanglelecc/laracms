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

namespace Wanglelecc\Laracms\Handlers;

use Wanglelecc\Laracms\Http\Requests\Request;
use Wanglelecc\Laracms\Models\WechatMenu;
use Wanglelecc\Laracms\Models\WechatResponse;
use EasyWeChat\Kernel\Contracts\EventHandlerInterface;
use Wanglelecc\Laracms\Models\Wechat;

/**
 * 微信事件消息处理
 *
 * Class EventMessageHandler
 * @package Wanglelecc\Laracms\Handlers
 */
class EventMessageHandler
{

    public function handle(Wechat $wechat, $message = []){
        switch ($message['Event']) {
            // 订阅
            case 'subscribe':
                return $this->subscribe($wechat);
                break;

            // 取消订阅
            case 'unsubscribe':
                return $this->unsubscribe($wechat);
                break;

            case 'CLICK':
                return $this->event($wechat, $message['EventKey']);
                break;

            case 'voice':
                return '收到语音消息';
                break;
            case 'video':
                return '收到视频消息';
                break;
            case 'location':
                return '收到坐标消息';
                break;
            case 'link':
                return '收到链接消息';
                break;
            // ... 其它消息
            default:
                return '收到其它消息';
                break;
        }
    }


    /**
     * 订阅响应处理
     *
     * @param Wechat $wechat
     * @return null
     */
    protected function subscribe(Wechat $wechat){
        $response = WechatResponse::where('wechat_id',$wechat->id)->where('key', 'subscribe')->first();

        return $response ? $response->handle() : null;
    }

    /**
     * 取消订阅
     *
     * @param Wechat $wechat
     */
    protected function unsubscribe(Wechat $wechat){

    }

    /**
     * 自定义事件
     *
     * @param Wechat $wechat
     * @param $eventKey
     * @return null
     */
    protected function event(Wechat $wechat, $eventKey){
        $mid = substr($eventKey, strrpos($eventKey, '_')+1);
        $response = WechatMenu::where('id', $mid)->where('group',$wechat->id)->first();

        return $response ? $response->handle() : null;
    }

}