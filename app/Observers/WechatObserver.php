<?php

namespace App\Observers;

use App\Models\Wechat;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class WechatObserver
{
    public function creating(Wechat $wechat)
    {
        $wechat->object_id || $wechat->object_id = create_object_id();

    }

    public function saving(Wechat $wechat){
        $wechat->token || $wechat->token = str_random(64);
    }

    public function updating(Wechat $wechat)
    {
        //
    }
}