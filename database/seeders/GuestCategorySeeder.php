<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GuestCategory;

class GuestCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Umum',
                'description' => 'Tamu umum/masyarakat'
            ],
            [
                'name' => 'Mitra',
                'description' => 'Tamu dari perusahaan mitra'
            ],
            [
                'name' => 'VIP',
                'description' => 'Tamu VIP/pejabat'
            ],
            [
                'name' => 'Internal',
                'description' => 'Tamu internal/karyawan'
            ]
        ];

        foreach ($categories as $category) {
            GuestCategory::create($category);
        }
    }
}
