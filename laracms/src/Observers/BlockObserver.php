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

use Wanglelecc\Laracms\Models\Block;
use Illuminate\Support\Facades\Auth;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

/**
 * 区块观察者
 *
 * Class BlockObserver
 * @package Wanglelecc\Laracms\Observers
 */
class BlockObserver
{
    public function creating(Block $block)
    {
        $block->object_id || $block->object_id = create_object_id();
        $block->created_op || $block->created_op = Auth::id();
        $block->updated_op || $block->updated_op = Auth::id();
    }

    public function updating(Block $block)
    {
        $block->updated_op = Auth::id();
    }
    
    public function updated(Block $block){
        Block::clearCache($block->object_id);
    }

    public function saving(Block $block){
        if(is_array($block->content) || is_object($block->content)){
            $block->content = json_encode($block->content, JSON_UNESCAPED_UNICODE);
        }
    }
}