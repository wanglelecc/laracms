<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wechat;

class WechatPolicy extends Policy
{
    public function update(User $user, Wechat $wechat)
    {
        // return $wechat->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Wechat $wechat)
    {
        return true;
    }

    public function show(User $user, Wechat $wechat){
        return true;
    }
}
