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

use Wanglelecc\Laracms\Models\File;
use Illuminate\Support\Facades\Auth;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

/**
 * 文件观察者
 *
 * Class FileObserver
 * @package Wanglelecc\Laracms\Observers
 */
class FileObserver
{
    public function creating(File $file)
    {
        $file->status = '0';
        $file->created_op || $file->created_op = Auth::id();
    }

    public function updating(File $file)
    {
    }

    public function saving(File $file){

    }
}