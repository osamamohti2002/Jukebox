<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Song;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
    $genres = Genre::all('genre');


    $selectedGenre = $request->input('genre');
    
    if($selectedGenre){
        $songs = Song::where('genre' , $selectedGenre)->get();
    }else{
        $songs = Song::all();
    }

    return view('/index', compact('genres', 'songs', 'selectedGenre'));
    }
}
