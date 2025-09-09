<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guest>
 */
class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $inst = ['PT Telkom', 'Pemda DIY', 'UNY', 'UGM', 'UKDW', 'BRI', 'Pertamina', 'Kemenkes', 'Kominfo'];
        $purp = ['Meeting', 'Audiensi', 'Interview', 'Kunjungan kerja', 'Koordinasi proyek', 'Pengiriman dokumen'];

        return [
            'name' => $this->faker->name(),
            'institution' => $this->faker->optional()->randomElement($inst),
            'purpose' => $this->faker->randomElement($purp),
            'visit_date' => $this->faker->dateTimeBetween('-60 days', 'now')->format('Y-m-d'),
            'visit_time' => $this->faker->optional()->time('H:i'),
            'phone' => $this->faker->optional()->phoneNumber(),
            'email' => $this->faker->optional()->safeEmail(),
            'photo' => null,
            'signature' => null,
            'notes' => $this->faker->optional()->sentence(),
        ];
    }


}
