<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Tamu</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-5 rounded shadow">
                <form method="POST" action="{{ route('admin.guests.update', $guest) }}" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf @method('PUT')
                    @include('partials.guest-form-fields', ['guest' => $guest])
                      <div class="mt-6 flex items-center justify-end gap-3">
        {{-- Tombol Batal (link) --}}
        <a href="{{ route('admin.guests.index') }}"
           class="inline-flex items-center px-4 py-2 rounded-md border border-gray-300 bg-white text-gray-700 hover:bg-gray-50">
            Batal
        </a>
                    <div class="flex justify-end">
                        <button class="bg-indigo-600 text-white px-4 py-2 rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
