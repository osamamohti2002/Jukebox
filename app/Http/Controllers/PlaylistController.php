<?php

namespace App\Http\Controllers;

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
    public function create()
    {
        $tempIds = Session::get('playlist.items', []);
        $tempSongs = Song::whereIn('id', $tempIds)->orderBy('song')->get();
        $tempCount = $tempSongs->count();
        return view('playlist.createPlaylist', compact('tempSongs', 'tempCount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required',
            'string',
            'max:100']
        ]);

        $ids = Session::get('playlist.items', []);

        if(empty($ids)){
            return back()->with('error', 'je tijdelijke playlist is leeg');
        }

        $playlist = Playlist::create([
            'user_id' => Auth::id(),
            'name' => $data['name']
        ]);

        $playlist->songs()->sync($ids);

        return redirect()->route('user.profile')
        ->with('success', 'Playlist opgeslagen als "' . e($playlist->name) . '". ');
    } 
    // hier ben ik gestopt

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
