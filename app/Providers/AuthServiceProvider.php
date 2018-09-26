<?php

namespace App\Providers;

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
		 \App\Models\WechatResponse::class                  => \App\Policies\WechatResponsePolicy::class,
		 \App\Models\WechatMenu::class                      => \App\Policies\WechatMenuPolicy::class,
		 \App\Models\Wechat::class                          => \App\Policies\WechatPolicy::class,
		 \App\Models\Article::class                         => \App\Policies\ArticlePolicy::class,
		 \App\Models\Block::class                           => \App\Policies\BlockPolicy::class,
		 \App\Models\Link::class                            => \App\Policies\LinkPolicy::class,
		 \App\Models\Project::class                         => \App\Policies\ProjectPolicy::class,
		 \App\Models\Slide::class                           => \App\Policies\SlidePolicy::class,
		 \App\Models\Category::class                        => \App\Policies\CategoryPolicy::class,
		 \App\Models\Navigation::class                      => \App\Policies\NavigationPolicy::class,
		 \App\Models\File::class                            => \App\Policies\FilePolicy::class,
		 \App\Models\Setting::class                         => \App\Policies\SettingPolicy::class,
         \App\Models\User::class                            => \App\Policies\UserPolicy::class,
         \App\Models\Page::class                            => \App\Policies\PagePolicy::class,
         \App\Models\Reply::class                           => \App\Policies\ReplyPolicy::class,
         \App\Models\Form::class                            => \App\Policies\FormPolicy::class,

         \Spatie\Permission\Models\Role::class              => \App\Policies\RolePolicy::class,
         \Spatie\Permission\Models\Permission::class        => \App\Policies\PermissionPolicy::class,
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
