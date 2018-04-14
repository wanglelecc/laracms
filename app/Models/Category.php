<?php

namespace App\Models;

use App\Events\BehaviorLogEvent;

class Category extends Model
{
    protected $table = 'categorys';
    protected $fillable = ['id','name', 'keywords', 'description', 'parent', 'order', 'path', 'type', 'link', 'template', ];

//    public $dispatchesEvents  = [
//        'saved' => BehaviorLogEvent::class,
//    ];
//
//    public function titleName(){
//        return 'name';
//    }

    public function articles(){
        return $this->belongsToMany(
            'App\Models\Article',
            'article_category',
            'category_id',
            'article_id'
        );
    }
}