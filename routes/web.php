<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/songs/{id}', [SongController::class, 'show']);

Route::get('/genre1', function(){
    return view('genres.show');
});


Route::get('/login', [LoginController::class, 'showLogInForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
// Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');


Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');


Route::get('/profile', [UserController::class, 'profile'])
    ->Middleware('auth')
    ->name('profile');


Route::resource('genres', GenreController::class);

Route::get('/temporaryplaylist', function(){
    return view('playlist.temporaryPlaylist');
})->name('temporary_playlist');

Route::get('/add_song', function(){
    return view('songs.allSongs');
});