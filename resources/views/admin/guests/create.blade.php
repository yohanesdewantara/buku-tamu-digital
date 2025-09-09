<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Tamu</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-5 rounded shadow">
                <form method="POST" action="{{ route('admin.guests.store') }}" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf
                    @include('partials.guest-form-fields')
                    <div class="flex justify-end">
                        <button class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
