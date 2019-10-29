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

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class SeedRolesAndPermissionsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 清除缓存
        app()['cache']->forget('spatie.permission.cache');

        // 先创建权限
        Permission::create(['name' => 'manage_develop', 'remarks'=> '系统开发']);
        Permission::create(['name' => 'manage_log', 'remarks'=> '操作日志']);
        Permission::create(['name' => 'manage_system', 'remarks'=> '系统管理']);
        Permission::create(['name' => 'manage_users', 'remarks'=> '用户管理']);
        Permission::create(['name' => 'manage_permissions', 'remarks'=> '权限管理']);
        Permission::create(['name' => 'manage_roles', 'remarks'=> '角色管理']);
        Permission::create(['name' => 'manage_setting', 'remarks'=> '系统设置']);
        Permission::create(['name' => 'manage_site_basic', 'remarks'=> '站点信息']);
        Permission::create(['name' => 'manage_site_company', 'remarks'=> '公司信息']);
        Permission::create(['name' => 'manage_site_contact', 'remarks'=> '联系方式']);
        Permission::create(['name' => 'manage_links', 'remarks'=> '友情链接']);
        Permission::create(['name' => 'manage_navigation', 'remarks'=> '栏目导航']);
        Permission::create(['name' => 'manage_wechat', 'remarks'=> '微信管理']);
        Permission::create(['name' => 'manage_content', 'remarks'=> '内容管理']);
        Permission::create(['name' => 'manage_category', 'remarks'=> '分类管理']);
        Permission::create(['name' => 'manage_article', 'remarks'=> '文章管理']);
        Permission::create(['name' => 'manage_page', 'remarks'=> '页面管理']);
        Permission::create(['name' => 'manage_images', 'remarks'=> '图片管理']);
        Permission::create(['name' => 'manage_slide', 'remarks'=> '幻灯管理']);
        Permission::create(['name' => 'manage_block', 'remarks'=> '区块管理']);
        Permission::create(['name' => 'manage_annex', 'remarks'=> '附件管理']);
        Permission::create(['name' => 'manage_xcx', 'remarks'=> '小程序管理']);
        Permission::create(['name' => 'manage_media', 'remarks'=> '媒体管理']);
        Permission::create(['name' => 'manage_form', 'remarks'=> '表单管理']);

        // 创建超级管理角色，并赋予权限
        $administrator = Role::create(['name' => 'Administrator', 'remarks'=> '超级管理员']);
        $administrator->givePermissionTo('manage_develop');
        $administrator->givePermissionTo('manage_log');
        $administrator->givePermissionTo('manage_system');
        $administrator->givePermissionTo('manage_users');
        $administrator->givePermissionTo('manage_permissions');
        $administrator->givePermissionTo('manage_roles');
        $administrator->givePermissionTo('manage_setting');
        $administrator->givePermissionTo('manage_site_basic');
        $administrator->givePermissionTo('manage_site_company');
        $administrator->givePermissionTo('manage_site_contact');
        $administrator->givePermissionTo('manage_links');
        $administrator->givePermissionTo('manage_navigation');
        $administrator->givePermissionTo('manage_wechat');
        $administrator->givePermissionTo('manage_content');
        $administrator->givePermissionTo('manage_category');
        $administrator->givePermissionTo('manage_article');
        $administrator->givePermissionTo('manage_page');
        $administrator->givePermissionTo('manage_images');
        $administrator->givePermissionTo('manage_slide');
        $administrator->givePermissionTo('manage_block');
        $administrator->givePermissionTo('manage_annex');
        $administrator->givePermissionTo('manage_xcx');
        $administrator->givePermissionTo('manage_media');
        $administrator->givePermissionTo('manage_form');

        // 创建站长角色，并赋予权限
        $founder = Role::create(['name' => 'Founder', 'remarks'=> '创始人']);
        $founder->givePermissionTo('manage_log');
        $founder->givePermissionTo('manage_system');
        $founder->givePermissionTo('manage_users');
        $founder->givePermissionTo('manage_permissions');
        $founder->givePermissionTo('manage_setting');
        $founder->givePermissionTo('manage_article');
        $founder->givePermissionTo('manage_page');
        $founder->givePermissionTo('manage_slide');
        $founder->givePermissionTo('manage_block');
        $founder->givePermissionTo('manage_annex');
        $founder->givePermissionTo('manage_wechat');
        $founder->givePermissionTo('manage_xcx');
        $founder->givePermissionTo('manage_media');
        $founder->givePermissionTo('manage_form');

        // 创建管理员角色，并赋予权限
        $maintainer = Role::create(['name' => 'Maintainer', 'remarks'=> '站长']);
        $maintainer->givePermissionTo('manage_system');
        $maintainer->givePermissionTo('manage_users');
        $maintainer->givePermissionTo('manage_setting');
        $maintainer->givePermissionTo('manage_article');
        $maintainer->givePermissionTo('manage_page');
        $maintainer->givePermissionTo('manage_slide');
        $maintainer->givePermissionTo('manage_block');
        $maintainer->givePermissionTo('manage_annex');
        $maintainer->givePermissionTo('manage_form');
    
        // 创建管理员账户
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@56br.com',
            'status' => '1',
            'password' => bcrypt('123456'),
            'avatar' => 'images/avatar/201803/04/9CT3XvX0Jcv8QEEzPCzgg8k0NXJVwrMsaKKf1iN9.jpeg',
        ]);
        
        // 指派管理员角色
        $user->assignRole('Administrator');
        $user->save();
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 清除缓存
        app()['cache']->forget('spatie.permission.cache');

        // 清空所有数据表数据
        $tableNames = config('permission.table_names');
        Model::unguard();
        DB::table($tableNames['role_has_permissions'])->delete();
        DB::table($tableNames['model_has_roles'])->delete();
        DB::table($tableNames['model_has_permissions'])->delete();
        DB::table($tableNames['roles'])->delete();
        DB::table($tableNames['permissions'])->delete();
        User::query()->delete();
        Model::reguard();
    }
}
