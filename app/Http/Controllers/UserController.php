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
    public function profile(Request $request)
    {
        $user = $request->user();

        // Altijd een lege Collection als fallback, met songs eager loaded
        $playlists = $user->playlists()->with('songs')->latest()->get();

        // Probeer geselecteerde playlist-id uit query te vinden, anders de eerste
        $selectedId = $request->integer('playlist');
        $playlist = $playlists->firstWhere('id', $selectedId) ?? $playlists->first();

        return view('user.profile', [
            'playlists' => $playlists,
            'playlist'  => $playlist, // kan null zijn → view vangt dit af
        ]);
    }


}
