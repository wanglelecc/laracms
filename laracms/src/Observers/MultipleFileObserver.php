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

use Wanglelecc\Laracms\Models\MultipleFile;
use Illuminate\Support\Facades\Auth;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

/**
 * 区块观察者
 *
 * Class BlockObserver
 * @package Wanglelecc\Laracms\Observers
 */
class MultipleFileObserver
{
    public function creating(MultipleFile $multipleFile)
    {
        /**
         * 修正多文件排序初始值
         */
        if($multipleFile->order < 1){
            $order = MultipleFile::where('multiple_file_table_id',$multipleFile->multiple_file_table_id)
                ->where('multiple_file_table_type', $multipleFile->multiple_file_table_type)
                ->where('field', $multipleFile->field)
                ->count()
            ;
            
            $multipleFile->order = $order;
        }
    }

    
}