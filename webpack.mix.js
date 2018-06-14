let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .js('resources/assets/js/administrator.js', 'public/js')
   .sass('resources/assets/sass/administrator.scss', 'public/css')
   .js('resources/assets/js/app.desktop.js', 'public/js')
   .sass('resources/assets/sass/app.desktop.scss', 'public/css')
   .copyDirectory('resources/assets/layui', 'public/layui')
   .copyDirectory('resources/assets/plugins', 'public/plugins')
   .copyDirectory('resources/assets/images', 'public/images')
   .copy('resources/assets/js/jquery.cookie-1.4.1.min.js', 'public/js/jquery.cookie-1.4.1.min.js')
   ;

mix.browserSync({
    port: 3000,
    proxy: 'laracms.leleserver.cc' // 这里修改成当前项目域名
});

mix.disableNotifications();