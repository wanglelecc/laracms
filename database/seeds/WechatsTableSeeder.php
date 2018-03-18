<?php

use Illuminate\Database\Seeder;
use App\Models\Wechat;

class WechatsTableSeeder extends Seeder
{
    public function run()
    {
        $wechats = factory(Wechat::class)->times(50)->make()->each(function ($wechat, $index) {
            if ($index == 0) {
                // $wechat->field = 'value';
            }
        });

        // Wechat::insert($wechats->toArray());
    }

}

