<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use App\Services\PlaylistDraftService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class TempPlaylistController extends Controller
{
    public function __construct(private PlaylistDraftService $draft ){}

    public function tempIndex(Request $request)
    {

        $songs = $this->draft->songs(PlaylistDraftService::TEMP);
        $totalSeconds = $this->draft->totalSeconds(PlaylistDraftService::TEMP);

        return view('playlist.temporaryPlaylist', compact('songs', 'totalSeconds'));
    }

    public function tempAdd(Song $song)
    {
        $this->draft->add(PlaylistDraftService::TEMP, $song->id);
        return back()->with('success', 'Liedje toegevoegd aan je tijdelijke playlist.');
    }

    public function tempRemove(Song $song)
    {
        $this->draft->remove(PlaylistDraftService::TEMP, $song->id);
        return back()->with('success', 'Liedje verwijderd uit je tijdelijke playlist.');
    }


    public function saveOrLogin(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100']
        ]);

        // naam in de session bewaren 
        Session::put('playlist.pending_name', $data['name']);

        if(!Auth::check()){
            Session::put('url.intended', route('playlist.temp.finalize'));
            return redirect()->route('login')->with('success', 'login of maak een account aan om je playlist op te slaan');
        }

        return redirect()->route('playlisy.temp.finalize');
    }


    
    public function finalizeSave()
    {    
        $ids = $this->draft->items(PlaylistDraftService::TEMP);
        $name = Session::get('playlist.pending_name');

        if(empty($ids)){
            return redirect()->route('playlist.temp.index')->with('error', 'je tijdelijke playlist is leeg');
        }

        if(empty($name)){
            return redirect()->route('playlist.temp.index')->with('error', 'Geen naam gevonden. Vul een naam in');
        }

        $playlist = Playlist::create([
            'user_id' => Auth::id(),
            'name' => $name
        ]);

        $playlist->songs()->sync($ids);

        Session::forget('playlist.pending_name');
        $this->draft->clear(PlaylistDraftService::TEMP);

        return redirect()->route('profile')
            ->with('success', 'Playlist "' . e($playlist->name) . '" is opgeslagen.');
    }
}
