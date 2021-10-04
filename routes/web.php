<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserPostController;
use Illuminate\Support\Facades\Route;

// Routes for home page
Route::get('/', function() {
    return view('home');
})->name('home');

// Routes for dashboard page
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Routes for register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Routes for login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

// Route for logout
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// Routes for posts
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts', [PostController::class, 'store']);
Route::delete('/posts/{post}/destroy', [PostController::class, 'destroy'])->name('posts.destroy');

// Routes for likes
Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.likes');
Route::delete('/posts/{post}/like', [LikeController::class, 'destroy']);

// Routes for users post page
Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])->name('users.posts');
