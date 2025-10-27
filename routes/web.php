<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Logged;
use App\Http\Middleware\NotLogged;
use Illuminate\Support\Facades\Route;

// Root Routes
Route::get('/', [MainController::class, 'root'])
    ->name('root');
Route::get('/home', [MainController::class, 'home'])
    ->name('home');

// Profile Routes
Route::middleware(Logged::class)->group(function() {
    Route::get('/profile/{username}', [ProfileController::class, 'profile'])
        ->name('profile');
    Route::get('/edit/profile', [ProfileController::class, 'profileEdit'])
        ->name('profileEdit');
});

// Auth Routes
Route::group([], function() {
    Route::middleware(NotLogged::class)->group(function() {
        Route::get('/login', [AuthController::class, 'login'])
            ->name('login');
        Route::post('/loginSubmit', [AuthController::class, 'loginSubmit'])
            ->name('loginSubmit');

        Route::get('/register', [AuthController::class, 'register'])
            ->name('register');
        Route::post('/registerSubmit', [AuthController::class, 'registerSubmit'])
            ->name('registerSubmit');
    });

    Route::middleware(Logged::class)->group(function() {
        Route::get('/logout', [AuthController::class, 'logout'])
            ->name('logout');
    });
});

// Posts' Routes
Route::group([], function() {
    Route::get('/make/post', [PostsController::class, 'postMake'])
        ->name('postMake');

    Route::middleware(Logged::class)->group(function() {
        Route::get('/edit/post/{hash}', [PostsController::class, 'postEdit'])
            ->name('postEdit');
        Route::put('/postUpdate/{id}', [PostsController::class, 'postUpdate'])
            ->name('postUpdate');

        Route::post('/postCreate', [PostsController::class, 'postCreate'])
            ->name('postCreate');

        Route::delete('/postDelete/{id}', [PostsController::class, 'postDelete'])
            ->name('postDelete');

        Route::get('post/{hash}', [PostsController::class, 'post'])
            ->name('post');

    });
});

