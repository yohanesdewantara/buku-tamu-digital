<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Admin</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Kartu ringkas --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded shadow">
                    <div class="text-gray-500">Hari Ini</div>
                    <div class="text-3xl font-bold">{{ $todayVisitors }}</div>
                </div>
                <div class="bg-white p-5 rounded shadow">
                    <div class="text-gray-500">Minggu Ini</div>
                    <div class="text-3xl font-bold">{{ $weeklyVisitors }}</div>
                </div>
                <div class="bg-white p-5 rounded shadow">
                    <div class="text-gray-500">Bulan Ini</div>
                    <div class="text-3xl font-bold">{{ $monthlyVisitors }}</div>
                </div>
                <div class="bg-white p-5 rounded shadow">
                    <div class="text-gray-500">Total</div>
                    <div class="text-3xl font-bold">{{ $totalVisitors }}</div>
                </div>
            </div>

            {{-- Grafik + Top Instansi --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="bg-white p-5 rounded shadow lg:col-span-2">
                    <h3 class="font-semibold mb-3">Kunjungan Harian (30 hari)</h3>
                    <canvas id="dailyChart" height="120"></canvas>
                </div>
                <div class="bg-white p-5 rounded shadow">
                    <h3 class="font-semibold mb-3">Top Instansi</h3>
                    <ul class="space-y-2">
                        @forelse($topInstitutions as $row)
                            <li class="flex justify-between border-b pb-1">
                                <span>{{ $row->institution }}</span>
                                <span class="font-semibold">{{ $row->total }}</span>
                            </li>
                        @empty
                            <li class="text-gray-500">Belum ada data.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            {{-- Tamu Terbaru --}}
            <div class="bg-white p-5 rounded shadow">
                <h3 class="font-semibold mb-3">Tamu Terbaru</h3>
                <div class="overflow-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left p-2">Nama</th>
                                <th class="text-left p-2">Instansi</th>
                                <th class="text-left p-2">Kategori</th>
                                <th class="text-left p-2">Tanggal</th>
                                <th class="text-left p-2">Dibuat Oleh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentGuests as $g)
                                <tr class="border-b">
                                    <td class="p-2">{{ $g->name }}</td>
                                    <td class="p-2">{{ $g->institution }}</td>
                                    <td class="p-2">{{ $g->category->name ?? '-' }}</td>
                                    <td class="p-2">{{ $g->visit_date?->format('d/m/Y') }}</td>
                                    <td class="p-2">{{ $g->creator->name ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="p-2 text-gray-500" colspan="5">Belum ada data tamu.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        const dailyCtx = document.getElementById('dailyChart').getContext('2d');
        const labels = @json($dailyChart->pluck('date')->map(fn($d)=>date('d/m', strtotime($d))));
        const data = @json($dailyChart->pluck('total'));
        new Chart(dailyCtx, {
            type: 'line',
            data: { labels, datasets: [{ label: 'Kunjungan', data, tension: 0.3 }] },
            options: { scales: { y: { beginAtZero: true } } }
        });
    </script>
</x-app-layout>
