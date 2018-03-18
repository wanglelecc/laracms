<?php

namespace App\Models;

class File extends Model
{
    protected $fillable = ['id','type', 'path', 'mime_type', 'md5', 'title', 'folder', 'object_id', 'size', 'width', 'height', 'downloads', 'public', 'editor', 'status', 'created_op'];
}
