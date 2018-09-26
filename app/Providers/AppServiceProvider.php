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
	    // 注册模型观察者
		\App\Models\User::observe(                  \App\Observers\UserObserver::class);
		\App\Models\WechatMenu::observe(            \App\Observers\WechatMenuObserver::class);
		\App\Models\Wechat::observe(                \App\Observers\WechatObserver::class);
		\App\Models\Block::observe(                 \App\Observers\BlockObserver::class);
		\App\Models\Link::observe(                  \App\Observers\LinkObserver::class);
		\App\Models\Project::observe(               \App\Observers\ProjectObserver::class);
		\App\Models\Category::observe(              \App\Observers\CategoryObserver::class);
		\App\Models\Navigation::observe(            \App\Observers\NavigationObserver::class);
		\App\Models\Page::observe(                  \App\Observers\PageObserver::class);
		\App\Models\Article::observe(               \App\Observers\ArticleObserver::class);
		\App\Models\Slide::observe(                 \App\Observers\SlideObserver::class);
		\App\Models\File::observe(                  \App\Observers\FileObserver::class);
		\App\Models\WechatResponse::observe(        \App\Observers\WechatResponseObserver::class);
		\App\Models\Reply::observe(                 \App\Observers\ReplyObserver::class);
		\App\Models\Log::observe(                   \App\Observers\LogObserver::class);
		\App\Models\MultipleFile::observe(          \App\Observers\MultipleFileObserver::class);
		\App\Models\Form::observe(                  \App\Observers\FormObserver::class);

        // 设置时区
        \Carbon\Carbon::setLocale('zh');


        // 检测是否在命令行模式
        if ($this->app->runningInConsole()) {
           // 命令行模式
        }
        else{
            // 非命令行模式
            \App\Models\Setting::afflux();
        }
        
        // 注册模板变量
        $theme = is_mobile() ? config('theme.mobile') : config('theme.desktop');
        $this->loadViewsFrom( resource_path('views/backend') , 'backend' );
        $this->loadViewsFrom( resource_path('views/frontend/'.$theme) , 'frontend' );
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
