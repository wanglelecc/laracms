<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use App\Events\BehaviorLogEvent;

class Link extends Model
{
    protected $fillable = ['id','name', 'description', 'url', 'order', 'rating', 'image', 'target', 'rel', 'status'];

    public function getImage(){
        return $this->image ? Storage::url($this->image) : config('app.url') . '/images/pic-none.png';
    }

    public $dispatchesEvents  = [
        'saved' => BehaviorLogEvent::class,
    ];

    public function titleName(){
        return 'name';
    }
}
