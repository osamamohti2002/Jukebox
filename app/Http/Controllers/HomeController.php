<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Song;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
    $genres = Genre::all('genre');
    $songs = Song::all();

    return view('/index', compact('genres', 'songs'));
    }
}
