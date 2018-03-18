<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;

class CategoryPolicy extends Policy
{
    public function index(User $user, Category $category)
    {
        return $user->can('manage_article');
    }

    public function create(User $user, Category $category)
    {
        return $user->can('manage_article');
    }

    public function update(User $user, Category $category)
    {
        return $user->can('manage_article');
    }

    public function destroy(User $user, Category $category)
    {
        return $user->can('manage_article');
    }
}
