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

/**
 * 后台菜单工具类
 *
 * Class AdministratorMenuHandler
 * @package Wanglelecc\Laracms\Handlers
 */
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

    /**
     * 遍历子菜单
     *
     * @param $menus
     * @param $menuId
     * @return array|mixed
     */
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

    /**
     * 过滤有权限显示的菜单
     *
     * @param $menus
     * @return array
     */
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