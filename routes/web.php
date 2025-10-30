<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\SocialController;

Route::get('/', [PostController::class,'index'])->name('home');

// Auth routes from Laravel UI
Auth::routes();

// Social login
Route::get('auth/{provider}', [SocialController::class, 'redirect'])->name('social.redirect');
Route::get('auth/{provider}/callback', [SocialController::class, 'callback'])->name('social.callback');

// Posts (resource) - named routes + route model binding automatically
Route::resource('posts', PostController::class);

// Comments (nested behavior)
Route::post('posts/{post}/comments', [CommentController::class,'store'])->name('posts.comments.store');
Route::delete('comments/{comment}', [CommentController::class,'destroy'])->name('comments.destroy');

// Admin routes group
Route::prefix('admin')->name('admin.')->middleware(['auth','role:admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    // manage users and posts (controllers under Admin namespace)
    Route::resource('users','App\Http\Controllers\Admin\UserController');
    Route::resource('posts','App\Http\Controllers\Admin\PostController')->only(['index','destroy','edit','update']);
    Route::resource('comments','App\Http\Controllers\Admin\CommentController');
});
