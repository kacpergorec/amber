<?php

namespace App\Modules\Common\Providers;

use App\Modules\Post\Models\Post;
use App\Modules\Post\Policies\PostPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Gate::policy(Post::class, PostPolicy::class);
    }
}
