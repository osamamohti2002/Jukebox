<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenreController extends Controller
{
    function getSongsOnGenre(){
        return "liedjes van deze genre";
    }
}
