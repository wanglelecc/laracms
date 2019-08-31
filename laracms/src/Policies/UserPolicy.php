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
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * 用户授权策略
 *
 * Class UserPolicy
 * @package Wanglelecc\Laracms\Policies
 */
class UserPolicy extends Policy
{
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // $currentUser 当前登录用户，不用手动传入
    public function update(User $currentUser, User $user)
    {
        return $currentUser->can('manage_users') || $currentUser->id === $user->id;
    }

    public function manage(User $currentUser, User $user){
        return $currentUser->can('manage_users');
    }

    public function create(User $currentUser, User $user){
        return $currentUser->can('manage_users');
    }

    public function destroy(User $currentUser, User $user){
        // 系统创始人和当前登录用户禁止删除
        if($currentUser->id === $user->id || $user->id === 1){
            return false;
        }
        return $currentUser->can('manage_users');
    }

}
