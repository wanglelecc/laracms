<?php
/**
 * Created by PhpStorm.
 * User: lele.wang
 * Date: 2018/2/4
 * Time: 10:43
 */

namespace App\Models\Traits;

use Carbon\Carbon;
use Cache;
use DB;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;


trait WithCommonHelper
{

    public function getTemplate($category = 0){
        $template = 'show';

        if($this->template){
            $template = $template . '-' . strtolower($this->template);
        }else if( $category && ($category = Category::find($category)) && $category->template ){
            $template = $template . '-' . strtolower($category->template);
        }

        return $template;
    }

    public function getAuthor(){
        return $this->author ?? '管理员';
    }

    public function getDate(){
        return $this->created_at->diffForHumans();
    }

    public function getThumb(){
        return $this->thumb ? Storage::url($this->thumb) : config('app.url') . '/images/pic-none.png';
    }

    public function scopeValid(){
        return $this->where('status','1');
    }
}
