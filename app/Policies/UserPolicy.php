<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy extends Policy
{
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // $currentUser 当前登录用户，不用手动传入
    public function update(User $currentUser, User $user)
    {
        return $currentUser->can('manage_users') || $currentUser->id === $user->id;
    }

    public function manage(User $currentUser, User $user){
        return $currentUser->can('manage_users');
    }

    public function create(User $currentUser, User $user){
        return $currentUser->can('manage_users');
    }

    public function destroy(User $currentUser, User $user){
        return $currentUser->can('manage_users');
    }

}
