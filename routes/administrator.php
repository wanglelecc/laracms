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

/*
|--------------------------------------------------------------------------
| Administrator Routes
|--------------------------------------------------------------------------
|
| 管理后台相关路由定义
|
*/

/*
 * -------------------------------------------------------------------------
 * 后台不需要需要认证相关路由
 * -------------------------------------------------------------------------
 */
Route::group(['domain' => config('administrator.domain'), 'prefix' => config('administrator.uri'), 'namespace' => 'Administrator', 'middleware' => [], ], function () {

    # 登录
    Route::get('login', 'LoginController@showLoginForm')->name('administrator.login');
    Route::post('login', 'LoginController@login');

    # 退出
    Route::get('logout', 'LoginController@logout')->name('administrator.logout');

    # 无权限提示
    Route::get('permission-denied', 'WelcomeController@permissionDenied')->name('administrator.permission-denied');

});

/*
 * -------------------------------------------------------------------------
 * 后台需要认证相关路由
 * -------------------------------------------------------------------------
 */
Route::group(['domain' => config('administrator.domain'), 'prefix' => config('administrator.uri'), 'namespace' => 'Administrator', 'middleware' => ['auth'], ], function () {

    # 首页
    Route::get('/', 'WelcomeController@dashboard')->name('administrator.dashboard');

    # 站点设置相关路由
    Route::get('site/basic','SiteController@basic')->name('administrator.site.basic');
    Route::post('site/basic','SiteController@basicStore');
    Route::get('site/company','SiteController@company')->name('administrator.site.company');
    Route::post('site/company','SiteController@companyStore');
    Route::get('site/contact','SiteController@contact')->name('administrator.site.contact');
    Route::post('site/contact','SiteController@contactStore');

    # 用户相关路由
    Route::resource('user', 'UserController', ['only' => ['password', 'avatar', 'update', 'edit', 'destroy']]);
    Route::get('user/{user}/password', 'UserController@showPasswordForm')->name('administrator.password.edit');
    Route::put('user/password/{user}', 'UserController@passwordRequestForm')->name('administrator.password.update');
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
    Route::get('users/{user}/password', 'UsersController@showPasswordForm')->name('administrator.users.password.edit');
    Route::put('users/password/{user}', 'UsersController@passwordRequestForm')->name('administrator.users.password.update');

    # 角色相关路由
    Route::resource('roles', 'RolesController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

    # 权限相关路由
    Route::resource('permissions', 'PermissionsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

    # 友情链接相关路由
    Route::resource('links', 'LinksController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

    # 幻灯片相关路由
    Route::resource('slides', 'SlidesController', ['only' => ['index', 'show', 'store', 'update', 'edit', 'destroy']]);
    Route::get('slides/{group}/manage', 'SlidesController@manage')->name('slides.manage');
    Route::get('slides/{group}/create', 'SlidesController@create')->name('slides.create');

    # 分类相关路由
    Route::get('categorys/{type}','CategorysController@index')->name('administrator.category.index');
    Route::post('categorys/{type}','CategorysController@store')->name('administrator.category.store');
    Route::get('categorys/create/{type}/{parent}','CategorysController@create')->name('administrator.category.create');
    Route::get('categorys/{category}/{type}','CategorysController@show')->name('administrator.category.show');
    Route::get('categorys/{category}/edit/{type}','CategorysController@edit')->name('administrator.category.edit');
    Route::put('categorys/{type}/order','CategorysController@order')->name('administrator.category.order');
    Route::put('categorys/{category}/{type}','CategorysController@update')->name('administrator.category.update');
    Route::delete('categorys/{category}/{type}','CategorysController@destroy')->name('administrator.category.destroy');

    # 导航相关路由
    Route::get('navigations/{category}','NavigationsController@index')->name('administrator.navigation.index');
    Route::post('navigations/{category}','NavigationsController@store')->name('administrator.navigation.store');
    Route::get('navigations/create/{category}/{parent}','NavigationsController@create')->name('administrator.navigation.create');
    Route::get('navigations/{navigation}/{category}','NavigationsController@show')->name('administrator.navigation.show');
    Route::get('navigations/{navigation}/edit/{category}','NavigationsController@edit')->name('administrator.navigation.edit');
    Route::put('navigations/{category}/order','NavigationsController@order')->name('administrator.navigation.order');
    Route::put('navigations/{navigation}/{category}','NavigationsController@update')->name('administrator.navigation.update');
    Route::delete('navigations/{navigation}/{category}','NavigationsController@destroy')->name('administrator.navigation.destroy');

    # 单页面相关路由
    Route::resource('pages', 'PagesController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

    # 文章相关路由
    Route::put('articles/order','ArticlesController@order')->name('articles.order');
    Route::resource('articles', 'ArticlesController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

    # 区块相关路由
    Route::resource('blocks', 'BlocksController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

    # 微信公众号相关路由
    Route::put('wechats/order','WechatsController@order')->name('wechats.order');
    Route::get('wechats/{wechat}/integrate','WechatsController@integrate')->name('wechats.integrate');
    Route::resource('wechats', 'WechatsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

    # 微信菜单相关路由
    Route::get('wechat_menus/{wechat}','WechatMenusController@index')->name('wechat_menus.index');
    Route::post('wechat_menus/{wechat}','WechatMenusController@store')->name('wechat_menus.store');
    Route::get('wechat_menus/create/{wechat}/{parent}','WechatMenusController@create')->name('wechat_menus.create');
    Route::get('wechat_menus/{wechat_menu}/{wechat}','WechatMenusController@show')->name('wechat_menus.show');
    Route::get('wechat_menus/{wechat_menu}/edit/{wechat}','WechatMenusController@edit')->name('wechat_menus.edit');
    Route::put('wechat_menus/{wechat}/order','WechatMenusController@order')->name('wechat_menus.order');
    Route::put('wechat_menus/{wechat_menu}/{wechat}','WechatMenusController@update')->name('wechat_menus.update');
    Route::delete('wechat_menus/{wechat_menu}/{wechat}','WechatMenusController@destroy')->name('wechat_menus.destroy');
    Route::post('wechat_menus/sync/{wechat}','WechatMenusController@synchronizeWechatServer')->name('wechat_menus.sync');

    # 微信自定义响应相关路由
    Route::get('wechat_response/{wechat}','WechatResponseController@index')->name('wechat_response.index');
    Route::post('wechat_response/{wechat}','WechatResponseController@store')->name('wechat_response.store');
    Route::get('wechat_response/create/{wechat}/{parent}','WechatResponseController@create')->name('wechat_response.create');
    Route::get('wechat_response/{wechat_response}/{wechat}','WechatResponseController@show')->name('wechat_response.show');
    Route::get('wechat_response/{wechat_response}/edit/{wechat}','WechatResponseController@edit')->name('wechat_response.edit');
    Route::put('wechat_response/{wechat}/order','WechatResponseController@order')->name('wechat_response.order');
    Route::put('wechat_response/{wechat_response}/{wechat}','WechatResponseController@update')->name('wechat_response.update');
    Route::delete('wechat_response/{wechat_response}/{wechat}','WechatResponseController@destroy')->name('wechat_response.destroy');
    Route::get('wechat_response/set_response/{wechat}/{group}','WechatResponseController@setResponse')->name('wechat_response.set_response.create');
    Route::post('wechat_response/set_response/{wechat}/{group}','WechatResponseController@setResponseStore')->name('wechat_response.set_response.store');

    # Laravel 日志
    Route::get('log/laravel', 'LogViewerController@laravel')->name('log.laravel');

    # 任务日志
    Route::get('log/jobs', 'LogViewerController@jobs')->name('log.jobs');

    # 队列日志
    Route::get('log/queue', 'LogViewerController@queue')->name('log.queue');

    # 用户行为日志
    Route::get('log/behavior', 'LogViewerController@behavior')->name('log.behavior');

    # 业务日志
    Route::get('log/business', 'LogViewerController@business')->name('log.business');

    # 媒体库管理
    Route::get('media/image', 'MediaController@image')->name('media.image');

});