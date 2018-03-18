<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Handlers\AdministratorMenuHandler;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
	{
		\App\Models\User::observe(\App\Observers\UserObserver::class);
		\App\Models\WechatMenu::observe(\App\Observers\WechatMenuObserver::class);
		\App\Models\Wechat::observe(\App\Observers\WechatObserver::class);
		\App\Models\Block::observe(\App\Observers\BlockObserver::class);
		\App\Models\Link::observe(\App\Observers\LinkObserver::class);
		\App\Models\Project::observe(\App\Observers\ProjectObserver::class);
		\App\Models\Category::observe(\App\Observers\CategoryObserver::class);
		\App\Models\Navigation::observe(\App\Observers\NavigationObserver::class);
		\App\Models\Page::observe(\App\Observers\PageObserver::class);
		\App\Models\Article::observe(\App\Observers\ArticleObserver::class);
		\App\Models\Slide::observe(\App\Observers\SlideObserver::class);
		\App\Models\File::observe(\App\Observers\FileObserver::class);
		\App\Models\WechatResponse::observe(\App\Observers\WechatResponseObserver::class);

        //
        \Carbon\Carbon::setLocale('zh');


        // 检测是否在命令行模式
        if ($this->app->runningInConsole()) {
           // 命令行模式
        }
        else{
            // 非命令行模式
            \App\Models\Setting::afflux();
        }



//        View::share('AdministratorMenu',app(AdministratorMenuHandler::class)->getAdministratorMenu());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
