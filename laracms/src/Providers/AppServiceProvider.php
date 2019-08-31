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

namespace Wanglelecc\Laracms\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Wanglelecc\Laracms\Models\Setting;
use Wanglelecc\Laracms\Handlers\AdministratorMenuHandler;


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
		\Wanglelecc\Laracms\Models\User::observe(                  \Wanglelecc\Laracms\Observers\UserObserver::class);
		\Wanglelecc\Laracms\Models\WechatMenu::observe(            \Wanglelecc\Laracms\Observers\WechatMenuObserver::class);
		\Wanglelecc\Laracms\Models\Wechat::observe(                \Wanglelecc\Laracms\Observers\WechatObserver::class);
		\Wanglelecc\Laracms\Models\Block::observe(                 \Wanglelecc\Laracms\Observers\BlockObserver::class);
		\Wanglelecc\Laracms\Models\Link::observe(                  \Wanglelecc\Laracms\Observers\LinkObserver::class);
		\Wanglelecc\Laracms\Models\Project::observe(               \Wanglelecc\Laracms\Observers\ProjectObserver::class);
		\Wanglelecc\Laracms\Models\Category::observe(              \Wanglelecc\Laracms\Observers\CategoryObserver::class);
		\Wanglelecc\Laracms\Models\Navigation::observe(            \Wanglelecc\Laracms\Observers\NavigationObserver::class);
		\Wanglelecc\Laracms\Models\Page::observe(                  \Wanglelecc\Laracms\Observers\PageObserver::class);
		\Wanglelecc\Laracms\Models\Article::observe(               \Wanglelecc\Laracms\Observers\ArticleObserver::class);
		\Wanglelecc\Laracms\Models\Slide::observe(                 \Wanglelecc\Laracms\Observers\SlideObserver::class);
		\Wanglelecc\Laracms\Models\File::observe(                  \Wanglelecc\Laracms\Observers\FileObserver::class);
		\Wanglelecc\Laracms\Models\WechatResponse::observe(        \Wanglelecc\Laracms\Observers\WechatResponseObserver::class);
		\Wanglelecc\Laracms\Models\Reply::observe(                 \Wanglelecc\Laracms\Observers\ReplyObserver::class);
		\Wanglelecc\Laracms\Models\Log::observe(                   \Wanglelecc\Laracms\Observers\LogObserver::class);
		\Wanglelecc\Laracms\Models\MultipleFile::observe(          \Wanglelecc\Laracms\Observers\MultipleFileObserver::class);
		\Wanglelecc\Laracms\Models\Form::observe(                  \Wanglelecc\Laracms\Observers\FormObserver::class);

        // 设置时区
        \Carbon\Carbon::setLocale('zh');


        // 检测是否在命令行模式
        if ($this->app->runningInConsole()) {
           // 命令行模式
        }
        else{
            // 非命令行模式
            Setting::afflux();
        }
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
