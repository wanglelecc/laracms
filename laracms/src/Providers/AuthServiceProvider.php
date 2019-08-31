<?php

namespace Wanglelecc\Laracms\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
		 \Wanglelecc\Laracms\Models\WechatResponse::class                  => \Wanglelecc\Laracms\Policies\WechatResponsePolicy::class,
		 \Wanglelecc\Laracms\Models\WechatMenu::class                      => \Wanglelecc\Laracms\Policies\WechatMenuPolicy::class,
		 \Wanglelecc\Laracms\Models\Wechat::class                          => \Wanglelecc\Laracms\Policies\WechatPolicy::class,
		 \Wanglelecc\Laracms\Models\Article::class                         => \Wanglelecc\Laracms\Policies\ArticlePolicy::class,
		 \Wanglelecc\Laracms\Models\Block::class                           => \Wanglelecc\Laracms\Policies\BlockPolicy::class,
		 \Wanglelecc\Laracms\Models\Link::class                            => \Wanglelecc\Laracms\Policies\LinkPolicy::class,
		 \Wanglelecc\Laracms\Models\Project::class                         => \Wanglelecc\Laracms\Policies\ProjectPolicy::class,
		 \Wanglelecc\Laracms\Models\Slide::class                           => \Wanglelecc\Laracms\Policies\SlidePolicy::class,
		 \Wanglelecc\Laracms\Models\Category::class                        => \Wanglelecc\Laracms\Policies\CategoryPolicy::class,
		 \Wanglelecc\Laracms\Models\Navigation::class                      => \Wanglelecc\Laracms\Policies\NavigationPolicy::class,
		 \Wanglelecc\Laracms\Models\File::class                            => \Wanglelecc\Laracms\Policies\FilePolicy::class,
		 \Wanglelecc\Laracms\Models\Setting::class                         => \Wanglelecc\Laracms\Policies\SettingPolicy::class,
         \Wanglelecc\Laracms\Models\User::class                            => \Wanglelecc\Laracms\Policies\UserPolicy::class,
         \Wanglelecc\Laracms\Models\Page::class                            => \Wanglelecc\Laracms\Policies\PagePolicy::class,
         \Wanglelecc\Laracms\Models\Reply::class                           => \Wanglelecc\Laracms\Policies\ReplyPolicy::class,
         \Wanglelecc\Laracms\Models\Form::class                            => \Wanglelecc\Laracms\Policies\FormPolicy::class,

         \Spatie\Permission\Models\Role::class                             => \Wanglelecc\Laracms\Policies\RolePolicy::class,
         \Spatie\Permission\Models\Permission::class                       => \Wanglelecc\Laracms\Policies\PermissionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
