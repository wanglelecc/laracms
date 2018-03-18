<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Navigation;

class NavigationPolicy extends Policy
{
    public function index(User $user, Navigation $navigation)
    {
        return $user->can('manage_setting');
    }

    public function create(User $user, Navigation $navigation)
    {
        return $user->can('manage_setting');
    }

    public function update(User $user, Navigation $navigation)
    {
        return $user->can('manage_setting');
    }

    public function destroy(User $user, Navigation $navigation)
    {
        return $user->can('manage_setting');
    }
}
