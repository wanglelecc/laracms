<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\WithCommonHelper;

class Article extends Model
{
    use WithCommonHelper;

    protected $fillable = [
         'id','object_id', 'alias','title', 'subtitle', 'keywords', 'description', 'author', 'source', 'order', 'content', 'thumb', 'type', 'is_link','link', 'template', 'status', 'views', 'weight', 'css', 'js', 'top', 'created_op', 'updated_op',
    ];

    public function created_user(){
        return $this->belongsTo('App\Models\User', 'created_op');
    }

    public function updated_user(){
        return $this->belongsTo('App\Models\User', 'updated_op');
    }

    public function filterWith($type = 'type'){
        return $this->where('type','article')->with(['created_user','updated_user']);
    }

    // 多对多多态关联
    public function category(): MorphToMany
    {
        return $this->morphToMany(
            'App\Models\Category',
            'model',
            'model_has_category',
            'model_id',
            'category_id'
        );
    }

    // 多对多
    public function categorys(): BelongsToMany
    {
        return $this->belongsToMany(
            'App\Models\Category',
            'article_category',
            'article_id',
            'category_id'
        );
    }

    public function giveCategoryTo(...$categorys)
    {
        $categorys = collect($categorys)
            ->flatten()
            ->map(function ($category) {
                return $this->getStoredCategory($category);
            })
            ->each(function ($category) {
                $this->ensureModelSharesArticle($category);
            })
            ->all();

//        $this->category()->saveMany($categorys);
        $this->categorys()->saveMany($categorys);

        return $this;
    }


    public function syncCategory(...$categorys)
    {
//        $this->category()->detach();
        $this->categorys()->detach();

        return $this->giveCategoryTo($categorys);
    }

    protected function getStoredCategory($categorys)
    {
        if (is_string($categorys) || is_int($categorys)) {
            return app(Category::class)->find(intval($categorys));
        }

        if (is_array($categorys)) {
            return app(Category::class)
                ->whereIn('id', $categorys)
                ->get();
        }

        return $categorys;
    }

    protected function ensureModelSharesArticle($category)
    {
        if (! $category) {
            abort(401);
        }
    }

    /**
     * 生成文章链接
     *
     * @param int $navigation_id
     * @param int $category_id
     * @return string
     */
    public function getLink($navigation_id = 0, $category_id = 0){
        if($this->is_link == 1 && !empty($this->link)){
            return $this->link;
        }
        return route('article.show',[$navigation_id, $category_id, $this->id]);
    }

}
