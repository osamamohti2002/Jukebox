<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SongController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/songs/{id}', [SongController::class, 'show']);

Route::get('/login', function(){
    return view('login');
})->name('login');


Route::get('/registreer', function(){
    return view('registreer');
})->name('registreer');

Route::get('/profile', function(){
    return view('profile');
})->name('profile');


Route::resource('genres', GenreController::class);

