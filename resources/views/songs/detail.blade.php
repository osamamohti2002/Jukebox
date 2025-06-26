@php        
        
    $minutes = floor($song->duration / 60);
    $seconds = str_pad($song->duration % 60, 2, '0', STR_PAD_LEFT);
@endphp

@extends('layouts.app')

@section('content')
        <div class="w-[70%] mx-auto mt-10">
      <div class="bg-[#111111] border border-[#04fffb] rounded-lg p-6 shadow-lg grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
        
        <!-- Linkerkant: Artiestfoto -->
        <div class="flex justify-center">
          <img src="{{ asset('images/' . $song->song_image .'.jpg' ) }}" alt="Foto van song.artist.name" class="rounded-lg w-full max-w-sm object-cover shadow-md">
        </div>

        <!-- Rechterkant: Liedje info -->
        <div class="space-y-4 text-white text-lg">
          <h2 class="text-2xl font-bold border-b border-[#04fffb] pb-1">{{ $song->song }}</h2>
          <p><span class="text-[#04fffb] font-semibold">Artiest:</span>{{ $song->artiest }}</p>
          <p><span class="text-[#04fffb] font-semibold">Duur:</span> {{ $minutes }}:{{ $seconds }}</p>
          <p><span class="text-[#04fffb] font-semibold">Genre:</span> {{$song->genre }}</p>
          <div>
            <p class="text-[#04fffb] font-semibold">Omschrijving:</p>
            <p class="text-white/90">{{ $song->description }}</p>
          </div>
        </div>

      </div>
    </div>

@endsection