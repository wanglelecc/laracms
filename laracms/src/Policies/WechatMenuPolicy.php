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

namespace Wanglelecc\Laracms\Policies;

use Wanglelecc\Laracms\Models\User;
use Wanglelecc\Laracms\Models\WechatMenu;

/**
 * 微信菜单授权策略
 *
 * Class WechatMenuPolicy
 * @package Wanglelecc\Laracms\Policies
 */
class WechatMenuPolicy extends Policy
{
    public function update(User $user, WechatMenu $wechat_menu)
    {
        return $user->can("manage_wechat");
    }

    public function destroy(User $user, WechatMenu $wechat_menu)
    {
        return $user->can("manage_wechat");
    }
}
