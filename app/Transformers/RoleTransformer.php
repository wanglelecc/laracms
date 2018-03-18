<?php
/**
 * Created by PhpStorm.
 * User: lele.wang
 * Date: 2018/3/9
 * Time: 0:28
 */
namespace App\Transformers;

use Spatie\Permission\Models\Role;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{
    public function transform(Role $role)
    {
        return [
            'id' => $role->id,
            'name' => $role->name,
        ];
    }
}