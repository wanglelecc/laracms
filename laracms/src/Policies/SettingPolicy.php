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
use Wanglelecc\Laracms\Models\Setting;

/**
 * 设置授权策略
 *
 * Class SettingPolicy
 * @package Wanglelecc\Laracms\Policies
 */
class SettingPolicy extends Policy
{

    public function basic(User $user, Setting $setting)
    {
        return $user->can("manage_site_basic");
    }

    public function company(User $user, Setting $setting)
    {
        return $user->can("manage_site_company");
    }

    public function contact(User $user, Setting $setting)
    {
        return $user->can("manage_site_contact");
    }
}
