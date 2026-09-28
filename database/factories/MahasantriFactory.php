<?php

namespace Database\Factories;

use App\Models\Mahasantri;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Mahasantri>
 */
class MahasantriFactory extends Factory
{
    protected $model = Mahasantri::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state([
                'role' => 'mahasantri',
            ]),

            'nim' => fake()->unique()->numerify('24########'),

            'jurusan' => fake()->randomElement([
                'Sistem Informasi',
                'Teknik Informatika',
                'Manajemen',
                'Pendidikan Agama Islam',
            ]),

            'semester' => fake()->numberBetween(1, 8),

            'kamar' => 'Kamar ' . fake()->numberBetween(1, 20),

            'status' => 'aktif',
        ];
    }
}