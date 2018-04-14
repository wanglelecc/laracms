<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use App\Events\BehaviorLogEvent;


class Navigation extends Model
{
//    protected $table = 'navigations';
    protected $fillable = ['id','category', 'type', 'title', 'description', 'target', 'link', 'image', 'icon', 'parent', 'path', 'params', 'order', 'is_show'];

    public $dispatchesEvents  = [
        'saved' => BehaviorLogEvent::class,
    ];

    public function titleName(){
        return 'title';
    }

    public function getImage(){
        return $this->image ? Storage::url($this->image) : config('app.url') . '/images/pic-none.png';
    }
}