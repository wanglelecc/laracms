<?php
/**
 * Created by PhpStorm.
 * User: lele.wang
 * Date: 2018/1/31
 * Time: 23:03
 */

namespace App\Handlers;
use App\Models\Category;

class CategoryHandler
{

    /**
     * 处理分类层级关系
     *
     * @param $categorys
     * @param int $parent
     * @param int $lavel
     * @return array
     */
    public function level($categorys, $parent = 0, $lavel = 0)
    {
        $newCategorys = [];
        $len = count($categorys) - 1;
        foreach($categorys as $key => $category){
            if($category->parent == $parent){
                $category->lavel = $lavel;
                $category->is_end = 0;
                $newCategorys[] = $category;

                if($tmpCategorys = call_user_func_array([$this, __FUNCTION__],[$categorys, $category->id, ($lavel+1) ])){

                    $newCategorys = !empty($newCategorys) ? array_merge($newCategorys, $tmpCategorys) : $tmpCategorys;
                }

            }
        }

        if($newCategorys){
            $tmpCategory = $newCategorys[count($newCategorys)-1];
            $tmpCategory->is_end = 1;
            $newCategorys[count($newCategorys)-1] = $tmpCategory;
        }


        return $newCategorys;
    }

    /**
     * 过滤并处理分类给前端使用
     *
     * @param $categorys
     * @param array $sCategory
     * @return array
     */
    public function web($categorys, $sCategory = []){
        $newCategory = [];
        foreach($categorys as $category){
            $newCategory[] = [
                'id' => $category->id,
                'name' => $category->name,
                'lavel' => $category->lavel,
                'check' => in_array($category->id, $sCategory)
            ];
        }

        return $newCategory;
    }

    /**
     * 过滤分类给 Select 控件使用
     *
     * @param $categorys
     * @param int $parent
     * @param null $parentName
     * @return array
     */
    public function select($categorys, $parent = 0, $parentName = null)
    {
        static $newCategorys = [];
        foreach($categorys as $category){
            if($category->parent == $parent){
                $category->parentName = $parentName ? ($parentName . ' / ' . $category->name) : $category->name;
                $newCategorys[$category->id] = $category->parentName;
                call_user_func_array([$this, __FUNCTION__],[$categorys, $category->id, $category->parentName ]);
            }
        }

        return $newCategorys;
    }

    /**
     * 获取分类数据
     *
     * @param string $type
     * @return mixed
     */
    public function getCategorys($type = 'article'){
        return app(Category::class)->ordered()->recent('asc')->where('type','=', $type)->paginate();
    }

    /**
     * 递归处理分类
     *
     * @param $categorys
     * @param int $parent
     * @return array
     */
    public function withRecursion($categorys, $parent = 0){
        $newCategorys = [];
        foreach($categorys as $category){
            if($category->parent == $parent){
                $category->child = call_user_func_array([$this, __FUNCTION__],[$categorys, $category->id ]);
                $newCategorys[] = $category;
            }
        }

        return $newCategorys;
    }

}