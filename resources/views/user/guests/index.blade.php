<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Tamu</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-5 rounded shadow">
                <div class="flex justify-between mb-4">
                    <a href="{{ route('user.guests.create') }}"
                        class="bg-indigo-600 text-white px-4 py-2 rounded">Tambah Tamu</a>
                </div>
                @include('components.guest-filters', ['categories' => $categories])
                <div class="overflow-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="p-2 text-left">Nama</th>
                                <th class="p-2 text-left">Instansi</th>
                                <th class="p-2 text-left">Kategori</th>
                                <th class="p-2 text-left">Tanggal</th>
                                <th class="p-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($guests as $g)
                                <tr class="border-b">
                                    <td class="p-2">{{ $g->name }}</td>
                                    <td class="p-2">{{ $g->institution }}</td>
                                    <td class="p-2">{{ $g->category->name ?? '-' }}</td>
                                    <td class="p-2">{{ $g->visit_date?->format('d/m/Y') }}</td>
                                    <td class="p-2">
                                        <a href="{{ route('user.guests.show', $g) }}" class="underline">Lihat</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $guests->withQueryString()->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
