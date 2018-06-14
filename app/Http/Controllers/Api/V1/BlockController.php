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

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Transformers\BlockTransformer;
use App\Models\Block;

/**
 * 区块控制器
 *
 * Class BlockController
 * @package App\Http\Controllers\Api\V1
 */
class BlockController extends Controller
{
    /**
     * 详情
     *
     * @param int $block_id
     * @return \Dingo\Api\Http\Response
     */
    public function show($block_id = 0)
    {
        $block = get_block($block_id);
        if( !$block ){ abort(404); }
        return $this->response->item($block, new BlockTransformer());
    }
}
