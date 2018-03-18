<?php
namespace App\Transformers;

use App\Models\Block;
use League\Fractal\TransformerAbstract;

class BlockTransformer extends TransformerAbstract
{
    public function transform(Block $block)
    {
        return [
            'id' => $block->id,
            'object_id' => $block->object_id,
            'group' => $block->group,
            'type' => $block->type,
            'title' => $block->title,
            'icon' => $block->icon,
            'data' => $block->data,
            'more_title' => $block->more_title,
            'more_link' => $block->more_link,
            'content' => is_json($block->content) ? json_decode($block->content) : $block->content,
            'created_at' => $block->created_at->toDateTimeString(),
            'updated_at' => $block->updated_at->toDateTimeString(),
        ];
    }

}