<?php

namespace App\Modules\Post\Policies;

use App\Modules\Auth\Models\User;
use App\Modules\Post\Models\Post;

class PostPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Post $post): bool
    {
        //todo: check permission
        return true;
    }

    public function create(User $user): bool
    {
        //todo: check permission
        return true;
    }

    public function update(User $user, Post $post): bool
    {
        //todo: check permission
        return true;
    }

    public function delete(User $user, Post $post): bool
    {
        //todo: check permission
        return true;
    }

    public function restore(User $user, Post $post): bool
    {
        //todo: check permission
        return true;
    }

    public function forceDelete(User $user, Post $post): bool
    {
        return false;
    }
}
