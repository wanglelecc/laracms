<?php

namespace App\Models;

class Navigation extends Model
{
//    protected $table = 'navigations';
    protected $fillable = ['id','category', 'type', 'title', 'description', 'target', 'link', 'image', 'icon', 'parent', 'path', 'params', 'order', 'is_show'];

}