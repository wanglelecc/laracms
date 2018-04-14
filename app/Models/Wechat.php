<?php

namespace App\Models;
use EasyWeChat\Factory;
use App\Events\BehaviorLogEvent;


class Wechat extends Model
{
    public $table = 'wechat';
    protected $fillable = ['type', 'object_id', 'name', 'account', 'app_id', 'app_secret', 'url', 'token', 'qrcode', 'primary', 'certified'];

    public $dispatchesEvents  = [
        'saved' => BehaviorLogEvent::class,
    ];

    public function titleName(){
        return 'name';
    }

    public function app(){

        $config = config('wechat.default');
        $config['app_id'] = $this->app_id;
        $config['secret'] = $this->app_secret;

        return Factory::officialAccount($config);
    }
}
