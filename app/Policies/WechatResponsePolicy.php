<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WechatResponse;

class WechatResponsePolicy extends Policy
{
    public function update(User $user, WechatResponse $wechatResponse)
    {
        return true;
    }

    public function destroy(User $user, WechatResponse $wechatResponse)
    {
        return true;
    }
}
