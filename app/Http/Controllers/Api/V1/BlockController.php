<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Transformers\BlockTransformer;
use App\Models\Block;

class BlockController extends Controller
{
    public function show($block_id = 0)
    {
        $block = get_block($block_id);
        if( !$block ){ abort(404); }
        return $this->response->item($block, new BlockTransformer());
    }
}
