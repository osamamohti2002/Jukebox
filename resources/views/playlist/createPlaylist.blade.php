@extends('layouts.app')

@section('content')
<div class="w-[90%] mx-auto mt-10">
  @include('shared._flash')

  <div class="bg-[#111111] text-white border border-[#04fffb] rounded-lg p-6 shadow-lg">
    <h1 class="text-2xl font-bold mb-6">Nieuwe playlist maken</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
      {{-- Kolom 1: Naam + Opslaan --}}
      <div class="md:col-span-1">
        <form action="{{ route('playlists.store') }}" method="POST" class="bg-[#151515] border border-[#04fffb] rounded p-4">
          @csrf
          <label class="block mb-2">Naam</label>
          <input type="text" name="name" value="{{ old('name') }}"
                 class="w-full bg-[#111111] text-white border border-[#04fffb] rounded px-3 py-2 mb-3">
          @error('name') <p class="text-red-400 text-sm mb-3">{{ $message }}</p> @enderror

          <button class="w-full px-4 py-2 border border-[#04fffb] rounded">Opslaan</button>
        </form>

        {{-- Huidige selectie overzicht --}}
        <div class="mt-6 bg-[#151515] border border-[#04fffb] rounded p-4">
          <h2 class="font-semibold mb-2">Huidige selectie</h2>
          <p class="text-sm text-gray-300">
            Aantal nummers: <span class="text-white font-semibold">{{ $selectedSongs->count() }}</span><br>
            Totaal duur:
            @php
              $total = $selectedSongs->sum('duration');
              $m = floor($total / 60);
              $s = str_pad($total % 60, 2, '0', STR_PAD_LEFT);
            @endphp
            <span class="text-white font-semibold">{{ $m }}:{{ $s }}</span>
          </p>
        </div>
      </div>

      {{-- Kolom 2: Genre filter --}}
      <div class="md:col-span-1">
        <form action="{{ route('playlists.create') }}" method="GET" class="bg-[#151515] border border-[#04fffb] rounded p-4">
          <label class="block mb-2">Filter op genre</label>
          <select name="genre" class="w-full bg-[#111111] text-white border border-[#04fffb] rounded px-3 py-2 mb-3"
                  onchange="this.form.submit()">
            <option value="">Alle genres</option>
            @foreach ($genres as $g)
              <option value="{{ $g->genre }}" {{ $selectedGenre === $g->genre ? 'selected' : '' }}>
                {{ $g->genre }}
              </option>
            @endforeach
          </select>
          <noscript>
            <button class="w-full px-4 py-2 border border-[#04fffb] rounded">Toepassen</button>
          </noscript>
        </form>
      </div>

      {{-- Kolom 3-4: Songs --}}
      <div class="md:col-span-2">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          @forelse ($songs as $song)
            @php
              $m = floor($song->duration / 60);
              $s = str_pad($song->duration % 60, 2, '0', STR_PAD_LEFT);
              $inDraft = $selectedSongs->contains('id', $song->id);
            @endphp

            <div class="bg-[#151515] border border-[#04fffb] rounded p-4 flex justify-between items-start">
              <div>
                <div class="text-lg font-semibold">{{ $song->song }}</div>
                <div class="text-sm text-gray-300">Duur: {{ $m }}:{{ $s }} · Genre: {{ $song->genre }}</div>
              </div>

              @if(!$inDraft)
                {{-- + toevoegen --}}
                <form action="{{ route('playlists.create.add', $song) }}" method="POST">
                  @csrf
                  <button class="text-[#04fffb] text-2xl font-bold hover:scale-110 transition" type="submit">+</button>
                </form>
              @else
                {{-- – verwijderen --}}
                <form action="{{ route('playlists.create.remove', $song) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="text-red-400 text-2xl font-bold hover:scale-110 transition" type="submit">–</button>
                </form>
              @endif
            </div>
          @empty
            <p class="text-gray-400">Geen songs gevonden.</p>
          @endforelse
        </div>

        {{-- Overzicht geselecteerde songs --}}
        @if($selectedSongs->isNotEmpty())
          <h3 class="text-xl font-semibold mt-6 mb-3">Geselecteerde nummers</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            @foreach($selectedSongs as $s)
              @php
                $mm = floor($s->duration / 60);
                $ss = str_pad($s->duration % 60, 2, '0', STR_PAD_LEFT);
              @endphp
              <div class="bg-[#151515] border border-[#04fffb] rounded p-3 flex justify-between items-center">
                <div>
                  <div class="font-semibold">{{ $s->song }}</div>
                  <div class="text-sm text-gray-300">Duur: {{ $mm }}:{{ $ss }}</div>
                </div>
                <form action="{{ route('playlists.create.remove', $s) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="text-red-400 text-xl font-bold hover:scale-110 transition" type="submit">–</button>
                </form>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
