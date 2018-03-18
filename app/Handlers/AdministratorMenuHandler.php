<?php
/**
 * Created by PhpStorm.
 * User: lele.wang
 * Date: 2018/2/1
 * Time: 16:24
 */
namespace App\Handlers;

class AdministratorMenuHandler
{
    static $administratorMenu = [];

    /**
     * 获取后台菜单
     * @return array
     */
    public function getAdministratorMenu(){
        if(empty(static::$administratorMenu)){
            static::$administratorMenu = $this->filterPermissionWith(config('administrator.menu'));
        }

        return static::$administratorMenu;
    }

    /**
     * 获取后台当前子菜单
     *
     * @return array
     */
    public function getChildrenAdministratorMenu($menuId){
        return $this->filterChildrenAdministratorMenuWith($this->getAdministratorMenu(), $menuId);
    }
//
//    protected function filterWith($menu)
//    {
//
//    }

    protected function filterChildrenAdministratorMenuWith($menus,$menuId)
    {
        foreach($menus as $menu){
            if($menu['id'] == $menuId){
                return isset($menu['children']) ? $menu['children'] : [];
            }else{
                return isset($menu['children']) && is_array($menu['children'])
                    ? call_user_func_array([$this, __FUNCTION__], [$menu['children'], $menuId]) : [];
            }
        }
        
        return [];
    }

    protected function filterPermissionWith($menus){
        $newMenu = [];
        foreach($menus as $menu){
            $permission = call_user_func($menu['permission']);
            if($permission == true){
                if(!empty($menu['children'])){
                    $menu['children'] = call_user_func_array([$this, __FUNCTION__], [$menu['children']]);
                }else{
                    $menu['children'] = [];
                }
                $newMenu[] = $menu;
            }
        }
        return $newMenu;

    }



}