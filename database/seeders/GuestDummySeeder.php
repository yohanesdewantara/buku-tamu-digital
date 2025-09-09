<?php

namespace Database\Seeders;

use App\Models\{Guest,GuestCategory,User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class GuestDummySeeder extends Seeder
{
    public function run(): void
    {
        if (GuestCategory::count() === 0) $this->call(GuestCategorySeeder::class);
        if (User::count() === 0) $this->call(UserSeeder::class);

        $cats  = GuestCategory::pluck('id')->all();
        $users = User::pluck('id')->all();

        Guest::factory()
            ->count(50)
            ->sequence(fn () => [
                'guest_category_id' => Arr::random($cats),
                'created_by'        => Arr::random($users),
            ])
            ->create();
    }
}
