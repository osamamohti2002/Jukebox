@extends('layouts.app')

@section('content')
<div class="w-[70%] mx-auto mt-10">
  @include('shared._flash')

  <div class="bg-[#111111] text-white border border-[#04fffb] rounded-lg p-6 shadow-lg">
    <h1 class="text-2xl font-bold mb-4">Playlist aanmaken</h1>

    {{-- 1) POST-form: naam + geselecteerde songs --}}
    <form action="{{ route('playlists.store') }}" method="POST" class="mb-6">
      @csrf

      {{-- Naam --}}
      <label class="block mb-2">Naam</label>
      <input type="text" name="name" value="{{ old('name') }}"
             class="w-full bg-[#111111] text-white border border-[#04fffb] rounded px-4 py-2 mb-2">
      @error('name') <p class="text-red-400 text-sm mb-3">{{ $message }}</p> @enderror
      <button type="submit" class="px-4 py-2 border border-[#04fffb] rounded">Aanmaken</button>
    </form>

      {{-- 2) Klein GET-form: genre-filter (visueel onder de naam) --}}
      <div class="mt-4 mb-4">
        <form action="{{ route('playlists.create') }}" method="GET" id="genreFilterForm">
          <label class="block mb-2">Genre</label>
          <select name="genre"
                  class="w-full bg-[#111111] text-white border border-[#04fffb] rounded px-4 py-2"
                  onchange="this.form.submit()">
            <option value="">Alle genres</option>
            @foreach ($genres as $g)
              <option value="{{ $g->genre }}" {{ $selectedGenre === $g->genre ? 'selected' : '' }}>
                {{ $g->genre }}
              </option>
            @endforeach
          </select>
          {{-- Geen submit-knop nodig; onchange submit al. Zonder JS kun je een submit-knop tonen. --}}
        </form>
      </div>

      {{-- 3) Songs-lijst met checkboxes (horen bij het POST-form) --}}
      @if($songs->isEmpty())
        <p class="text-gray-400">Geen songs gevonden voor dit filter.</p>
      @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
          @foreach ($songs as $song)
            @php
              $m = floor($song->duration / 60);
              $s = str_pad($song->duration % 60, 2, '0', STR_PAD_LEFT);
            @endphp
            <label class="bg-[#151515] border border-[#04fffb] rounded p-4 flex items-start gap-3 cursor-pointer">
              <input type="checkbox" name="songs[]" value="{{ $song->id }}" class="mt-1">
              <div>
                <a href="/songs/{{ $song->id }}"><div class="text-lg font-semibold">{{ $song->song }}</div></a>
                <div class="text-sm text-gray-300">
                  Duur: {{ $m }}:{{ $s }} · Genre: {{ $song->genre }}
                </div>
              </div>
            </label>
          @endforeach
        </div>
      @endif

      {{-- Acties --}}
      <a href="{{ route('playlist.temp.index') }}" class="ml-3 underline">Terug naar tijdelijke playlist</a>
  </div>
</div>
@endsection
