<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
   public function run(): void
{
    User::updateOrCreate(
        ['email' => 'admin@bukutamu.com'],
        ['name' => 'Administrator', 'password' => 'password', 'role' => 'admin']
    );

    User::updateOrCreate(
        ['email' => 'resepsionis@bukutamu.com'],
        ['name' => 'Resepsionis', 'password' => 'password', 'role' => 'receptionist']
    );
}
}
