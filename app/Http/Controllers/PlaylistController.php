<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $genres = Genre::query()
            ->select('genre')
            ->distinct()
            ->orderBy('genre')
            ->get();

        $selectedGenre = $request->query('genre');

        $songs = Song::query()
            ->when($selectedGenre, fn($query) => $query->where('genre', $selectedGenre))
            ->orderBy('song')
            ->get();

        return view('playlist.createPlaylist', compact('genres', 'selectedGenre', 'songs'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'songs' => ['array'],
            'songs.*' => ['integer']
        ]);
        
        $playlist = Playlist::create([
            'user_id' => Auth::id(),
            'name' => $data['name']
        ]);

        $playlist->songs()->sync($data['songs'] ?? []);

        return redirect()->route('playlists.create')
        ->with('success', 'Playlist opgeslagen als "' . e($playlist->name) . '". ');
    } 
    /**
     * Display the specified resource.
     */
    public function show(Playlist $playlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        //
    }
}
