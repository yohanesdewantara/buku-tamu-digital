<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-5 rounded shadow">
                    <div class="text-gray-500">Kunjungan Hari Ini (Semua)</div>
                    <div class="text-3xl font-bold">{{ $todayVisitors }}</div>
                </div>
                <div class="bg-white p-5 rounded shadow">
                    <div class="text-gray-500">Input Saya Hari Ini</div>
                    <div class="text-3xl font-bold">{{ $myTodayGuests }}</div>
                </div>
                <div class="bg-white p-5 rounded shadow">
                    <div class="text-gray-500">Aksi Cepat</div><a href="{{ route('user.guests.create') }}"
                        class="inline-block mt-2 bg-indigo-600 text-white px-4 py-2 rounded">Tambah Tamu</a>
                </div>
            </div>
            <div class="bg-white p-5 rounded shadow">
                <h3 class="font-semibold mb-3">Tamu Terbaru</h3>
                <ul class="divide-y">
                    @foreach($recentGuests as $g)
                        <li class="py-2 flex justify-between">
                            <span>{{ $g->name }} — <span class="text-gray-500">{{ $g->category->name ?? '-' }}</span></span>
                            <span>{{ $g->created_at->format('d/m H:i') }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
