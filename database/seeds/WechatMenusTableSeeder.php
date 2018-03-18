<?php

use Illuminate\Database\Seeder;
use App\Models\WechatMenu;

class WechatMenusTableSeeder extends Seeder
{
    public function run()
    {
        $wechat_menus = factory(WechatMenu::class)->times(50)->make()->each(function ($wechat_menu, $index) {
            if ($index == 0) {
                // $wechat_menu->field = 'value';
            }
        });

        // WechatMenu::insert($wechat_menus->toArray());
    }

}

