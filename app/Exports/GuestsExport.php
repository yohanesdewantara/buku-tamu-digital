<?php

namespace App\Exports;

use App\Models\Guest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GuestsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Guest::with(['category', 'creator']);

        // Apply filters
        if (!empty($this->filters['start_date']) || !empty($this->filters['end_date'])) {
            $query->filterByDate($this->filters['start_date'] ?? null, $this->filters['end_date'] ?? null);
        }

        if (!empty($this->filters['category'])) {
            $query->filterByCategory($this->filters['category']);
        }

        return $query->orderBy('visit_date', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Instansi',
            'Keperluan',
            'Tanggal Kunjungan',
            'Waktu Kunjungan',
            'Telepon',
            'Email',
            'Kategori',
            'Catatan',
            'Dibuat Oleh',
            'Tanggal Dibuat'
        ];
    }

    public function map($guest): array
    {
        static $no = 1;

        return [
            $no++,
            $guest->name,
            $guest->institution,
            $guest->purpose,
            $guest->visit_date->format('d/m/Y'),
            $guest->visit_time ? $guest->visit_time->format('H:i') : '-',
            $guest->phone,
            $guest->email,
            $guest->category->name,
            $guest->notes,
            $guest->creator->name,
            $guest->created_at->format('d/m/Y H:i')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as header
            1 => ['font' => ['bold' => true]],
        ];
    }
}
