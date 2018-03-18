<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;

class ArticlePolicy extends Policy
{
    public function index(User $user, Article $article)
    {
        return $user->can('manage_article');
    }

    public function create(User $user, Article $article)
    {
        return $user->can('manage_article');
    }

    public function update(User $user, Article $article)
    {
        return $user->can('manage_article');
    }

    public function destroy(User $user, Article $article)
    {
        return $user->can('manage_article');
    }
}
