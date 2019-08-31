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

namespace Wanglelecc\Laracms\Handlers;

use Wanglelecc\Laracms\Http\Requests\Request;
use Wanglelecc\Laracms\Models\Navigation;
use Wanglelecc\Laracms\Models\Page;

/**
 * 导航处理工具类
 *
 * Class NavigationHandler
 * @package Wanglelecc\Laracms\Handlers
 */
class NavigationHandler
{

    /**
     * 处理分类层级关系
     *
     * @param $navigations
     * @param int $parent
     * @param int $lavel
     * @return array
     */
    public function level($navigations, $parent = 0, $lavel = 0)
    {
        $newNavigations = [];
        foreach($navigations as $navigation){
            if($navigation->parent == $parent){
                $navigation->lavel = $lavel;
                $navigation->is_end = 0;
                $newNavigations[] = $navigation;

                if($tmpNavigations = call_user_func_array([$this, __FUNCTION__],[$navigations, $navigation->id, ($lavel+1) ])){
                    $newNavigations = !empty($newNavigations) ? array_merge($newNavigations, $tmpNavigations) : $tmpNavigations;
                }
            }
        }

        return $newNavigations;
    }

    /**
     * 过滤分类给 Select 控件使用
     *
     * @param $navigations
     * @param int $parent
     * @param null $parentName
     * @return array
     */
    public function select($navigations, $parent = 0, $parentName = null)
    {
        static $newNavigations = [];
        foreach($navigations as $navigation){
            if($navigation->parent == $parent){
                $navigation->parentName = $parentName ? ($parentName . ' / ' . $navigation->title) : $navigation->title;
                $newNavigations[$navigation->id] = $navigation->parentName;
                call_user_func_array([$this, __FUNCTION__],[$navigations, $navigation->id, $navigation->parentName ]);
            }
        }

        return $newNavigations;
    }

    /**
     * 获取分类数据
     *
     * @param string $category
     * @return mixed
     */
    public function getNavigations($category = 'desktop'){

        $key = 'navigation_cache_'.$category;

        $navigation = \Cache::get($key);

        if( \App::environment('production') && $navigation ){
            return $navigation;
        }

        $navigation = app(Navigation::class)->ordered()->recent('asc')->where('category','=', $category)->where('is_show', '=', '1')->get();

        if(\App::environment('production')){
            $expiredAt = now()->addMinutes(config('cache.expired.navigation', 10));
            \Cache::put($key, $navigation, $expiredAt);
        }

        return $navigation;
    }

    /**
     * 获取页面列表
     * @return mixed
     */
    public function getPageList(){
        return app(Page::class)->ordered()->recent()->where('status','=', '1')->get()->pluck('title','id')->toArray();
    }

    /**
     * 前台页面获取显示菜单(过滤隐藏)
     *
     * @param string $category
     * @return array
     */
    public function frontend($category = 'desktop'){
        return $this->withRecursion($this->filterNav($this->getNavigations($category)));
    }

    /**
     * 前台页面获取显示菜单(完整，包含隐藏)
     *
     * @param string $category
     * @return array
     */
    public function completeFrontend($category = 'desktop'){
        return $this->withRecursion($this->getNavigations($category));
    }

    /**
     * 获取当前兄弟导航及子导航
     *
     * @param string $category
     * @param boolean $showOneLevel 是否显示一级导航，默认不显示
     * @return array
     */
    public function getCurrentBrothersAndChildNavigation($category = 'desktop', $showOneLevel = false){
        $navigation = $this->getNavigationFind(request('navigation',0));
        $parent = $navigation->parent ?? 0;
        return $parent == 0 && $showOneLevel == false ? [] : $this->withRecursion($this->getNavigations($category), $parent ?? 0);
    }

    /**
     * 获取当前导航下的子导航
     *
     * @param string $category
     * @return array|null
     */
    public function getCurrentChildNavigation($category = 'desktop'){
        return ($navigation = request('navigation',0)) > 0 ? $this->withRecursion($this->getNavigations($category), $navigation) : [];
    }

    /**
     * 获取面包屑
     *
     * @return array
     */
    public function breadcrumb(){
        $breadcrumb = [];
        $navigation = $this->getNavigationFind(request('navigation',0));
        if(!$navigation){  return $breadcrumb; } // 默认首页

        $path = $navigation->path ?? '0';
        if($path == '0'){ return $breadcrumb = [$navigation]; } // 当前为一级栏目直接返回

        $pathArray = explode('-', $path);
        foreach(Navigation::whereIn('id',$pathArray)->get() as $item){
            $key = array_search($item->id, $pathArray);
            $breadcrumb[$key] = $item;
        }

        // 加入当前导航
        $breadcrumb[] = $navigation;

        return $breadcrumb;
    }

    /**
     * 获取单个导航缓存
     *
     * @param $id
     * @return mixed
     */
    protected function getNavigationFind($id){

        if(intval($id) < 1){
            return null;
        }

        $key = 'navigation_item_cache_'.$id;

        $navigation = \Cache::get($key);

        if( \App::environment('production') && $navigation ){
            return $navigation;
        }

        $navigation = Navigation::find($id);

        if(\App::environment('production')){
            $expiredAt = now()->addMinutes(config('cache.expired.navigation', 10));
            \Cache::put($key, $navigation, $expiredAt);
        }

        return $navigation;
    }

    /**
     * 过滤导航数据
     */
    protected function filterNav($navigations){
        $navigations->filter(function ($value, $key){
            return $value->is_show == 1;
        });

        return $navigations->all();
    }

    /**
     * 递归处理导航菜单
     *
     * @param $navigations
     * @param int $parent
     * @return array
     */
    protected function withRecursion($navigations, $parent = 0){
        $newNavigations = [];
        foreach($navigations as $navigation){
            if($navigation->parent == $parent){
                $navigation->child = call_user_func_array([$this, __FUNCTION__],[$navigations, $navigation->id ]);
                $newNavigations[] = $navigation;
            }
        }

        return $newNavigations;
    }

    /**
     * 生成URl
     *
     * @param Navigation $navigation
     * @return string
     */
    public function createUrl(Navigation $navigation){
        $url = '';
        $params = is_json($navigation->params) ? json_decode($navigation->params) : new \stdClass;
        switch (strtolower($navigation->type)){
            case 'link':
                $url = $params->link ?? '';
                break;
            case 'action':
                $args = [
                    $params->route,
                    [$navigation->id],
                    false
                ];

                if(is_json($params->params) && !empty($routeParams = json_decode($params->params, true))){
                    $args[1] = array_merge($args[1], $routeParams);
                }

                $url = route(...$args);
                break;
            case 'article':
                $url = route('article.index',[$navigation->id, $params->category_id], false);
                break;
            case 'category':
                $url = route('category.index',[$navigation->id, $params->category_id], false);
                break;
            case 'page':
                $url = route('page.show',[$navigation->id, $params->page_id], false);
                break;
            case 'navigation':
                $url = $params->link ?? '';
                break;
        }

        return $url;
    }


}