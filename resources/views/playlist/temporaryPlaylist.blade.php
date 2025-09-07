@extends('layouts.app')

@section('content')
<div class="w-[70%] mx-auto mt-10">
  <div class="bg-[#111111] text-white border border-[#04fffb] rounded-lg p-6 shadow-lg">
    <h1 class="text-2xl font-bold mb-4">Tijdelijke playlist</h1>

    {{-- opslaan-form (alleen NAAM + knop) --}}
    <form action="{{ route('playlist.temp.save') }}" method="POST" class="mb-4">
      @csrf
      <label class="block mb-2">Naam</label>
      <input type="text" name="name" value="{{ old('name') }}"
             class="w-full bg-[#111111] text-white border border-[#04fffb] rounded px-4 py-2 mb-4">
      @error('name') <p class="text-red-400 text-sm mb-2">{{ $message }}</p> @enderror

      <button class="px-4 py-2 border border-[#04fffb] rounded">Opslaan</button>
    </form>

    @if($songs->isEmpty())
      <p class="text-gray-400">Je tijdelijke playlist is leeg of verlopen.</p>
      <a href="{{ route('home') }}" class="inline-block mt-4 underline">Terug naar home</a>
    @else
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @foreach ($songs as $song)
          @php
            $minutes = floor($song->duration / 60);
            $seconds = str_pad($song->duration % 60, 2, '0', STR_PAD_LEFT);
          @endphp

          <div class="bg-[#151515] border border-[#04fffb] rounded p-4 flex flex-col justify-between">
            <div>
              <h3 class="text-lg font-semibold">{{ $song->song }}</h3>
              <p class="text-sm text-gray-300">
                Duur: {{ $minutes }}:{{ $seconds }} · Genre: {{ $song->genre }}
              </p>
            </div>

            {{-- Verwijder-form per item (aparte form, dus NIET genest in de opslaan-form) --}}
            <form action="{{ route('playlist.temp.remove', $song) }}" method="POST" class="mt-4 self-end">
              @csrf
              @method('DELETE')
              <button class="text-red-400 hover:scale-110 transition" type="submit">Verwijderen</button>
            </form>
          </div>
        @endforeach
      </div>

      @php
        $totMin = floor($totalSeconds / 60);
        $totSec = str_pad($totalSeconds % 60, 2, '0', STR_PAD_LEFT);
      @endphp
      <div class="mt-2 text-sm text-gray-300">
        Totale duur: <span class="text-white font-semibold">{{ $totMin }}:{{ $totSec }}</span>
      </div>
    @endif
  </div>
</div>
@endsection
