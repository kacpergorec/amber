<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Post $post): bool
    {
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
