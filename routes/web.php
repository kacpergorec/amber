<?php

use App\Modules\Dashboard\Http\Controllers\DashboardController;
use App\Modules\Post\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
});

Route::view('profile', 'livewire.profile.index')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
