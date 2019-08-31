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

namespace Wanglelecc\Laracms\Observers;

use Wanglelecc\Laracms\Models\WechatMenu;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

/**
 * 微信菜单观察者
 *
 * Class WechatMenuObserver
 * @package Wanglelecc\Laracms\Observers
 */
class WechatMenuObserver
{
    public function creating(WechatMenu $wechat_menu)
    {
        //
    }

    public function updating(WechatMenu $wechat_menu)
    {
        //
    }

    public function saving(WechatMenu $wechat_menu){
        if(is_array($wechat_menu->data) || is_object($wechat_menu->data)){
            $wechat_menu->data = json_encode($wechat_menu->data, JSON_UNESCAPED_UNICODE);
        }

        $wechat_menu->order || $wechat_menu->order = 999;
    }
}