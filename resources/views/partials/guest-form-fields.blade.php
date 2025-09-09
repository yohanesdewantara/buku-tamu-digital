@php
    /** @var \App\Models\Guest|null $g */
    $g = $guest ?? null;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm">Nama *</label>
        <input name="name"
               value="{{ old('name', data_get($g, 'name', '')) }}"
               class="w-full border rounded px-3 py-2" required>
        @error('name')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
    </div>

    <div>
        <label class="block text-sm">Instansi/Perusahaan</label>
        <input name="institution"
               value="{{ old('institution', data_get($g, 'institution', '')) }}"
               class="w-full border rounded px-3 py-2">
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm">Keperluan *</label>
        <textarea name="purpose" class="w-full border rounded px-3 py-2" required>{{ old('purpose', data_get($g, 'purpose', '')) }}</textarea>
    </div>

    <div>
        <label class="block text-sm">Tanggal Kunjungan *</label>
        <input type="date" name="visit_date"
               value="{{ old('visit_date', $g?->visit_date ? \Illuminate\Support\Carbon::parse($g->visit_date)->format('Y-m-d') : '') }}"
               class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="block text-sm">Waktu (opsional)</label>
        <input type="time" name="visit_time"
               value="{{ old('visit_time', $g?->visit_time?->format('H:i') ?? '') }}"
               class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="block text-sm">Telepon</label>
        <input name="phone"
               value="{{ old('phone', data_get($g, 'phone', '')) }}"
               class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="block text-sm">Email</label>
        <input type="email" name="email"
               value="{{ old('email', data_get($g, 'email', '')) }}"
               class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="block text-sm">Kategori *</label>
        <select name="guest_category_id" class="w-full border rounded px-3 py-2" required>
            <option value="">Pilih...</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    @selected(old('guest_category_id', data_get($g, 'guest_category_id')) == $cat->id)>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
        @error('guest_category_id')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
    </div>

    <div>
        <label class="block text-sm">Foto (opsional)</label>
        <input type="file" name="photo" accept="image/*" class="w-full border rounded px-3 py-2">
        @if(data_get($g, 'photo'))
            <img src="{{ asset('storage/' . data_get($g, 'photo')) }}" class="mt-2 h-24 rounded border" />
        @endif
        @error('photo')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm">Tanda Tangan Digital (opsional)</label>
        @include('components.signature-pad')
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm">Catatan</label>
        <textarea name="notes" class="w-full border rounded px-3 py-2">{{ old('notes', data_get($g, 'notes', '')) }}</textarea>
    </div>
</div>
