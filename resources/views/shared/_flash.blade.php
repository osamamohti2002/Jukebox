@if (session('success'))
  <div 
    x-data="{ show: true }" 
    x-show="show" 
    x-init="setTimeout(() => show = false, 5000)" 
    x-transition
    class="mb-4 border border-[#04fffb] text-[#04fffb] rounded px-4 py-2"
  >
    {{ session('success') }}
  </div>
@endif

@if (session('error'))
  <div 
    x-data="{ show: true }" 
    x-show="show" 
    x-init="setTimeout(() => show = false, 3000)" 
    x-transition
    class="mb-4 border border-[#04fffb] text-[#04fffb] rounded px-4 py-2"
  >
    {{ session('error') }}
  </div>
@endif

@if ($errors->any())
  <div class="mb-4 border border-yellow-400 text-yellow-300 bg-yellow-900/20 rounded px-4 py-2">
    <ul class="list-disc list-inside">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
