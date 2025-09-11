@extends('layouts.app')


@section('content')


<div class="w-[70%] mx-auto mt-10">
    <div class="bg-[#111111] text-white border border-[#04fffb] rounded-lg p-6 shadow-lg">
      
<h1 class="text-xl font-semibold mb-4">Playlist: {{ $playlist->name }}</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

  @foreach($playlist->songs as $song)

      <div class="bg-[#151515] border border-[#04fffb] rounded p-4 flex flex-col justify-between">
        <a href="/songs/{{ $song->id }}">
        <h2 class="text-lg font-semibold">{{ $song->song }}</h2>
        <h6 class="text-lg ">Artist: {{ $song->artiest }}</h6>
        <p class="text-sm text-gray-300">Min: {{ floor($song->duration/60) }}:{{ str_pad($song->duration%60,2,'0',STR_PAD_LEFT) }}</p>
        <p class="text-sm text-gray-300">Genre: {{ $song->genre }}</p>
        </a>

        <form action="">
            <button class="text-red-500 hover:text-red-400 font-bold text-lg">×</button>
        </form>
      </div>

  @endforeach

    </div>
    </div>
</div>




@endsection



