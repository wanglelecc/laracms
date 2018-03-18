<?php

namespace App\Models;

class Category extends Model
{
    protected $table = 'categorys';
    protected $fillable = ['id','name', 'keywords', 'description', 'parent', 'order', 'path', 'type', 'link', 'template', ];

    public function articles(){
        return $this->belongsToMany(
            'App\Models\Article',
            'article_category',
            'category_id',
            'article_id'
        );
    }
}