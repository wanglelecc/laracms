<?php

/*
 * This file is part of the wanglelecc/laracms.
 *
 * (c) wanglele <wanglelecc@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Wanglelecc\Laracms\Providers;

use Illuminate\Support\ServiceProvider;
use Wanglelecc\Laracms\Console;
use Wanglelecc\Laracms\Http\Middleware;

class LaracmsServiceProvider extends ServiceProvider
{

//    protected $defer = true;
    
    protected $commands = [
        Console\Commands\GenerateToken::class,
        Console\Commands\IndexArticle::class,
        Console\Commands\SyncBlock::class,
        Console\Commands\Uploader::class,
    ];
    
    protected $routeMiddleware = [
        'laracms.frontend'              => Middleware\FrontendRequests::class,
        'laracms.auth'                  => Middleware\Authenticate::class,
    ];
    
    protected $middlewareGroups = [
        'laracms' => [
            'laracms.frontend',
            'laracms.authenticated',
            'laracms.auth',
        ],
    ];
    
    public function boot(){
        $this->loadLaracmsConfig();

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    
        // 注册模板变量
        $theme = is_mobile() ? config('theme.mobile') : config('theme.desktop');
        
        $this->loadViewsFrom( __DIR__.'/../../resources/views/backend', 'backend' );
        $this->loadViewsFrom( __DIR__.'/../../resources/views/frontend/'.$theme, 'frontend' );
    }

    public function register()
    {
//        $this->app->singleton(Laracms::class, function () {
//            return new Laracms();
//        });
//
//        $this->app->alias(Laracms::class, 'laracms');
    
        $this->registerRouteMiddleware();
        
        $this->commands($this->commands);
//        $this->schedule();
    }

    public function provides()
    {
//        return [Laracms::class, 'laracms'];
    }
    
    
    /**
     * 加载配置文件
     */
    protected function loadLaracmsConfig()
    {
        // merge config
        $this->mergeConfigFrom(__DIR__.'/../..//config/captcha.php', 'captcha');
        $this->mergeConfigFrom(__DIR__.'/../../config/cache.php', 'cache');
        $this->mergeConfigFrom(__DIR__.'/../../config/filesystems.php', 'filesystems');
        $this->mergeConfigFrom(__DIR__.'/../../config/services.php', 'services');
    
        // php artisan vendor:publish --tag=config
        if( $this->app->runningInConsole() ){
            $this->publishes([
                __DIR__ . '/../../config/administrator.php'      => config_path( 'administrator.php' ),
                __DIR__ . '/../../config/api.php'                => config_path( 'api.php' ),
                __DIR__ . '/../../config/blocks.php'             => config_path( 'blocks.php' ),
                __DIR__ . '/../../config/debugbar.php'           => config_path( 'debugbar.php' ),
                __DIR__ . '/../../config/easysms.php'            => config_path( 'easysms.php' ),
                __DIR__ . '/../../config/form.php'               => config_path( 'form.php' ),
                __DIR__ . '/../../config/logviewer.php'          => config_path( 'logviewer.php' ),
                __DIR__ . '/../../config/theme.php'              => config_path( 'theme.php' ),
                __DIR__ . '/../../config/scout.php'              => config_path( 'scout.php' ),
                __DIR__ . '/../../config/slides.php'             => config_path( 'slides.php' ),
                __DIR__ . '/../../config/wechat.php'             => config_path( 'wechat.php' ),
                __DIR__ . '/../../config/purifier.php'           => config_path( 'purifier.php' ),
            ], 'config');
    
            $this->publishes([
                __DIR__.'/../../resources/assets'           => public_path('vendor/laracms'),
                __DIR__.'/../../resources/assets/images'    => public_path('images'),
                
                __DIR__.'/../../storage/public'             => storage_path('app/public'),
                
                __DIR__.'/../../resources/views/pagination' => resource_path('views/vendor/pagination'),
                __DIR__.'/../../resources/lang'             => resource_path('lang'),
            ], 'public');
            
            $this->publishes([
                __DIR__.'/../../resources/views/errors'   => resource_path('views/errors'),
                __DIR__.'/../../resources/views/backend'  => resource_path('views/vendor/backend'),
                __DIR__.'/../../resources/views/frontend/customize' => resource_path('views/vendor/frontend'),
            ], 'laracms-view');
    
            $this->publishes([
                __DIR__.'/../../resources/views/errors'  => resource_path('views/errors'),
            ], 'laracms-view-errors');
            
        }
    }
    
    /**
     * Register the route middleware.
     *
     * @return void
     */
    protected function registerRouteMiddleware()
    {
        // register route middleware.
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }
        // register middleware group.
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }
    }
    
    
    
}
