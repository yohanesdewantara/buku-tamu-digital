<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'institution' => 'nullable|string|max:255',
            'purpose' => 'required|string',
            'visit_date' => 'required|date',
            'visit_time' => 'nullable|date_format:H:i',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'guest_category_id' => 'required|exists:guest_categories,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'signature' => 'nullable|string',
            'notes' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama tamu wajib diisi.',
            'name.max' => 'Nama tamu maksimal 255 karakter.',
            'purpose.required' => 'Keperluan wajib diisi.',
            'visit_date.required' => 'Tanggal kunjungan wajib diisi.',
            'visit_date.date' => 'Format tanggal kunjungan tidak valid.',
            'visit_time.date_format' => 'Format waktu kunjungan harus HH:MM.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'guest_category_id.required' => 'Kategori tamu wajib dipilih.',
            'guest_category_id.exists' => 'Kategori tamu tidak valid.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'photo.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
