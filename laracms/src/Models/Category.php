<?php
/**
 * LaraCMS - CMS based on laravel
 *
 * @category  LaraCMS
 * @package   Laravel
 * @author    Wanglelecc <wanglelecc@gmail.com>
 * @date      2018/06/06 09:08:00
 * @copyright Copyright 2018 LaraCMS
 * @license   https://opensource.org/licenses/MIT
 * @github    https://github.com/wanglelecc/laracms
 * @link      https://www.laracms.cn
 * @version   Release 1.0
 */

namespace Wanglelecc\Laracms\Models;

use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 分类模型
 *
 * Class Category
 * @package Wanglelecc\Laracms\Models
 */
class Category extends Model
{
    use SoftDeletes;
    
    protected $table = 'categorys';
    protected $fillable = ['id','name', 'keywords', 'description', 'parent', 'order', 'path', 'type', 'link', 'template', ];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    public function articles(){
        return $this->belongsToMany(
            'Wanglelecc\Laracms\Models\Article',
            'article_category',
            'category_id',
            'article_id'
        );
    }
    
    /**
     * 检查是否允许删除
     */
    public function isDestroy(){
        
        // 1. 检查导航中是否已使用
        $navigations = Navigation::whereIn('type', ['article', 'category'])->get();
        foreach($navigations as $navigation){
            $params = is_json($navigation->params) ? json_decode($navigation->params) : new \stdClass;
            if( $this->id == $params->category_id ){
                return '导航已使用，无法删除！'; // 找到已使用，不允许删除
            }
        }
        
        // 2. 检查区块中是否已使用
        $blocks = Block::whereIn('type', ['latestArticle', 'hotArticle','latestProduct','hotProduct',])->get();
        foreach($blocks as $block){
            $params = is_json($block->params) ? json_decode($block->params) : new \stdClass;
            if( $this->id == get_value($params,'category_id', 0) ){
                return '区块已使用，无法删除！'; // 找到已使用，不允许删除
            }
        }
        
        // 3. 检查是否有子分类
        $count = static::where('parent',$this->id)->count();
        if($count > 0){
            return '当前分类下有子分类，无法删除！'; // 找到已使用，不允许删除
        }
        
        // 4. 检查分类下是否有文章
        $count = DB::table('article_category')->where('category_id',$this->id)->count();
        if($count > 0){
            return '当前分类下有内容，无法删除！'; // 找到已使用，不允许删除
        }
        
        return true; // 未被使用.可以删除
    }

    /**
     *
     * @param string $template
     * @return string
     */
    public function getTemplate( $template = 'index' ){
        if($this->template){
            $template = $template . '-' . strtolower($this->template);
        }

        return $template;
    }
    
    /**
     * 删除缓存
     *
     * @param        $id
     * @param string $type
     *
     * @return bool
     */
    public static function clearCache($id, $type = 'article'){
        $id      = intval($id);
        $type    = strtolower($type);
    
        $key = $type.'_category_active_cache_'.$id;
    
        \Cache::forget($key);
    
        return true;
    }

    /**
     * 前台获取分类详情
     *
     * @param $id
     * @param string $type
     * @return mixed
     */
    public static function show($id, $type = 'article' ){

        $id      = intval($id);
        $type    = strtolower($type);

        $key = $type.'_category_active_cache_'.$id;
        $category = \Cache::get($key);

        if( \App::environment('production') && $category ){
            return $category;
        }

        $category = static::where('id', $id)->where('type', $type)->first();

        if(\App::environment('production')){
            $expiredAt = now()->addMinutes(config('cache.expired.category', 10));
            \Cache::put($key, $category, $expiredAt);
        }

        return $category;
    }
}