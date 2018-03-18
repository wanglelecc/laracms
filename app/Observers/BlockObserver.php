<?php

namespace App\Observers;

use App\Models\Block;
use Illuminate\Support\Facades\Auth;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

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

    public function saving(Block $block){
        if(is_array($block->content) || is_object($block->content)){
            $block->content = json_encode($block->content, JSON_UNESCAPED_UNICODE);
        }
    }
}