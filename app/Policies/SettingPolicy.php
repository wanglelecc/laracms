<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Setting;

class SettingPolicy extends Policy
{

    public function basic(User $user, Setting $setting)
    {
        return $user->can("manage_setting");
    }

    public function company(User $user, Setting $setting)
    {
        return $user->can("manage_setting");
    }

    public function contact(User $user, Setting $setting)
    {
        return $user->can("manage_setting");
    }
}
