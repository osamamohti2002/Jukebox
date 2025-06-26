<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Jukebox</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#151515] flex flex-col min-h-full">

  <!-- Navbar -->
  <nav class="bg-[#111111] text-white px-6 py-4 flex justify-between items-center">
    <!-- Titel links -->
    <a href="{{ route('home')}}" class="hover:text-[#04fffb]"><h1 class="text-2xl font-bold border-b-2 border-[#04fffb] inline-block">Juke<span class="text-[#04fffb] hover:text-white">box</span></h1></a>

    <!-- Rechterkant: links -->
    <div class="space-x-4">
      <a href="{{ route('login') }}" class="hover:text-[#04fffb]">Login</a>
      <a href="{{ route('registreer')}}" class="hover:text-[#04fffb]">Registreren</a>
    </div>
  </nav>

  <main class="flex-grow">
    @yield('content')
  </main>



<!-- Footer -->
<footer class="bg-[#111111] text-white text-center py-4">
    <p class="text-sm">© Jukebox 2025</p>
</footer>

</body>
</html>
