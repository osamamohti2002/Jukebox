<nav class="bg-[#111111] text-white px-6 py-4 flex justify-between items-center">

  <!-- Titel links -->
  <a href="{{ route('home')}}" class="hover:text-[#04fffb]">
    <h1 class="text-2xl font-bold border-b-2 border-[#04fffb] inline-block">
      Juke<span class="text-[#04fffb] hover:text-white">box</span>
    </h1>
  </a>

  <!-- Rechterkant: profiel + logout -->
  <div class="flex items-center space-x-4">
    <a href="{{ route('profile') }}" class="hover:text-[#04fffb]">Profiel</a>
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="hover:text-[#04fffb]">Log uit</button>
    </form>
  </div>
</nav>
