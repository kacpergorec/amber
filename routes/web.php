<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::group(['middleware' => ['auth', 'verified'], 'as' => 'posts.'], function () {
    Route::get('posts', [PostController::class, 'index'])->name('index');
    Route::get('posts/create', [PostController::class, 'create'])->name('create');
    Route::post('posts', [PostController::class, 'store'])->name('store');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('show');
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('edit');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('update');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('destroy');
});

Route::view('profile', 'livewire.profile')
    ->middleware(['auth'])
    ->name('profile');

Route::redirect('/', 'dashboard');

require __DIR__ . '/auth.php';
