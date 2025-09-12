@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-[#151515] text-white">

  <!-- Sidebar -->
  <aside class="w-1/4 bg-[#111111] p-6 border-r border-[#04fffb]">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl font-bold">Jouw Lijsten</h2>
      <a href="{{ route('playlists.create') }}" class="bg-[#04fffb] text-black px-3 py-1 text-sm rounded hover:bg-[#03dad8] transition">
        +
      </a>
    </div>

    <ul class="space-y-3">
      @forelse ($playlists as $pl)
        @php
          $active = optional($playlist)->id === $pl->id;
        @endphp
        <div class="p-4 bg-[#111111] rounded-lg border border-[#04fffb] flex justify-between items-center">
        <li>
          <a
            href="{{ route('profile', ['playlist' => $pl->id]) }}"
            class="block px-3 py-2 rounded-lg {{ $active ? 'bg-[#111111] text-[#04fffb]' : 'hover:text-[#04fffb]' }}">
            {{ $pl->name }}
          </a>
        </li>
        <form action="{{ route('playlists.destroy', $pl) }}"
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
      @empty
        <li class="text-gray-400 text-sm">Je hebt nog geen playlists.</li>
      @endforelse
    </ul>
  </aside>

  <!-- Main content -->
  <main class="flex-1 p-8">
    @if (empty($playlist))
      <div class="bg-[#111111] border border-[#04fffb] rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-2">Nog geen playlists</h2>
        <p class="text-gray-300 mb-4">Maak je eerste playlist om nummers te verzamelen.</p>
        <a href="{{ route('playlists.create') }}" class="inline-block bg-[#04fffb] text-black px-4 py-2 rounded hover:bg-[#03dad8] transition">
          Nieuwe playlist maken
        </a>
      </div>
    @else
      <h2 class="text-2xl font-bold mb-4">Playlist: {{ $playlist->name }}</h2>

      @if ($playlist->songs->isEmpty())
        <p class="text-gray-400">Nog geen nummers in deze playlist.</p>
      @else
        <div class="space-y-4">
          @foreach ($playlist->songs as $song)
            @php
              $minutes = intdiv($song->duration, 60);
              $seconds = str_pad($song->duration % 60, 2, '0', STR_PAD_LEFT);
            @endphp
            <div class="p-4 bg-[#111111] rounded-lg border border-[#04fffb] flex justify-between items-center">
              <a href="{{ url('/songs/'.$song->id) }}">
                <div>
                  <h3 class="text-lg font-semibold">{{ $song->song }}</h3>
                  <h6 class="text-lg">Artist: {{ $song->artiest }}</h6>
                  <p class="text-sm">Duur: {{ $minutes }}:{{ $seconds }} - Genre: {{ $song->genre }}</p>
                </div>
              </a>
              {{-- TODO: verwijder uit playlist actie (optioneel) --}}
              <form action="" method="POST">
                @csrf
                <button class="text-red-500 hover:text-red-400 font-bold text-lg" type="button">×</button>
              </form>
            </div>
          @endforeach
        </div>
      @endif
    @endif
  </main>

</div>
@endsection
