<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        Permission::create(['name' => 'manage_setting', 'remarks'=> '系统设置']);
        Permission::create(['name' => 'manage_article', 'remarks'=> '文章管理']);
        Permission::create(['name' => 'manage_page', 'remarks'=> '页面管理']);
        Permission::create(['name' => 'manage_slide', 'remarks'=> '幻灯管理']);
        Permission::create(['name' => 'manage_block', 'remarks'=> '区块管理']);
        Permission::create(['name' => 'manage_annex', 'remarks'=> '附件管理']);
        Permission::create(['name' => 'manage_wechat', 'remarks'=> '公众号管理']);
        Permission::create(['name' => 'manage_xcx', 'remarks'=> '小程序管理']);

        // 创建超级管理角色，并赋予权限
        $administrator = Role::create(['name' => 'Administrator', 'remarks'=> '超级管理员']);
        $administrator->givePermissionTo('manage_develop');
        $administrator->givePermissionTo('manage_log');
        $administrator->givePermissionTo('manage_system');
        $administrator->givePermissionTo('manage_users');
        $administrator->givePermissionTo('manage_permissions');
        $administrator->givePermissionTo('manage_setting');
        $administrator->givePermissionTo('manage_article');
        $administrator->givePermissionTo('manage_page');
        $administrator->givePermissionTo('manage_slide');
        $administrator->givePermissionTo('manage_block');
        $administrator->givePermissionTo('manage_annex');
        $administrator->givePermissionTo('manage_wechat');
        $administrator->givePermissionTo('manage_xcx');

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
        Model::reguard();
    }
}
