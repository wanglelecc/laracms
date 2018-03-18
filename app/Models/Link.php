<?php

namespace App\Models;

class Link extends Model
{
    protected $fillable = ['id','name', 'description', 'url', 'order', 'rating', 'image', 'target', 'rel', 'status'];
}
