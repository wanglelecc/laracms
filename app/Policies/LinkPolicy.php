<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Link;

class LinkPolicy extends Policy
{

    public function index(User $user, Link $link)
    {
        return $user->can('manage_setting');
    }

    public function create(User $user, Link $link)
    {
        return $user->can('manage_setting');
    }

    public function update(User $user, Link $link)
    {
        return $user->can('manage_setting');
    }

    public function destroy(User $user, Link $link)
    {
        return $user->can('manage_setting');
    }
}
