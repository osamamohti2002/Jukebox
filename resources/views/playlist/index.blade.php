@extends('layouts.app')


@section('content')


<div class="w-[70%] mx-auto mt-10">
    <div class="bg-[#111111] text-white border border-[#04fffb] rounded-lg p-6 shadow-lg">

<h1 class="text-xl font-semibold mb-4">Jouw Playlists</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

  @foreach($playlists as $playlist)

      <div class="bg-[#151515] border border-[#04fffb] rounded p-4 flex flex-col justify-between">
          <div class="flex items-center justify-between mb-4">
        <a href="{{ route('playlists.show', $playlist)}}"><h2 class="text-lg font-semibold">{{ $playlist->name }}</h2></a>

        <form action="">
            <button class="text-red-500 hover:text-red-400 font-bold text-lg">×</button>
        </form>
          </div>
      </div>

  @endforeach

    </div>
    </div>
</div>




@endsection



