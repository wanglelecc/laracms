<?php

namespace App\Models;
use App\Models\Traits\WithCommonHelper;

class Page extends Model
{
    use WithCommonHelper;

    public $table = 'articles';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'id', 'object_id', 'alias','title', 'subtitle', 'keywords', 'description', 'author', 'source', 'order', 'content', 'thumb', 'type', 'is_link','link', 'template', 'status', 'views', 'weight', 'css', 'js', 'top', 'created_op', 'updated_op',
    ];

//    public function hasOneCategory(){
//        return $this->hasOne('App\Models\Category', 'id', 'category_id');
//    }

    public function created_user(){
        return $this->belongsTo('App\Models\User', 'created_op');
    }

    public function updated_user(){
        return $this->belongsTo('App\Models\User', 'updated_op');
    }

    public function filterWith(){
        return $this->where('type','page')->with(['created_user','updated_user']);
    }

    /**
     * 生成单页面URL
     *
     * @param int $navigation_id
     * @return string
     */
    public function getLink($navigation_id = 0){
        if($this->is_link == 1 && !empty($this->link)){
            return $this->link;
        }
        return route('page.show',[$navigation_id, $this->id]);
    }

}
