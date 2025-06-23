<nav class="bg-white shadow-md">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      
      <!-- Linkerkant: Logo + Home -->
      <div class="flex items-center space-x-4">
        <img src="logo.png" alt="Logo" class="h-8 w-8">
        <a href="#" class="text-xl font-semibold text-gray-800">Home</a>
      </div>

      <!-- Rechterkant: zoekveld + inloggen/registreren -->
      <div class="hidden md:flex items-center space-x-4">
        <input 
          type="text" 
          placeholder="Zoeken..." 
          class="border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <a href="inloggen.html" class="text-gray-700 hover:text-blue-600">Inloggen</a>
        <a href="registeren.html" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-1 rounded-md">Registreren</a>
      </div>

      <!-- Mobiel menu knop -->
      <div class="md:hidden">
        <button id="mobile-menu-button" class="text-gray-800 focus:outline-none">
          ☰
        </button>
      </div>
    </div>

    <!-- Mobiel menu -->
    <div id="mobile-menu" class="hidden md:hidden mt-2 space-y-2">
      <input 
        type="text" 
        placeholder="Zoeken..." 
        class="w-full border border-gray-300 rounded-md px-3 py-1"
      />
      <a href="#" class="block text-gray-700">Inloggen</a>
      <a href="#" class="block text-white bg-blue-600 hover:bg-blue-700 px-4 py-1 rounded-md text-center">Registreren</a>
    </div>
  </div>
</nav>