@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-[#151515] text-white">
  <!-- Sidebar -->
<aside class="w-1/4 bg-[#111111] p-6 border-r border-[#04fffb]">
  <div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-bold">Jouw Lijsten</h2>
    <!-- Nieuwe lijst knop -->
    <button class="bg-[#04fffb] text-black px-3 py-1 text-sm rounded hover:bg-[#03dad8] transition">
      +
    </button>
  </div>

  <ul class="space-y-3">
    <li><a href="#" class="block hover:text-[#04fffb]">Workout Vibes</a></li>
    <li><a href="#" class="block hover:text-[#04fffb]">Chill Avond</a></li>
    <li><a href="#" class="block hover:text-[#04fffb]">Gaming Beats</a></li>
    <li><a href="#" class="block hover:text-[#04fffb]">Roadtrip</a></li>
    <li><a href="#" class="block hover:text-[#04fffb]">Focus Mode</a></li>
  </ul>
</aside>


  <!-- Main content -->
  <main class="flex-1 p-8">
    <h2 class="text-2xl font-bold mb-4">Playlist: Workout Vibes</h2>
    <div class="space-y-4">
  <!-- Liedje 1 -->
  <div class="p-4 bg-[#111111] rounded-lg border border-[#04fffb] flex justify-between items-center">
    <div>
      <h3 class="text-lg font-semibold">Eye of the Tiger</h3>
      <p class="text-sm">3:50 - Genre: Rock</p>
    </div>
    <button class="text-red-500 hover:text-red-400 font-bold text-lg">×</button>
  </div>

  <!-- Liedje 2 -->
  <div class="p-4 bg-[#111111] rounded-lg border border-[#04fffb] flex justify-between items-center">
    <div>
      <h3 class="text-lg font-semibold">Stronger</h3>
      <p class="text-sm">4:10 - Genre: Pop</p>
    </div>
    <button class="text-red-500 hover:text-red-400 font-bold text-lg">×</button>
  </div>
</div>

    

</main>
</div>



  
@endsection