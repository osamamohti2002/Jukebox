<?php

namespace App\Services;

use App\Models\Song;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

Class PlaylistDraftService
{
    public const TEMP = 'temp';
    public const CREATE = 'create';

    public function __construct(private array $config = [])
    {
        $this->config = $config ?: config('playlist');
    }


    // voeg een song to aan draft (alleen id, uniek)

    public function add(string $context, int $songId)
    {
        $items = $this->items($context);
        if(!in_array($songId, $items, true)){
            $items[] = $songId;
            $this->putItems($context, $items);
            $this->touchExpiryIfTemp($context);
        }

    }

    // verwijderen song uit draft
    public function remove(string $context, int $songId)
    {
        $items = array_values(array_filter($this->items($context), fn ($id) => (int)$id !== (int)$songId));
        $this->putItems($context, $items);
        $this->touchExpiryIfTemp($context);
    }

    // huidige items (array ids) - wist automatisch als Temp verlopen is
    public function items(string $context)
    {
        if($this->isTemp($context)){
            $this->clearIfExpired($context);
        }
        $key = $this->sessionKey($context);
        return Session::get($key, []);
    }

    // alle songs voor deze draft
    public function songs(string $context)
    {
        $ids = $this->items($context);
        return Song::whereIn('id', $ids)->orderBy('song')->get();
    }

    // totale duur in seconden
    public function totalSeconds(string $context)
    {
        return $this->songs($context)->sum('duration');
    }
    
    // draft leeg maken
    public function clear(string $context)
    {
        Session::forget($this->sessionKey($context));
        if($this->isTemp($context)){
            Session::forget($this->expiresKey($context));
        }
    }

    // helpers functions 

    private function putItems(string $context, array $items)
    {
        Session::put($this->sessionKey($context), array_values(array_unique(array_map('intval', $items))));
    }

    private function touchExpiryIfTemp(string $context)
    {
        if(!$this->isTemp($context)) return;
        $minutes = (int)($this->config['temp']['expiry_minutes'] ?? 30);
        Session::put($this->expiresKey($context), Carbon::now()->addMinutes($minutes));
    }

    private function clearIfExpired(string $context)
    {
        $expiresAt = Session::get($this->expiresKey($context));
        if($expiresAt && Carbon::now()->greaterThan(Carbon::parse($expiresAt))){
            $this->clear($context);
        }
    }

    private function isTemp(string $context)
    {
        return $context === self::TEMP;

    }

    private function sessionKey(string $context)
    {
        return $this->config[$context]['session_key'];
    }

    private function expiresKey(string $context)
    {
        return $this->config[$context]['expires_key'] ?? 'playlist.null';
    }

}
