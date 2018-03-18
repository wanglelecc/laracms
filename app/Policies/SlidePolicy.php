<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Slide;

class SlidePolicy extends Policy
{
    public function index(User $user, Slide $slide)
    {
        return $user->can("manage_slide");
    }

    public function manage(User $user, Slide $slide)
    {
        return $user->can("manage_slide");
    }

    public function create(User $user, Slide $slide)
    {
        return $user->can("manage_slide");
    }

    public function update(User $user, Slide $slide)
    {
        return $user->can("manage_slide");
    }

    public function destroy(User $user, Slide $slide)
    {
        return $user->can("manage_slide");
    }
}
