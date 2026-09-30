<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peserta;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            Peserta::create([
                'nama' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'nomor_hp' => fake()->phoneNumber(),
                'alamat' => fake()->address(),
                'pendidikan_terakhir' => fake()->randomElement([
                    'SMP',
                    'SMA/SMK',
                    'D1',
                    'D2',
                    'D3',
                    'D4',
                    'S1',
                    'S2'
                ]),
                'usia' => fake()->numberBetween(18, 30),
                'jenis_kelamin' => fake()->randomElement([
                    'Laki-laki',
                    'Perempuan'
                ]),
            ]);
        }
    }
}
