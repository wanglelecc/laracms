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

namespace App\Policies;

use App\Models\User;
use App\Models\Block;

/**
 * 区块授权策略
 *
 * Class BlockPolicy
 * @package App\Policies
 */
class BlockPolicy extends Policy
{

    public function index(User $user, Block $block)
    {
        return $user->can('manage_block');
    }

    public function create(User $user, Block $block)
    {
        return false;
//        return $user->can('manage_develop');
    }

    public function update(User $user, Block $block)
    {
        return $user->can('manage_block');
    }

    public function destroy(User $user, Block $block)
    {
        return false;
//        return $user->can('manage_develop');
    }
}
