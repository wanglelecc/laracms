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

use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * 授权策略基类
 *
 * Class Policy
 * @package Wanglelecc\Laracms\Policies
 */
class Policy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function before($user, $ability)
	{
	    // if ($user->isSuperAdmin()) {
	    // 		return true;
	    // }
	}
}
