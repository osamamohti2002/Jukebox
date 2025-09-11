@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-[#151515] text-white">
  <!-- Sidebar -->
<aside class="w-1/4 bg-[#111111] p-6 border-r border-[#04fffb]">
  <div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-bold">Jouw Lijsten</h2>
    <!-- Nieuwe lijst knop -->
    <a href="{{ route('playlists.create') }}" class="bg-[#04fffb] text-black px-3 py-1 text-sm rounded hover:bg-[#03dad8] transition">
      +
    </a>
  </div>

  <ul class="space-y-3">
    @foreach ($playlists as $pl)
      @php
      $active = isset($playlist) && $playlist->id === $pl->id;
      @endphp      
    <li>
      <a
        href="{{ route('profile', ['playlist' => $pl->id]) }}"
        class="block px-3 py-2 rounded-lg {{ $active ? 'bg-[#111111] text-[#04fffb]' : 'hover:text-[#04fffb]' }}">
        {{ $pl->name }}
      </a>

    </li>
    @endforeach

  </ul>
</aside>


  <!-- Main content -->
  <main class="flex-1 p-8">
    @if ($playlist)
      <h2 class="text-2xl font-bold mb-4">Playlist: {{ $playlist->name }}</h2>
    @endif
    @if ($playlist->songs->isEmpty())
      <p class="text-gray-400">Nog geen nummers in deze playlist.</p>
    @else
    @foreach ($playlist->songs as $song)
    @php
        $minutes = floor($song->duration / 60);
        $seconds = str_pad($song->duration % 60, 2, '0', STR_PAD_LEFT);
    @endphp

      <div class="space-y-4">
        <div class="p-4 bg-[#111111] rounded-lg border border-[#04fffb] flex justify-between items-center">
          <div>
            <h3 class="text-lg font-semibold">{{ $song->song}}</h3>
            <h6 class="text-lg ">Artist: {{ $song->artiest }}</h6>
            <p class="text-sm">Duur: {{ $minutes }}:{{$seconds}} - Genre: {{ $song->genre }}</p>
          </div>
          <form action="">
            <button class="text-red-500 hover:text-red-400 font-bold text-lg">×</button>
          </form>
        </div>
      </div>
    @endforeach
    @endif



</div>

</main>




  
@endsection