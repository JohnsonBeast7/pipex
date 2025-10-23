<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostsController;
use App\Http\Middleware\Logged;
use App\Http\Middleware\NotLogged;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'root'])->name('root');
Route::get('/home', [MainController::class, 'home'])->name('home');

Route::middleware(NotLogged::class)->group(function() {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit'])->name('loginSubmit');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/registerSubmit', [AuthController::class, 'registerSubmit'])->name('registerSubmit');
});
 
Route::middleware(Logged::class)->group(function() {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/make/post', [PostsController::class, 'postMake'])->name('postMake');
Route::post('/postCreate', [PostsController::class, 'postCreate'])->name('postCreate')->middleware(Logged::class);

