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

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

/**
 * 获取上一次请求完整的 url 并 urlencode
 */
function previous_url(){
    return urlencode(url()->previous());
}

/**
 * 后台url生成函数
 *
 * @author lele.wang <lele.wang@raiing.com>
 * @param $uri
 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
 */
function backend_url($uri)
{
    $args = func_get_args();
    $args[0] = config('administrator.uri').'/'.$uri;

    return url(...$args);
}

/**
 * 后台 route 生成函数
 *
 * @param $uri
 * @return string
 */
function backend_route($uri)
{
    $args = func_get_args();
    $args[0] = config('administrator.uri').'.'.$uri;

    return route(...$args);
}


/**
 * 后台view加载函数
 *
 * @author lele.wang <lele.wang@raiing.com>
 * @param $name
 * @return mixed
 */
function backend_view($name)
{
    $args = func_get_args();
    $args[0] = 'backend.'.$name;


    return view(...$args);
}

/**
 * 前台url生成函数
 *
 * @author lele.wang <lele.wang@raiing.com>
 * @param $uri
 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
 */
function frontend_url($uri)
{
    return url($uri);
}

/**
 * 前台view加载函数
 *
 * @author lele.wang <lele.wang@raiing.com>
 * @param $name
 * @return mixed
 */
function frontend_view($name)
{
    $args = func_get_args();
    if(is_mobile()){
        $args[0] = 'frontend.'.config('theme.mobile').'.'.$name;
    }else{
        $args[0] = 'frontend.'.config('theme.desktop').'.'.$name;
    }

    return view(...$args);
}

/**
 * 后台跳转函数封装
 *
 * @author lele.wang <lele.wang@raiing.com>
 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
 */
function backend_redirect(){
    $args = func_get_args();
    if(empty($args)){
        return redirect();
    }else if(isset($args[0]) && is_string($args[0])) {
        $args[0] = config('administrator.uri').'/'. $args[0];
    }

    return redirect(...$args);
}

/**
 * 检查后台模板是否存在
 *
 * @author lele.wang <lele.wang@raiing.com>
 * @param $name
 * @return mixed
 */
function backend_view_exists($name){
    $args = func_get_args();
    $args[0] = 'backend.'.$name;

    return call_user_func_array(['Illuminate\Support\Facades\View','exists'], $args);
}

/**
 * 前台跳转函数封装
 *
 * @author lele.wang <lele.wang@raiing.com>
 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
 */
function frontend_redirect(){
    $args = func_get_args();
    if(empty($args)){
        return redirect();
    }else if(isset($args[0]) && is_string($args[0])) {
//        $args[0] = 'web/'. $args[0];
    }

    return redirect(...$args);
}


/**
 * 生成 object_id
 */
function create_object_id(){
    return base_convert(uniqid(), 16, 10);
}

/**
 * 获取对象/数组值
 *
 * @param $arr_or_obj
 * @param $key_or_prop
 * @param string $else
 * @return mixed|string
 */
function get_value($arr_or_obj, $key_or_prop, $else = ''){
    $result = $else;
    if(isset($arr_or_obj)){
        if(is_array($arr_or_obj)){
            if(isset($arr_or_obj[$key_or_prop])) {
                $result = $arr_or_obj[$key_or_prop];
            }
        }else if(is_object($arr_or_obj)){
            if (isset($arr_or_obj->$key_or_prop)) {
                $result = $arr_or_obj->$key_or_prop;
            }
        }
    }

    return $result;
}

/**
 * 获取 block 参数
 *
 * @param $content
 * @param $key
 * @param string $default
 * @return mixed|string
 */
function get_block_params($content,$key, $default = ''){
    $content = is_json($content) ? json_decode($content) : new \stdClass();
    return get_value($content, $key, $default);
}

/**
 * 获取 json 参数
 * @param $content
 * @param $key
 * @param string $default
 * @return mixed|string
 */
function get_json_params($content,$key, $default = ''){
    return get_block_params(...func_get_args());
}

/**
 * 生成摘录
 *
 * @param $value
 * @param int $length
 * @return string
 */
function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return str_limit($excerpt, $length);
}

function model_admin_link($title, $model)
{
    return model_link($title, $model, 'admin');
}

function model_link($title, $model, $prefix = '')
{
    // 获取数据模型的复数蛇形命名
    $model_name = model_plural_name($model);

    // 初始化前缀
    $prefix = $prefix ? "/$prefix/" : '/';

    // 使用站点 URL 拼接全量 URL
    $url = config('app.url') . $prefix . $model_name . '/' . $model->id;

    // 拼接 HTML A 标签，并返回
    return '<a href="' . $url . '" target="_blank">' . $title . '</a>';
}

