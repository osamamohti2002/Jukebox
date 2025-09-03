<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class TempPlaylistController extends Controller
{
    // time-out (in minuten)
    private int $expiryMinutes = 1;

    public function tempIndex(Request $request)
    {
        $this->clearIfExpired();

        $ids   = Session::get('playlist.items', []);
        $songs = Song::whereIn('id', $ids)->orderBy('song')->get();

        $totalSeconds = $songs->sum('duration');

        return view('playlist.temporaryPlaylist', compact('songs', 'totalSeconds'));
    }

    public function tempAdd(Request $request, Song $song)
    {
        $this->clearIfExpired();

        $items = Session::get('playlist.items', []);

        if (!in_array($song->id, $items, true)) {
            $items[] = $song->id;
            Session::put('playlist.items', $items);
        }

        // ✅ juiste vervaltijd gebruiken
        Session::put('playlist.expires_at', Carbon::now()->addMinutes($this->expiryMinutes));

        return back()->with('success', 'Liedje toegevoegd aan je tijdelijke playlist.');
    }

    public function tempRemove(Request $request, Song $song)
    {
        $this->clearIfExpired();

        $items = Session::get('playlist.items', []);
        $items = array_values(array_filter($items, fn ($id) => (int)$id !== (int)$song->id));

        // ✅ gefilterde items terugzetten (niet []!)
        Session::put('playlist.items', $items);

        // Optioneel: ververs expiry bij activiteit
        Session::put('playlist.expires_at', Carbon::now()->addMinutes($this->expiryMinutes));

        // ✅ response teruggeven
        return back()->with('success', 'Liedje verwijderd uit je tijdelijke playlist.');
    }

    private function clearIfExpired(): void
    {
        $expiresAt = Session::get('playlist.expires_at');

        if ($expiresAt && Carbon::now()->greaterThan(Carbon::parse($expiresAt))) {
            Session::forget('playlist.items');
            Session::forget('playlist.expires_at');
        }
    }
}
