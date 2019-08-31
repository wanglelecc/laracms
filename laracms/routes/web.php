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
| Web Routes
|--------------------------------------------------------------------------
|
| 前台相关路由
|
*/
Route::group([ 'middleware' => ['laracms.frontend'], ], function () {
    # 前台所有URL必须加入 navigation 参数,否则面包屑无法正常使用
    # 站点首页
    Route::get('/', 'WelcomeController@index')->name('welcome');
    Route::get('index.html', 'WelcomeController@index')->name('index');

    # 栏目聚合页
    Route::get('category/show_{navigation}_{articleCategory}.html', 'ArticleController@category')->name('category.index');

    # 文章列表页
    Route::get('article/list_{navigation}_{articleCategory}.html', 'ArticleController@index')->name('article.index');

    # 文章详情页
    Route::get('article/show_{navigation}_{category}_{safeArticle}.html', 'ArticleController@show')->name('article.show');

    # 页面详情页
    Route::get('page/show_{navigation}_{safePage}.html', 'PageController@show')->name('page.show');

    # 在线留言
    Route::get('message/show_{navigation}.html', 'WelcomeController@message')->name('message.index');

    # 关于我们
    Route::get('company/show_{navigation}.html', 'WelcomeController@company')->name('company.index');

    # 站点地图
    Route::get('map/show_{navigation}.html', 'WelcomeController@map')->name('map.index');
    
    # 自定义表单
    Route::get('form/show_{navigation}_{type}.html', 'FormController@index')->name('form.index');
    Route::post('form/{type}.html', 'FormController@store')->name('form.store');

    # 搜索页面
    Route::get('search', 'SearchController@index')->name('search');

    # 前台认证相关路由
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

    # 前台需要用户认证路由
    Route::group(['middleware' => ['auth']], function(){

        # 退出
        Route::get('logout', 'Auth\LoginController@logout')->name('logout');
        Route::get('login/{type}/unbind', 'Auth\LoginController@unbind')->name('oauth.login.unbind');

        # 用户中心
        Route::get('user/index', 'UserController@index')->name('user.index');
        Route::get('user/settings{type?}', 'UserController@settings')->name('user.settings');
        Route::get('user/messages', 'UserController@messages')->name('user.messages');
        Route::get('user/activate', 'UserController@activate')->name('user.activate');

        # 短信验证码
        Route::patch('user/update_info', 'UserController@updateInfo')->name('user.update_info');
        Route::patch('user/update_avatar', 'UserController@updateAvatar')->name('user.update_avatar');
        Route::patch('user/update_password', 'UserController@updatePassword')->name('user.update_password');

        # 回复
        Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);

    });

});

# 文件上传相关路由
Route::post('uploader', 'UploadController@uploader')->name('uploader');

# 阿里云上传相关
Route::post('uploader/aliyun/vod/auth', 'UploadController@getAliyunVodAuth')->name('uploader.aliyun.vod.auth');
Route::post('uploader/aliyun/vod/update', 'UploadController@upateAliyunVod')->name('uploader.aliyun.vod.update');

# Ueditor 辅组上传
Route::any('uploader/ueditor', 'UploadController@ueditor')->name('uploader.ueditor');

# 检查分片
Route::post('uploader/check/chunk', 'UploadController@checkChunk')->name('uploader.check.chunk');
# 检查MD5
Route::post('uploader/check/md5', 'UploadController@checkMd5')->name('uploader.check.md5');
# 合并分片
Route::post('uploader/merge/chunks', 'UploadController@mergeChunks')->name('uploader.merge.chunks');

# 微信路由
Route::any('wechat/{safeWechat}.html', 'WeChatController@serve')->name('wechat.api');


/*
|--------------------------------------------------------------------------
| Administrator Routes
|--------------------------------------------------------------------------
|
| 载入后台相关路由
|
*/
require __DIR__ . '/administrator.php';