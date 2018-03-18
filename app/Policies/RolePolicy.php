<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;

class RolePolicy extends Policy
{

    public function index(User $user, Role $role)
    {
        return $user->can("manage_permissions");
    }

    public function manage(User $user, Role $role)
    {
        return $user->can("manage_permissions");
    }

    public function create(User $user, Role $role)
    {
        return $user->can("manage_permissions");
    }

    public function update(User $user, Role $role)
    {
        return $user->can("manage_permissions");
    }

    public function destroy(User $user, Role $role)
    {
        return $user->can("manage_permissions");
    }
}
