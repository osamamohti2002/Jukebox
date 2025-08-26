<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/songs/{id}', [SongController::class, 'show']);




Route::get('/login', [UserController::class, 'showLogInForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');

Route::post('/logout', [UserController::class, 'login'])->name('logout');
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register.form');

// Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [UserController::class, 'register'])->name('register');


Route::get('/profile', [UserController::class, 'profile'])
    ->Middleware('auth')
    ->name('profile');


Route::resource('genres', GenreController::class);

