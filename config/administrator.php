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
use Illuminate\Support\Facades\Auth;

return [

    // 后台的 URI
    'uri' => 'administrator',

    // 后台专属域名，没有的话可以留空
    'domain' => '',

    'paginate' => [
        'limit' => 10,
    ],


    /**
     * 后台菜单数组
     */
    'menu' => [
        [
            "id" => "system",
            "text" => "系统设置",
            "permission" => function(){ return Auth::user()->can('manage_system'); },
            "icon" => "",
            "route" => "",
            "params" => [],
            "children" => [
                [
                    "id" => "system.users",
                    "text" => "用户管理",
                    "permission" => function(){ return Auth::user()->can('manage_users'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "users.index",
                    "params" => [],
                    "query" => [],
                ],
                [
                    "id" => "system.permissions",
                    "text" => "权限管理",
                    "permission" => function(){ return Auth::user()->can('manage_permissions'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "permissions.index",
                    "params" => [],
                    "query" => [],
                ],
                [
                    "id" => "system.roles",
                    "text" => "角色管理",
                    "permission" => function(){ return Auth::user()->can('manage_permissions'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "roles.index",
                    "params" => [],
                    "query" => [],
                ],
            ],
        ],

        [
            "id" => "setting",
            "text" => "站点设置",
            "permission" => function(){ return Auth::user()->can('manage_setting'); },
            "icon" => "",
            "link" => "",
            "route" => "",
            "params" => [],
            "children" => [
                [
                    "id" => "setting.basic",
                    "text" => "站点信息",
                    "permission" => function(){ return Auth::user()->can('manage_setting'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "administrator.site.basic",
                    "params" => [],
                    "query" => [],
                ],
                [
                    "id" => "setting.company",
                    "text" => "公司信息",
                    "permission" => function(){ return Auth::user()->can('manage_setting'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "administrator.site.company",
                    "params" => [],
                    "query" => [],
                ],
                [
                    "id" => "setting.contact",
                    "text" => "联系方式",
                    "permission" => function(){ return Auth::user()->can('manage_setting'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "administrator.site.contact",
                    "params" => [],
                    "query" => [],
                ],
                [
                    "id" => "link",
                    "text" => "友情链接",
                    "permission" => function(){ return Auth::user()->can('manage_setting'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "links.index",
                    "params" => [],
                    "query" => [],
                ],
                [
                    "id" => "navigation",
                    "text" => "栏目导航",
                    "permission" => function(){ return Auth::user()->can('manage_setting'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "administrator.navigation.index",
                    "params" => ['desktop'],
                    "query" => [],
                ],
                [
                    "id" => "wechat",
                    "text" => "微信管理",
                    "permission" => function(){ return Auth::user()->can('manage_wechat'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "wechats.index",
                    "params" => [],
                    "query" => [],
                ],

            ],
        ],

        [
            "id" => "layouts",
            "text" => "内容管理",
            "permission" => function(){ return Auth::user()->can('manage_setting'); },
            "icon" => "",
            "route" => "",
            "params" => [],
            "children" => [
                [
                    "id" => "",
                    "text" => "文章分类",
                    "permission" => function(){ return Auth::user()->can('manage_article'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "administrator.category.index",
                    "params" => ['article'],
                    "query" => [],
                ],
                [
                    "id" => "roles",
                    "text" => "文章管理",
                    "permission" => function(){ return Auth::user()->can('manage_article'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "articles.index",
                    "params" => [],
                    "query" => [ "type=article", ],
                ],
                [
                    "id" => "roles",
                    "text" => "视频管理",
                    "permission" => function(){ return Auth::user()->can('manage_article'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "articles.index",
                    "params" => [],
                    "query" => [ "type=video", ],
                ],
                [
                    "id" => "",
                    "text" => "图片管理",
                    "permission" => function(){ return Auth::user()->can('manage_media'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "media.image",
                    "params" => [],
                    "query" => [],
                ],
                [
                    "id" => "",
                    "text" => "页面管理",
                    "permission" => function(){ return Auth::user()->can('manage_page'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "pages.index",
                    "params" => [],
                    "query" => [],
                ],
                [
                    "id" => "",
                    "text" => "幻灯管理",
                    "permission" => function(){ return Auth::user()->can('manage_slide'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "slides.index",
                    "params" => [],
                    "query" => [],
                ],
                [
                    "id" => "",
                    "text" => "区块管理",
                    "permission" => function(){ return Auth::user()->can('manage_block'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "blocks.index",
                    "params" => [],
                    "query" => [],
                ],
                /*
                [
                    "id" => "",
                    "text" => "图片管理",
                    "permission" => function(){ return Auth::user()->can('manage_annex'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "",
                    "params" => [],
                    "query" => [],
                ],
                [
                    "id" => "",
                    "text" => "附件管理",
                    "permission" => function(){ return Auth::user()->can('manage_annex'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "",
                    "params" => [],
                    "query" => [],
                ],
                */
            ],
        ],



    ],

    // 快捷方式
    'shortcut' => [
        [
            "id" => "dashboard",
            "text" => "控制台",
            "permission" => function(){ return true; },
            "icon" => "",
            "route" => "administrator.dashboard",
            "params" => [],
            "query" => [],
            "link" => "",
            "children" => [],
        ],
        [
            "id" => "develop",
            "text" => "开发调试",
            "permission" => function(){ return Auth::user()->can('manage_develop'); },
            "icon" => "",
            "link" => "",
            "route" => "",
            "params" => [],
            "query" => [],
            "children" => [
                [
                    "id" => "log",
                    "text" => "系统日志",
                    "permission" => function(){ return Auth::user()->can('manage_develop'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "log.laravel",
                    "params" => [],
                    "query" => [],
                ],
                [
                    "id" => "task",
                    "text" => "任务日志",
                    "permission" => function(){ return Auth::user()->can('manage_develop'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "log.jobs",
                    "params" => [],
                    "query" => [],
                ],
                [
                    "id" => "queue",
                    "text" => "队列状态",
                    "permission" => function(){ return Auth::user()->can('manage_develop'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "log.queue",
                    "params" => [],
                    "query" => [],
                ],
                [
                    "id" => "behavior",
                    "text" => "行为日志",
                    "permission" => function(){ return Auth::user()->can('manage_develop'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "log.behavior",
                    "params" => [],
                    "query" => [],
                ],
                [
                    "id" => "business",
                    "text" => "业务日志",
                    "permission" => function(){ return Auth::user()->can('manage_develop'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "log.business",
                    "params" => [],
                    "query" => [],
                ],
            ],
        ],
        [
            "id" => "github",
            "text" => "Github",
            "permission" => function(){ return true; },
            "icon" => "",
            "route" => "",
            "params" => [],
            "query" => [],
            "link" => "https://github.com/wanglelecc",
            "children" => [],
        ],
    ],

];