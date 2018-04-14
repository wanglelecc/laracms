<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// 前台所有URL必须加入 navigation 参数,否则面包屑无法正常使用
// 站点首页
Route::get('/', 'WelcomeController@index')->name('welcome');
// 栏目聚合页
Route::get('category/index_{navigation}_{articleCategory}.html', 'ArticleController@category')->name('category.index');
// 文章列表页
Route::get('article/list_{navigation}_{articleCategory}.html', 'ArticleController@index')->name('article.index');
// 文章详情页
Route::get('article/show_{navigation}_{category}_{safeArticle}.html', 'ArticleController@show')->name('article.show');
// 页面详情页
Route::get('page/show_{navigation}_{safePage}.html', 'PageController@show')->name('page.show');
// 在线留言
Route::get('message/index_{navigation}.html', 'WelcomeController@message')->name('message.index');
// 关于我们
Route::get('company/index_{navigation}.html', 'WelcomeController@company')->name('company.index');
// 搜索页面
Route::get('search', 'SearchController@index')->name('search');

//Auth::routes();

// 前台认证相关路由
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('user/home/{user}', 'UserController@home')->name('user.home');
Route::get('login/{type}', 'Auth\LoginController@redirectToProvider')->name('oauth.login');
Route::get('login/{type}/callback', 'Auth\LoginController@handleProviderCallback')->name('oauth.login.callback');
Route::post('verificationCodes', 'VerificationCodesController@store')->name('verificationCodes.store');

Route::get('wll',function(){
    return $tomorrow = now()->addDays(0);
});

// 前台需要用户认证路由
Route::group(['middleware' => ['auth']], function(){
     Route::post('logout', 'Auth\LoginController@logout')->name('logout');
     Route::get('login/{type}/unbind', 'Auth\LoginController@unbind')->name('oauth.login.unbind');

     Route::get('user/index', 'UserController@index')->name('user.index');
     Route::get('user/settings{type?}', 'UserController@settings')->name('user.settings');
     Route::get('user/messages', 'UserController@messages')->name('user.messages');
     Route::get('user/activate', 'UserController@activate')->name('user.activate');

    // 短信验证码
     Route::patch('user/update_info', 'UserController@updateInfo')->name('user.update_info');
     Route::patch('user/update_avatar', 'UserController@updateAvatar')->name('user.update_avatar');
     Route::patch('user/update_password', 'UserController@updatePassword')->name('user.update_password');

     Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);

});

// =========== 后台相关路由 ==================
Route::group(['domain' => config('administrator.domain'), 'prefix' => config('administrator.uri'), 'namespace' => 'Administrator', 'middleware' => [], ], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('administrator.login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('administrator.logout');
    Route::get('permission-denied', 'WelcomeController@permissionDenied')->name('administrator.permission-denied');
});

