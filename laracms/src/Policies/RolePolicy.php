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
use Spatie\Permission\Models\Role;

/**
 * 角色授权策略
 *
 * Class RolePolicy
 * @package Wanglelecc\Laracms\Policies
 */
class RolePolicy extends Policy
{

    public function index(User $user, Role $role)
    {
        return $user->can("manage_roles");
    }

    public function manage(User $user, Role $role)
    {
        return $user->can("manage_roles");
    }

    public function create(User $user, Role $role)
    {
        return $user->can("manage_roles");
    }

    public function update(User $user, Role $role)
    {
        return $user->can("manage_roles");
    }

    public function destroy(User $user, Role $role)
    {
        return $user->can("manage_roles");
    }
}
