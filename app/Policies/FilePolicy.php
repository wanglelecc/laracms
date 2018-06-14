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
use App\Models\File;

/**
 * 文件授权策略
 *
 * Class FilePolicy
 * @package App\Policies
 */
class FilePolicy extends Policy
{
    public function index(User $user, File $file)
    {
        return true;
    }

    public function update(User $user, File $file)
    {
        // return $file->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, File $file)
    {
        return true;
    }
}
