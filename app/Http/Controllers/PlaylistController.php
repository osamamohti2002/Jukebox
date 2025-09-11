<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Playlist;
use App\Models\Song;
use App\Services\PlaylistDraftService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PlaylistController extends Controller
{

    public function __construct(private PlaylistDraftService $draft) {}
    /**
        * Display a listing of the resource.
     */

    public function index()
    {
        $playlists = Playlist::all();
        return view('playlist.index', compact('playlists'));
    }

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

        $selectedSongs = $this->draft->songs(PlaylistDraftService::CREATE);
        return view('playlist.createPlaylist', compact('genres', 'selectedGenre', 'songs', 'selectedSongs'));
    }

    public function createAdd(Song $song)
    {
        $this->draft->add(PlaylistDraftService::CREATE, $song->id);
        return back()->with('success', 'Liedje toegevoegd aan selectie.');
    }


    public function createRemove(Song $song)
    {
        $this->draft->remove(PlaylistDraftService::CREATE, $song->id);
        return back()->with('success', 'Liedje verwijderd uit selectie.');
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
        ]);

        $ids = $this->draft->items(PlaylistDraftService::CREATE);
        
        $playlist = Playlist::create([
            'user_id' => Auth::id(),
            'name' => $data['name']
        ]);

        $playlist->songs()->sync($ids);

        $this->draft->clear(PlaylistDraftService::CREATE);

        return redirect()->route('playlists.create')
        ->with('success', 'Playlist opgeslagen als "' . e($playlist->name) . '". ');
    } 
    /**
     * Display the specified resource.
     */
    public function show(Playlist $playlist)
    {
        abort_if($playlist->user_id !== Auth::id(), 403);
        $playlist->load('songs');
        return view('playlist.show', compact('playlist'));
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