Route::group(['domain' => config('administrator.domain'), 'prefix' => config('administrator.uri'), 'namespace' => 'Administrator', 'middleware' => ['auth'], ], function () {
    Route::get('/', 'WelcomeController@dashboard')->name('administrator.dashboard');

    // 站点设置相关路由
    Route::get('site/basic','SiteController@basic')->name('administrator.site.basic');
    Route::post('site/basic','SiteController@basicStore');
    Route::get('site/company','SiteController@company')->name('administrator.site.company');
    Route::post('site/company','SiteController@companyStore');
    Route::get('site/contact','SiteController@contact')->name('administrator.site.contact');
    Route::post('site/contact','SiteController@contactStore');

    // 用户相关路由
    Route::resource('user', 'UserController', ['only' => ['password', 'avatar', 'update', 'edit', 'destroy']]);
    Route::get('user/{user}/password', 'UserController@showPasswordForm')->name('administrator.password.edit');
    Route::put('user/password/{user}', 'UserController@passwordRequestForm')->name('administrator.password.update');
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
    Route::get('users/{user}/password', 'UsersController@showPasswordForm')->name('administrator.users.password.edit');
    Route::put('users/password/{user}', 'UsersController@passwordRequestForm')->name('administrator.users.password.update');

    Route::resource('roles', 'RolesController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
    Route::resource('permissions', 'PermissionsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
    Route::resource('links', 'LinksController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
    Route::resource('slides', 'SlidesController', ['only' => ['index', 'show', 'store', 'update', 'edit', 'destroy']]);
    Route::get('slides/{group}/manage', 'SlidesController@manage')->name('slides.manage');
    Route::get('slides/{group}/create', 'SlidesController@create')->name('slides.create');

    # 分类
    Route::get('categorys/{type}','CategorysController@index')->name('administrator.category.index');
    Route::post('categorys/{type}','CategorysController@store')->name('administrator.category.store');
    Route::get('categorys/create/{type}/{parent}','CategorysController@create')->name('administrator.category.create');
    Route::get('categorys/{category}/{type}','CategorysController@show')->name('administrator.category.show');
    Route::get('categorys/{category}/edit/{type}','CategorysController@edit')->name('administrator.category.edit');
    Route::put('categorys/{type}/order','CategorysController@order')->name('administrator.category.order');
    Route::put('categorys/{category}/{type}','CategorysController@update')->name('administrator.category.update');
    Route::delete('categorys/{category}/{type}','CategorysController@destroy')->name('administrator.category.destroy');


    // 导航相关路由
    Route::get('navigations/{category}','NavigationsController@index')->name('administrator.navigation.index');
    Route::post('navigations/{category}','NavigationsController@store')->name('administrator.navigation.store');
    Route::get('navigations/create/{category}/{parent}','NavigationsController@create')->name('administrator.navigation.create');
    Route::get('navigations/{navigation}/{category}','NavigationsController@show')->name('administrator.navigation.show');
    Route::get('navigations/{navigation}/edit/{category}','NavigationsController@edit')->name('administrator.navigation.edit');
    Route::put('navigations/{category}/order','NavigationsController@order')->name('administrator.navigation.order');
    Route::put('navigations/{navigation}/{category}','NavigationsController@update')->name('administrator.navigation.update');
    Route::delete('navigations/{navigation}/{category}','NavigationsController@destroy')->name('administrator.navigation.destroy');

    // 微信公众号相关路由
    Route::put('wechats/order','WechatsController@order')->name('wechats.order');
    Route::get('wechats/{wechat}/integrate','WechatsController@integrate')->name('wechats.integrate');
    Route::resource('wechats', 'WechatsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

    Route::get('wechat_menus/{wechat}','WechatMenusController@index')->name('wechat_menus.index');
    Route::post('wechat_menus/{wechat}','WechatMenusController@store')->name('wechat_menus.store');
    Route::get('wechat_menus/create/{wechat}/{parent}','WechatMenusController@create')->name('wechat_menus.create');
    Route::get('wechat_menus/{wechat_menu}/{wechat}','WechatMenusController@show')->name('wechat_menus.show');
    Route::get('wechat_menus/{wechat_menu}/edit/{wechat}','WechatMenusController@edit')->name('wechat_menus.edit');
    Route::put('wechat_menus/{wechat}/order','WechatMenusController@order')->name('wechat_menus.order');
    Route::put('wechat_menus/{wechat_menu}/{wechat}','WechatMenusController@update')->name('wechat_menus.update');
    Route::delete('wechat_menus/{wechat_menu}/{wechat}','WechatMenusController@destroy')->name('wechat_menus.destroy');
    Route::post('wechat_menus/sync/{wechat}','WechatMenusController@synchronizeWechatServer')->name('wechat_menus.sync');
//    Route::resource('wechat_menus', 'WechatMenusController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

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


    Route::resource('pages', 'PagesController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
    Route::put('articles/order','ArticlesController@order')->name('articles.order');
    Route::resource('articles', 'ArticlesController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);


    Route::resource('blocks', 'BlocksController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

    # Laravel日志
    Route::get('log/laravel', 'LogViewerController@laravel')->name('log.laravel');
    # 任务日志
    Route::get('log/jobs', 'LogViewerController@jobs')->name('log.jobs');
    # 队列日志
    Route::get('log/queue', 'LogViewerController@queue')->name('log.queue');
    # 用户行为日志
    Route::get('log/behavior', 'LogViewerController@behavior')->name('log.behavior');
    # 业务日志
    Route::get('log/business', 'LogViewerController@business')->name('log.business');

});

// 文件上传相关路由
Route::post('upload/image', 'UploadController@image')->name('upload.image');
//Route::resource('projects', 'ProjectsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::resource('projects', 'ProjectsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
// 微信路由
Route::any('wechat/{safeWechat}.html', 'WeChatController@serve')->name('wechat.api');