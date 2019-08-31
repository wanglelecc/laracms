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

namespace Wanglelecc\Laracms\Models\Traits;

use Carbon\Carbon;
use Cache;
use DB;

/**
 * 模型公共排序方法
 *
 * Trait WithOrderHelper
 * @package Wanglelecc\Laracms\Models\Traits
 */
trait WithOrderHelper
{
    /**
     * 追加排序条件
     *
     * @param $query
     * @param string $sortOrder
     * @return mixed
     */
    public function scopeRecent($query, $sortOrder = 'desc')
    {
        return $query->orderBy('id', $sortOrder);
    }

    /**
     * 追加排序条件
     *
     * @param $query
     * @param string $sortOrder
     * @return mixed
     */
    public function scopeOrdered($query, $sortOrder = 'desc')
    {
        return $query->orderBy('order', $sortOrder);
    }

    /**
     * 追加排序条件
     *
     * @param $query
     * @param $sortField
     * @param $sortOrder
     * @return mixed
     */
    public function scopeWithOrder($query, $sortField, $sortOrder)
    {
        $sortField = empty($sortField) ? 'updated_at' : $sortField;
        $sortOrder = in_array($sortOrder, ['asc','desc']) ? 'desc' : $sortOrder;

        return $query->orderBy($sortField, $sortOrder);
    }

}
