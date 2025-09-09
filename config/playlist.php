<?php

return [
    'temp' => [
        'session_key' => 'playlist.temp.items',
        'expires_key' => 'playlist.temp.expires_at',
        'expiry_minutes' => env('PLAYLIST_TEMP_EXPIRY', 30),
    ],
    'create' => [
        'session_key' => 'playlist.create.items',
        // geen expiry
    ],
];