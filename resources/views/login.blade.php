@extends('layouts.app')

@section('content')

  <div class="flex items-center justify-center min-h-screen bg-[#151515]">
  <div class="bg-[#111111] text-white p-8 rounded-lg shadow-lg w-full max-w-sm border border-[#04fffb]">
    <h2 class="text-2xl font-bold mb-6 text-center">Inloggen</h2>

    <!-- E-mail -->
    <div class="mb-4">
      <label for="email" class="block mb-2">E-mailadres</label>
      <input
        type="email"
        id="email"
        name="email"
        class="w-full px-4 py-2 rounded bg-[#151515] border border-[#04fffb] text-white focus:outline-none focus:ring-2 focus:ring-[#04fffb]"
        placeholder="jij@example.com"
        required
      />
    </div>

    <!-- Wachtwoord -->
    <div class="mb-6">
      <label for="password" class="block mb-2">Wachtwoord</label>
      <input
        type="password"
        id="password"
        name="password"
        class="w-full px-4 py-2 rounded bg-[#151515] border border-[#04fffb] text-white focus:outline-none focus:ring-2 focus:ring-[#04fffb]"
        placeholder="••••••••"
        required
      />
    </div>

    <!-- Login knop -->
    <button
      type="submit"
      class="w-full bg-[#04fffb] text-black font-semibold py-2 rounded hover:bg-[#03dad8] transition"
    >
      Inloggen
    </button>
  </div>
</div>



@endsection