function model_plural_name($model)
{
    // 从实体中获取完整类名，例如：App\Models\User
    $full_class_name = get_class($model);

    // 获取基础类名，例如：传参 `App\Models\User` 会得到 `User`
    $class_name = class_basename($full_class_name);

    // 蛇形命名，例如：传参 `User`  会得到 `user`, `FooBar` 会得到 `foo_bar`
    $snake_case_name = snake_case($class_name);

    // 获取子串的复数形式，例如：传参 `user` 会得到 `users`
    return str_plural($snake_case_name);
}

function is_json($string)
{
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}

/**
 * 获取前台导航(过滤隐藏)
 *
 * @param string $category
 * @return mixed
 */
function frontend_navigation($category = 'desktop'){
    return $navigationHandler = app(\App\Handlers\NavigationHandler::class)->frontend($category);
}

/**
 * 获取前台导航(包含隐藏)
 *
 * @param string $category
 * @return mixed
 */
function frontend_complete_navigation($category = 'desktop'){
    return $navigationHandler = app(\App\Handlers\NavigationHandler::class)->completeFrontend($category);
}

/**
 * 获取前台当前兄弟及子导航
 *
 * @param string $category
 * @param bool $showOneLevel
 * @return mixed
 */
function frontend_current_brother_and_child_navigation($category = 'desktop', $showOneLevel = false){
    return $navigationHandler = app(\App\Handlers\NavigationHandler::class)->getCurrentBrothersAndChildNavigation($category, $showOneLevel);
}

/**
 * 获取当前自导航
 *
 * @param string $category
 * @return mixed
 */
function frontend_current_child_navigation($category = 'desktop'){
    return $navigationHandler = app(\App\Handlers\NavigationHandler::class)->getCurrentChildNavigation($category);
}

/**
 * 获取面包屑数据
 *
 * @return mixed
 */
function breadcrumb(){
    return $navigationHandler = app(\App\Handlers\NavigationHandler::class)->breadcrumb();
}

/**
 * 获取区块内容
 *
 * @param $object_id
 * @return mixed
 */
function get_block($object_id){
    return app(\App\Handlers\BlockHandler::class)->getBlockData($object_id);
}

/**
 * 判断是否为手机
 *
 * @return bool
 */
function is_mobile()
{
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])) {
        return TRUE;
    }
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA'])) {
        return stristr($_SERVER['HTTP_VIA'], "wap") ? TRUE : FALSE;// 找不到为flase,否则为TRUE
    }
    // 判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array(
            'mobile',
            'nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap'
        );
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return TRUE;
        }
    }
    if (isset ($_SERVER['HTTP_ACCEPT'])) { // 协议法，因为有可能不准确，放到最后判断
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== FALSE) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === FALSE || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return TRUE;
        }
    }
    return FALSE;
}

/**
 * 记录日志
 *
 * @param $group 'laravel','jobs','queue','behavior','business'
 * @param $type
 * @param $description
 * @param null $model
 * @return mixed
 */
function laracms_log($group, $type, $description, $model = null){
   return \App\Models\Log::create([
       'group'          => $group,
       'type'           => $type,
       'description'    => $description,
       'model'          => $model,
   ]);
}

/**
 * laravel 日志记录
 *
 * @param $type
 * @param $description
 * @param null $model
 * @return mixed
 */
function laravel_log($type, $description, $model = null){
    return laracms_log('laravel', $type, $description, $model);
}

/**
 * 任务日志记录
 *
 * @param $type
 * @param $description
 * @param null $model
 * @return mixed
 */
function jobs_log($type, $description, $model = null){
    return laracms_log('jobs', $type, $description, $model);
}

/**
 * 队列日志记录
 *
 * @param $type
 * @param $description
 * @param null $model
 * @return mixed
 */
function queue_log($type, $description, $model = null){
    return laracms_log('queue', $type, $description, $model);
}

/**
 * 行为日志记录
 *
 * @param $type
 * @param $description
 * @param null $model
 * @return mixed
 */
function behavior_log($type, $description, $model = null){
    return laracms_log('behavior', $type, $description, $model);
}

/**
 * 记录业务日志
 *
 * @param $type
 * @param $description
 * @param null $model
 * @return mixed
 */
function business_log($type, $description, $model = null){
    return laracms_log('business', $type, $description, $model);
}
