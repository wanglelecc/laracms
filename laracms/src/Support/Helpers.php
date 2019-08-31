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

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

if( !function_exists('get_aliyun_acs_clent') ){
    /**
     * 获取 Aliyun Acs 客户端对象
     * @return DefaultAcsClient
     */
    function get_aliyun_acs_clent(){
        $vod_region_id      = config('filesystems.disks.aliyun.vod_region_id');
        $access_key_id      = config('filesystems.disks.aliyun.access_key_id');
        $access_key_secret  = config('filesystems.disks.aliyun.access_key_secret');

        return new \DefaultAcsClient(\DefaultProfile::getProfile($vod_region_id, $access_key_id, $access_key_secret));
    }
}

if( !function_exists('get_environment_variable') ){
    function get_environment_variable($name)
    {
        switch (true) {
            case array_key_exists($name, $_ENV):
                return $_ENV[$name];
            case array_key_exists($name, $_SERVER):
                return $_SERVER[$name];
            default:
                $value = getenv($name);
                return $value === false ? null : $value; // switch getenv customize to null
        }
    }
}

if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = get_environment_variable($key);

        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }

        if (strlen($value) > 1 && Str::startsWith($value, '"') && Str::endsWith($value, '"')) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if( !function_exists('get_active_template') ){

    /**
     * 获取可用模板
     *
     * @param string $path
     * @param string $prefix
     * @return array
     */
    function get_active_template($path = 'page', $prefix = 'show' ){

        $key = 'template_cache_'.$path.'_'.$prefix;

        $templates = \Cache::get($key);

        if( \App::environment('production') && $templates ){
            return $templates;
        }

        $view_path = config('view.paths')[0] . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'frontend'. DIRECTORY_SEPARATOR . config('theme.desktop') . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR;
        $list =  glob($view_path.$prefix."-*.blade.php");
        $templates = [
            '' => '默认',
        ];

        foreach ($list as $file) {
            $file = basename($file);
            if (preg_match("/".$prefix."\-(.*?)\.blade.php/", $file, $match)){
                $templates[$match[1]] = config("theme.template.{$path}.{$prefix}.{$match[1]}", $match[1]);
            }
        }

        if(\App::environment('production')){
            $expiredAt = now()->addMinutes(config('cache.expired.template', 10));
            \Cache::put($key, $templates, $expiredAt);
        }

        return $templates;
    }
}

if( !function_exists('byte_to_size') ){
    
    function byte_to_size($byte){
        if($byte > pow(2,40)){
            $size = round($byte/pow(2,40),2).' TB';
        }elseif($byte > pow(2,30)){
            $size = round($byte/pow(2,30),2).' GB';
        }elseif($byte > pow(2,20)){
            $size = round($byte/pow(2,20),2).' MB';
        }elseif($byte > pow(2,10)){
            $size = round($byte/pow(2,10),2).' KB';
        }else{
            $size = round($byte,2).' B';
        }
        
        return $size;
    }
}

if( !function_exists('storage_url') ){
    /**
     * 获取文章完整的 URL
     */
    function storage_url($path){
        return \Illuminate\Support\Facades\Storage::url($path);
    }
}

if( !function_exists('storage_image_url') ){
    /**
     * 获取图片完整 URL
     */
    function storage_image_url($path){
        return !empty($path) ? storage_url($path) : config('app.url') . '/images/pic-none.png';
    }
}

if( !function_exists('storage_video_url') ){
    /**
     * 获取视频缩略图完整 URL
     */
    function storage_video_url($path){
        return !empty($path) ? storage_url($path) : config('app.url') . '/images/video-none.png';
    }
}


if( !function_exists("route_class") ){
    /**
     * 根据路由生成 class
     */
    function route_class()
    {
        return str_replace('.', '-', Route::currentRouteName());
    }
}


if( !function_exists('response_ajax') ){
    /**
     * 预定义的一个简单响应结构
     */
    function response_ajax($code = 0, $message = 'ok', $data = []){
        return [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];
    }
}


if( !function_exists("previous_url") ){
    /**
     * 获取上一次请求完整的 url 并 urlencode
     */
    function previous_url(){
        return urlencode(url()->previous());
    }
}

if( !function_exists("backend_url") ){
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
}


if( !function_exists("backend_route") ){
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
}


if( !function_exists("backend_view") ){
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
        $args[0] = 'backend::'.$name;
        
        return view(...$args);
    }
}

if( !function_exists("frontend_url") ){
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
}

if( !function_exists("frontend_view") ){
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
        $args[0] = 'frontend::'.$name;
        
        return view(...$args);
    }
}

if( !function_exists("backend_redirect") ){
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
}

if( !function_exists("backend_view_exists") ){
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
}

if( !function_exists("frontend_redirect") ){
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
}

if( !function_exists("create_object_id") ){
    /**
     * 生成 object_id
     */
    function create_object_id(){
        return base_convert(uniqid(), 16, 10);
    }
}

