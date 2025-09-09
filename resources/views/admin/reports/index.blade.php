<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Laporan</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-5 rounded shadow space-y-4">
                @include('components.guest-filters', ['categories' => $categories])
                <div class="flex gap-2">
                    <a class="px-4 py-2 bg-green-600 text-white rounded"
                        href="{{ route('admin.reports.export-excel', request()->query()) }}">Export Excel</a>
                    <a class="px-4 py-2 bg-red-600 text-white rounded"
                        href="{{ route('admin.reports.export-pdf', request()->query()) }}">Export PDF</a>
                </div>


                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-gray-50 p-4 rounded">
                        <div class="text-gray-500">Total</div>
                        <div class="text-2xl font-bold">{{ $totalGuests }}</div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded">
                        <div class="text-gray-500">Hari Ini</div>
                        <div class="text-2xl font-bold">{{ $todayGuests }}</div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded">
                        <div class="text-gray-500">Minggu Ini</div>
                        <div class="text-2xl font-bold">{{ $weeklyGuests }}</div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded">
                        <div class="text-gray-500">Bulan Ini</div>
                        <div class="text-2xl font-bold">{{ $monthlyGuests }}</div>
                    </div>
                </div>


                <div class="overflow-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="p-2 text-left">Nama</th>
                                <th class="p-2 text-left">Instansi</th>
                                <th class="p-2 text-left">Kategori</th>
                                <th class="p-2 text-left">Tanggal</th>
                                <th class="p-2 text-left">Dibuat Oleh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($guests as $g)
                                <tr class="border-b">
                                    <td class="p-2">{{ $g->name }}</td>
                                    <td class="p-2">{{ $g->institution }}</td>
                                    <td class="p-2">{{ $g->category->name ?? '-' }}</td>
                                    <td class="p-2">{{ $g->visit_date?->format('d/m/Y') }}</td>
                                    <td class="p-2">{{ $g->creator->name ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="p-2" colspan="5">Tidak ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
