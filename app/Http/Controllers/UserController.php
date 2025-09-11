<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;
use function PHPUnit\Framework\isReadable;

class UserController extends Controller
{
    public function profile(Request $request){
        $user = Auth::user();
        $playlists = $user->playlists;
        $selectedId = $request->query('playlist') ?? $playlists->first()?->id;

        $playlist = null;
        if($selectedId){
            $playlist = $user->playlists
                ->where('id', $selectedId)
                ->firstOrFail();
        }
        return view('user.profile', compact('user', 'playlists', 'playlist')); // of een ander pad naar jouw profiel-view
    }


}
