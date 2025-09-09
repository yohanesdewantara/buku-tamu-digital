<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Tamu</h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white p-5 rounded shadow space-y-3">
        <div><span class="text-gray-500">Nama:</span> <strong>{{ $guest->name }}</strong></div>
        <div><span class="text-gray-500">Instansi:</span> {{ $guest->institution }}</div>
        <div><span class="text-gray-500">Keperluan:</span> {{ $guest->purpose }}</div>
        <div>
          <span class="text-gray-500">Tanggal/Waktu:</span>
          {{ $guest->visit_date?->format('d/m/Y') }}
          {{ $guest->visit_time?->format('H:i') }}
        </div>
        <div>
          <span class="text-gray-500">Kontak:</span>
          {{ $guest->phone }}
          {{ $guest->email ? ' / '.$guest->email : '' }}
        </div>
        <div><span class="text-gray-500">Kategori:</span> {{ $guest->category->name ?? '-' }}</div>
        <div><span class="text-gray-500">Catatan:</span> {{ $guest->notes }}</div>

        @if($guest->photo)
          <div>
            <span class="text-gray-500">Foto:</span>
            <img src="{{ asset('storage/'.$guest->photo) }}" alt="foto" class="mt-2 max-h-48 rounded border"/>
          </div>
        @endif

        @if($guest->signature_url)
          <div>
            <span class="text-gray-500">Tanda Tangan:</span>
            <img src="{{ $guest->signature_url }}" alt="ttd" class="mt-2 h-40 border rounded bg-white"/>
          </div>
        @endif
      </div>
    </div>
  </div>
</x-app-layout>
