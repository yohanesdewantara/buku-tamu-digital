<form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-3 mb-4">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/instansi/keperluan"
        class="border rounded px-3 py-2">
    <select name="category" class="border rounded px-3 py-2">
        <option value="">Semua Kategori</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
        @endforeach
    </select>
    <input type="date" name="start_date" value="{{ request('start_date') }}" class="border rounded px-3 py-2" />
    <input type="date" name="end_date" value="{{ request('end_date') }}" class="border rounded px-3 py-2" />
    <button class="bg-indigo-600 text-white rounded px-4 py-2">Filter</button>
</form>