if( !function_exists("get_value") ){
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
}

if( !function_exists("get_block_params") ){
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
}

if( !function_exists("get_json_params") ){
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
}

if( !function_exists("get_form_value") ){
    /**
     * 获取表单参数
     *
     * @param $value
     * @param $field
     * @return mixed|string
     */
    function get_form_value($value, $field){

        $options = $field['options'] ?? null;
        if(is_null($options) || is_string($options)){
            return is_string($value) ? $value : implode(' ', (array)$value);
        }else if( is_array($options) && is_string($value) ){
            return $options[$value] ?? $value;
        }else if(is_array($options) && is_array($value)){
            $value = array_map(function($val) use ($options){ return $options[$val] ?? $val; },$value);
            return implode(' ', $value);
        }else{
            return is_string($value) ? $value : implode(' ', (array)$value);
        }
    }
}

if( !function_exists("make_excerpt") ){
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
}

if( !function_exists("model_admin_link") ){
    function model_admin_link($title, $model)
    {
        return model_link($title, $model, 'admin');
    }
}

if( !function_exists("model_link") ){
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
}

if(!function_exists("model_plural_name")){
    function model_plural_name($model)
    {
        // 从实体中获取完整类名，例如：Wanglelecc\Laracms\Models\User
        $full_class_name = get_class($model);

        // 获取基础类名，例如：传参 `Wanglelecc\Laracms\Models\User` 会得到 `User`
        $class_name = class_basename($full_class_name);

        // 蛇形命名，例如：传参 `User`  会得到 `user`, `FooBar` 会得到 `foo_bar`
        $snake_case_name = snake_case($class_name);

        // 获取子串的复数形式，例如：传参 `user` 会得到 `users`
        return str_plural($snake_case_name);
    }
}

if( !function_exists("is_json") ){
    function is_json($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

if( !function_exists("frontend_navigation") ){
    /**
     * 获取前台导航(过滤隐藏)
     *
     * @param string $category
     * @return mixed
     */
    function frontend_navigation($category = 'desktop'){
        return $navigationHandler = app(\Wanglelecc\Laracms\Handlers\NavigationHandler::class)->frontend($category);
    }
}

if( !function_exists("frontend_complete_navigation") ){
    /**
     * 获取前台导航(包含隐藏)
     *
     * @param string $category
     * @return mixed
     */
    function frontend_complete_navigation($category = 'desktop'){
        return $navigationHandler = app(\Wanglelecc\Laracms\Handlers\NavigationHandler::class)->completeFrontend($category);
    }
}

if( !function_exists("frontend_current_brother_and_child_navigation") ){
    /**
     * 获取前台当前兄弟及子导航
     *
     * @param string $category
     * @param bool $showOneLevel
     * @return mixed
     */
    function frontend_current_brother_and_child_navigation($category = 'desktop', $showOneLevel = false){
        return $navigationHandler = app(\Wanglelecc\Laracms\Handlers\NavigationHandler::class)->getCurrentBrothersAndChildNavigation($category, $showOneLevel);
    }
}

if( !function_exists("frontend_current_child_navigation") ){
    /**
     * 获取当前自导航
     *
     * @param string $category
     * @return mixed
     */
    function frontend_current_child_navigation($category = 'desktop'){
        return $navigationHandler = app(\Wanglelecc\Laracms\Handlers\NavigationHandler::class)->getCurrentChildNavigation($category);
    }
}

if( !function_exists("breadcrumb") ){
    /**
     * 获取面包屑数据
     *
     * @return mixed
     */
    function breadcrumb(){
        return $navigationHandler = app(\Wanglelecc\Laracms\Handlers\NavigationHandler::class)->breadcrumb();
    }
}

if(!function_exists("get_block")){
    /**
     * 获取区块内容
     *
     * @param $object_id
     * @return mixed
     */
    function get_block($object_id){

        $key = 'block_cache_'.$object_id;

        $block = \Cache::get($key);

        if( \App::environment('production') && $block ){
            return $block;
        }

        $block =  app(\Wanglelecc\Laracms\Handlers\BlockHandler::class)->getBlockData($object_id);

        if(\App::environment('production')){
            $expiredAt = now()->addMinutes(config('cache.expired.block', 10));
            \Cache::put($key, $block, $expiredAt);
        }

        return $block;
    }
}

if( !function_exists("is_mobile") ){
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
}

if( !function_exists("laracms_log") ){
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
        return \Wanglelecc\Laracms\Models\Log::create([
            'group'          => $group,
            'type'           => $type,
            'description'    => $description,
            'model'          => $model,
        ]);
    }
}

if( !function_exists("laravel_log") ){
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
}

if( !function_exists("jobs_log") ){
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
}

if( !function_exists("queue_log") ){
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
}

if( !function_exists("behavior_log") ){
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
}

if( !function_exists("business_log") ){
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
}