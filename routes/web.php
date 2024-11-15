<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::resource('posts', PostController::class);
});

Route::view('profile', 'livewire.profile')
    ->middleware(['auth'])
    ->name('profile');

Route::redirect('/', 'dashboard');

require __DIR__ . '/auth.php';
