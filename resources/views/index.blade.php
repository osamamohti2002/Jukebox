@extends('layouts.app')

@section('content')


<div class="w-[70%] mx-auto mt-10">
  <!-- Genre Selectie -->
  <div class="bg-[#111111] text-white border border-[#04fffb] rounded-lg p-6 shadow-lg">
    <h2 class="text-xl font-semibold mb-4">Kies een muziekgenre</h2>
    <form action="{{ route('home')}}">
    <label for="genre" class="block mb-2">Genre:</label>
    <select id="genre" name="genre" name="genre" onchange="this.form.submit()"
      class="w-full bg-[#111111] text-white border border-[#04fffb] rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#04fffb] mb-6">
      <option value="">Alle genres</option>
      @foreach ($genres as $genre ){

          <option value="{{ $genre->genre }}" {{ request('genre') == $genre->genre ? 'selected' : ''}} >{{ $genre->genre }}</option>
      }
        
      @endforeach
    </select>
    </form>

    <!-- Muziek Secties in Grid -->



    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <!-- Liedje 1 -->
      
      @foreach ($songs as $song)
        @php

        $minutes = floor($song->duration / 60);
        $seconds = str_pad($song->duration % 60, 2, '0', STR_PAD_LEFT);
        @endphp
        <a href="/songs/{{ $song->id }}">
        <div class="bg-[#151515] border border-[#04fffb] rounded p-4 flex flex-col justify-between">
          <div>
            <h3 class="text-lg font-semibold">{{ $song->song }}</h3>
            <p class="text-sm text-gray-300">Duur: {{ $minutes }}:{{ $seconds }}· Genre: {{ $song->genre }}</p>
          </div>
          <button class="mt-4 text-[#04fffb] text-2xl font-bold hover:scale-110 transition self-end">+</button>
        </div>
        </a>
      @endforeach


    
      <!-- Voeg meer liedjes toe als je wilt -->
    </div>
  </div>
</div>
  
@endsection