<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peserta;
use App\Models\Program;
use App\Models\Pendaftaran;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pesertas = Peserta::all();
        $program = Program::all();

        foreach ($pesertas as $peserta) {
            Pendaftaran::create([
                'id_peserta' => $peserta->id_peserta,
                'id_program' => $program->random()->id_program,
                'tanggal_pendaftaran' => fake()->dateTimeBetween('-6 years', 'now'),
                'status_pendaftaran' => fake()->randomElement([
                    'Menunggu',
                    'Diverifikasi',
                    'Ditolak',
                    'Diterima'
                ]),
                'catatan_admin' => fake()->optional()->sentence(),
            ]);
        }
    }
}
