<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

class Slide extends Model
{
    protected $fillable = ['id','object_id', 'group', 'title', 'description', 'trage', 'link', 'image', 'order', 'status'];

    public function getImage(){
        return $this->image ? Storage::url($this->image) : config('app.url') . '/images/pic-none.png';
    }

}
