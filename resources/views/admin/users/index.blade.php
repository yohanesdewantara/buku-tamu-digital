<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manajemen User</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-5 rounded shadow">
                <div class="flex justify-between mb-4">
                    <a href="{{ route('admin.users.create') }}"
                        class="bg-indigo-600 text-white px-4 py-2 rounded">Tambah User</a>
                </div>
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="p-2 text-left">Nama</th>
                            <th class="p-2 text-left">Email</th>
                            <th class="p-2 text-left">Role</th>
                            <th class="p-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $u)
                            <tr class="border-b">
                                <td class="p-2">{{ $u->name }}</td>
                                <td class="p-2">{{ $u->email }}</td>
                                <td class="p-2">{{ ucfirst($u->role) }}</td>
                                <td class="p-2 flex gap-2">
                                    <a class="underline" href="{{ route('admin.users.edit', $u) }}">Edit</a>
                                    <form method="POST" action="{{ route('admin.users.destroy', $u) }}"
                                        onsubmit="return confirm('Hapus user ini?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">{{ $users->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
