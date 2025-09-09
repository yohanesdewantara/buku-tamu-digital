<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-5 rounded shadow">
                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
                    @csrf @method('PUT')
                    <div>
                        <label class="block text-sm">Nama *</label>
                        <input name="name" value="{{ old('name', $user->name) }}"
                            class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-sm">Email *</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-sm">Password (kosongkan jika tidak diubah)</label>
                        <input type="password" name="password" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm">Role *</label>
                        <select name="role" class="w-full border rounded px-3 py-2" required>
                            <option value="admin" @selected($user->role === 'admin')>Admin</option>
                            <option value="receptionist" @selected($user->role === 'receptionist')>Receptionist</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button class="bg-indigo-600 text-white px-4 py-2 rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
