<?php

namespace App\Models;

class Block extends Model
{
    protected $fillable = ['id','type', 'object_id', 'title', 'template', 'icon', 'more_title', 'more_link', 'content','created_op','updated_op'];

    public function getRouteKeyName()
    {
        return 'id';
        return 'object_id';
    }
}
