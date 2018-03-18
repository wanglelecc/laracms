<?php
/**
 * Created by PhpStorm.
 * User: lele.wang
 * Date: 2018/2/4
 * Time: 10:43
 */

namespace App\Models\Traits;

use Carbon\Carbon;
use Cache;
use DB;

trait WithOrderHelper
{
    public function scopeRecent($query, $sortOrder = 'desc')
    {
        return $query->orderBy('id', $sortOrder);
    }

    public function scopeOrdered($query, $sortOrder = 'desc')
    {
        return $query->orderBy('order', $sortOrder);
    }

    public function scopeWithOrder($query, $sortField, $sortOrder)
    {
        $sortField = empty($sortField) ? 'updated_at' : $sortField;
        $sortOrder = in_array($sortOrder, ['asc','desc']) ? 'desc' : $sortOrder;

        return $query->orderBy($sortField, $sortOrder);
    }

}
