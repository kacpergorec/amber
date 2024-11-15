<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Models\Post;
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

Route::redirect('/', 'dashboard');

require __DIR__ . '/auth.php';
