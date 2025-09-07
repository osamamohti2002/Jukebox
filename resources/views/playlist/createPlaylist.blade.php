@extends('layouts.app')

@section('content')
<div class="w-[70%] mx-auto mt-10">
  @include('shared._flash')

  <div class="bg-[#111111] text-white border border-[#04fffb] rounded-lg p-6 shadow-lg">
    <h1 class="text-2xl font-bold mb-4">Playlist aanmaken</h1>

    <form action="{{ route('playlists.store') }}" method="POST" class="mb-6">
      @csrf
      <label class="block mb-2">Naam</label>
      <input type="text" name="name" value="{{ old('name') }}"
             class="w-full bg-[#111111] text-white border border-[#04fffb] rounded px-4 py-2 mb-4">
      @error('name') <p class="text-red-400 text-sm mb-3">{{ $message }}</p> @enderror

      <fieldset class="mb-4">
        <legend class="block mb-2">Bron</legend>

        <label class="flex items-center gap-2 mb-2">
          <input type="radio" name="source" value="empty" {{ old('source', 'empty') === 'empty' ? 'checked' : '' }}>
          <span>Lege playlist (ik voeg later nummers toe)</span>
        </label>

        <label class="flex items-center gap-2 {{ $tempCount ? '' : 'opacity-50' }}">
          <input type="radio" name="source" value="temp" {{ old('source') === 'temp' ? 'checked' : '' }} {{ $tempCount ? '' : 'disabled' }}>
          <span>Vullen met tijdelijke playlist ({{ $tempCount }} nummer{{ $tempCount === 1 ? '' : 's' }})</span>
        </label>
      </fieldset>

      <button class="px-4 py-2 border border-[#04fffb] rounded">Aanmaken</button>
      <a href="{{ route('playlist.temp.index') }}" class="ml-3 underline">Bekijk tijdelijke playlist</a>
    </form>

    {{-- (Optioneel) Toon een preview van tijdelijke playlist --}}
    {{-- @if($tempCount)
      <h2 class="text-xl font-semibold mb-3">Voorbeeld: tijdelijke playlist</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        @foreach ($tempSongs as $song)
          @php
            $mm = floor($song->duration / 60);
            $ss = str_pad($song->duration % 60, 2, '0', STR_PAD_LEFT);
          @endphp
          <div class="bg-[#151515] border border-[#04fffb] rounded p-4">
            <div class="text-lg font-semibold">{{ $song->song }}</div>
            <div class="text-sm text-gray-300">Duur: {{ $mm }}:{{ $ss }} · Genre: {{ $song->genre }}</div>
          </div>
        @endforeach
      </div>
    @endif --}}
  </div>
</div>
@endsection
