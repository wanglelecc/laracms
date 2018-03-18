<?php
/**
 * Created by PhpStorm.
 * User: lele.wang
 * Date: 2018/3/9
 * Time: 0:26
 */

namespace App\Transformers;

use Spatie\Permission\Models\Permission;
use League\Fractal\TransformerAbstract;

class PermissionTransformer extends TransformerAbstract
{
    public function transform(Permission $permission)
    {
        return [
            'id' => $permission->id,
            'name' => $permission->name,
        ];
    }
}