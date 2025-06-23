<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
  </head>
  <body>


    @include('nav')
  <main class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Onze producten</h2>

    <!-- Horizontaal scrollbare rij -->
    <div class="flex overflow-x-auto space-x-4 pb-4">
      
      <!-- 20 producten naast elkaar -->
      <!-- Gebruik shrink-0 zodat ze niet krimpen in de flex-row -->
      <!-- Gebruik min-w-[200px] of een vaste breedte -->
      <!-- Kopieer dit blok 20 keer -->
      <div class="shrink-0 min-w-[200px] bg-white rounded-lg shadow hover:shadow-lg transition">
        <img src="https://via.placeholder.com/200x120" alt="Product foto" class="w-full h-32 object-cover rounded-t-lg">
        <div class="p-4">
          <h3 class="text-md font-semibold text-gray-800">Productnaam</h3>
          <p class="text-sm text-gray-500">Tijd: 14:00 - 16:00</p>
          <p class="text-green-600 font-bold mt-1">€29,95</p>
        </div>
      </div>

      <!-- herhaal 19x -->
      <div class="shrink-0 min-w-[200px] bg-white rounded-lg shadow hover:shadow-lg transition">
        <img src="https://via.placeholder.com/200x120" alt="Product foto" class="w-full h-32 object-cover rounded-t-lg">
        <div class="p-4">
          <h3 class="text-md font-semibold text-gray-800">Productnaam</h3>
          <p class="text-sm text-gray-500">Tijd: 15:00 - 17:00</p>
          <p class="text-green-600 font-bold mt-1">€34,99</p>
        </div>
      </div>

      <!-- ... voeg nog 18 extra kaarten toe ... -->

    </div>
  </main>



    <main class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Onze producten</h2>

    <!-- Horizontaal scrollbare rij -->
    <div class="flex overflow-x-auto space-x-4 pb-4">
      
      <!-- 20 producten naast elkaar -->
      <!-- Gebruik shrink-0 zodat ze niet krimpen in de flex-row -->
      <!-- Gebruik min-w-[200px] of een vaste breedte -->
      <!-- Kopieer dit blok 20 keer -->
      <div class="shrink-0 min-w-[200px] bg-white rounded-lg shadow hover:shadow-lg transition">
        <img src="https://via.placeholder.com/200x120" alt="Product foto" class="w-full h-32 object-cover rounded-t-lg">
        <div class="p-4">
          <h3 class="text-md font-semibold text-gray-800">Productnaam</h3>
          <p class="text-sm text-gray-500">Tijd: 14:00 - 16:00</p>
          <p class="text-green-600 font-bold mt-1">€29,95</p>
        </div>
      </div>

      <!-- herhaal 19x -->
      <div class="shrink-0 min-w-[200px] bg-white rounded-lg shadow hover:shadow-lg transition">
        <img src="https://via.placeholder.com/200x120" alt="Product foto" class="w-full h-32 object-cover rounded-t-lg">
        <div class="p-4">
          <h3 class="text-md font-semibold text-gray-800">Productnaam</h3>
          <p class="text-sm text-gray-500">Tijd: 15:00 - 17:00</p>
          <p class="text-green-600 font-bold mt-1">€34,99</p>
        </div>
      </div>

      <!-- ... voeg nog 18 extra kaarten toe ... -->

    </div>
  </main>

  @include('footer')
    <script src="{{ asset('js/main.js')}}"></script>
</body>
</html>