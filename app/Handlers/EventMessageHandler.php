<?php
/**
 * Created by PhpStorm.
 * User: lele.wang
 * Date: 2018/1/31
 * Time: 23:03
 */

namespace App\Handlers;
use App\Http\Requests\Request;
use App\Models\WechatMenu;
use App\Models\WechatResponse;
use EasyWeChat\Kernel\Contracts\EventHandlerInterface;
use App\Models\Wechat;

/**
 * 事件消息处理
 *
 * Class EventMessageHandler
 * @package App\Handlers
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