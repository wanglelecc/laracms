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

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


$api = app('Dingo\Api\Routing\Router');

/*
 * -----------------------------------------------------------------------
 * v1 Version API Routes
 * -----------------------------------------------------------------------
 */
$api->version('v1', [
    'namespace' => 'Wanglelecc\Laracms\Http\Controllers\Api\V1',
    'middleware' => 'serializer:array',
], function($api) {

    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function($api){
        # 游客可以访问的接口

        # 短信验证码
        $api->post('verificationCodes', 'VerificationCodesController@store')->name('api.verificationCodes.store');

        # 用户注册
        $api->post('users', 'UsersController@store')->name('api.users.store');

        # 图片验证码
        $api->post('captchas', 'CaptchasController@store')->name('api.captchas.store');

        # 第三方登录
        $api->post('socials/{social_type}/authorizations', 'AuthorizationsController@socialStore')->name('api.socials.authorizations.store');

        # 登录
        $api->post('authorizations', 'AuthorizationsController@store')->name('api.authorizations.store');

        # 刷新token
        $api->put('authorizations/current', 'AuthorizationsController@update')->name('api.authorizations.update');

        # 删除token
        $api->delete('authorizations/current', 'AuthorizationsController@destroy')->name('api.authorizations.destroy');

        # 获取栏目导航
        $api->get('navigation/{navigation_type}', 'NavigationController@index')->name('api.navigation.index');

        # 获取文章列表(包含内容)
        $api->get('articles/{category_id}', 'ArticleController@index')->name('api.article.index');

        # 获取单页面内容
        $api->get('pages/{page_id}', 'PageController@show')->name('api.page.show');

        # 获取关于我们内容
        $api->get('about', 'PageController@about')->name('api.page.about');

        # 获取区块内容
        $api->get('blocks/{block_id}', 'BlockController@show')->name('api.block.show');

        # .....


        // 需要 token 验证的接口
        $api->group(['middleware' => 'api.auth'], function($api) {
            // 当前登录用户信息
            $api->get('user', 'UsersController@me')->name('api.user.show');
            // 当前登录用户权限
            $api->get('user/permissions', 'PermissionsController@index')->name('api.user.permissions.index');
            // ...

        });
    });

    $api->get('version', function() {
        return response('this is version v1');
    });
});

/*
 * -----------------------------------------------------------------------
 * v2 Version API Routes
 * -----------------------------------------------------------------------
 */
$api->version('v2', [
    'namespace' => 'Wanglelecc\Laracms\Http\Controllers\Api\V2'
], function($api) {



    $api->get('version', function() {
        return response('this is version v2');
    });
});
