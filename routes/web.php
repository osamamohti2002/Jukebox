<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\TempPlaylistController;
use App\Http\Controllers\UserController;
use App\Models\Playlist;
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



// temp playlist Routs 

Route::get('/playlist/temp', [TempPlaylistController::class, 'tempIndex'])->name('playlist.temp.index');

Route::post('/playlist/temp/add/{song}', [TempPlaylistController::class, 'tempAdd'])
    ->name('playlist.temp.add');

Route::post('/playlist/temp/save', [PlaylistController::class, 'store'])->name('playlist.temp.save');

Route::delete('/playlist/temp/remove/{song}', [TempPlaylistController::class, 'tempRemove'])->name('playlist.temp.remove');


//playlsit routes

Route::middleware('auth')->group(function(){
    Route::get('/playlists/create', [PlaylistController::class, 'create'])->name('playlists.create');
    Route::post('/playlists', [PlaylistController::class, 'store'])->name('playlists.store');
    
});