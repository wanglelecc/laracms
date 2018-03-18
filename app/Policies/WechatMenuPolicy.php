<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WechatMenu;

class WechatMenuPolicy extends Policy
{
    public function update(User $user, WechatMenu $wechat_menu)
    {
        // return $wechat_menu->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, WechatMenu $wechat_menu)
    {
        return true;
    }
}
