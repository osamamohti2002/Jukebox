@extends('layouts.app')

@section('content')
<div class="w-[70%] mx-auto mt-10">
  <div class="bg-[#111111] text-white border border-[#04fffb] rounded-lg p-6 shadow-lg">

    <h1 class="text-2xl font-bold mb-4">Mijn Playlists</h1>

    @if ($playlists->isEmpty())
      {{-- Lege staat: buiten (of full-span in) de grid voor mooie layout --}}
      <div class="bg-[#111111] border border-[#04fffb] rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-2">Nog geen playlists</h2>
        <p class="text-gray-300 mb-4">Maak je eerste playlist om nummers te verzamelen.</p>
        <a href="{{ route('playlists.create') }}"
           class="inline-block bg-[#04fffb] text-black px-4 py-2 rounded hover:bg-[#03dad8] transition">
          Nieuwe playlist maken
        </a>
      </div>
    @else
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($playlists as $playlist)
          <div class="bg-[#151515] border border-[#04fffb] rounded p-4 flex flex-col justify-between">
            <div class="flex items-center justify-between mb-2">
              <a href="{{ route('playlists.show', $playlist) }}" class="hover:text-[#04fffb]">
                <h2 class="text-lg font-semibold">{{ $playlist->name }}</h2>
              </a>

              <form action="{{ route('playlists.destroy', $playlist) }}"
                    method="POST"
                    onsubmit="return confirm('Weet je zeker dat je deze playlist wilt verwijderen?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="text-red-500 hover:text-red-400 font-bold text-lg"
                        aria-label="Verwijderen"
                        title="Verwijderen">×</button>
              </form>
            </div>

            {{-- Optioneel: extra info zoals aantal nummers --}}
            @isset($playlist->songs_count)
              <p class="text-sm text-gray-300">{{ $playlist->songs_count }} nummers</p>
            @endisset
          </div>
        @endforeach
      </div>
    @endif

  </div>
</div>
@endsection
