<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Program::create([
            'nama_program' => 'Program Magang (Ginou Jisshu)',
            'deskripsi' => 'Program magang kerja resmi ke Jepang dengan durasi 3 sampai 5 tahun. Cocok untuk lulusan SMA/SMK yang ingin mendapatkan pengalaman kerja, penghasilan, sekaligus mempelajari budaya dan etos kerja Jepang langsung di perusahaan-perusahaan terkemuka.',
            'biaya' => 25000000,
            'durasi' => '6-10 bulan',
            'kuota' => 30,
            'status' => 'Aktif',
            'dokumen_wajib' => 'KTP,KK,Akta,Ijazah,Foto,MCU,Surat_izin,SKCK'
        ]);

        Program::create([
            'nama_program' => 'Tokutei Ginou (Specified Skilled Worker)',
            'deskripsi' => 'Program kerja resmi pemerintah Jepang untuk pekerja terampil asing dengan kontrak hingga 5 tahun. Penghasilan setara pekerja Jepang, peluang perpanjangan, dan dapat membawa keluarga untuk SSW level 2.',
            'biaya' => 35000000,
            'durasi' => '4-10 bulan',
            'kuota' => 20,
            'status' => 'Aktif',
            'dokumen_wajib' => 'KTP,KK,Akta,Ijazah,Foto,MCU,Surat_izin,SKCK,Paspor'
        ]);

        Program::create([
            'nama_program' => 'Sekolah Bahasa Jepang (Nihongo Gakko)',
            'deskripsi' => 'Program belajar bahasa Jepang untuk persiapan studi lanjut ke universitas/senmon gakko di Jepang, atau untuk peningkatan karir. Tersedia kelas reguler dan kelas Kaiwa intensif untuk percakapan sehari-hari.',
            'biaya' => 40000000,
            'durasi' => '6-12 bulan',
            'kuota' => 20,
            'status' => 'Aktif',
            'dokumen_wajib' => 'KTP,KK,Akta,Ijazah,Foto'
        ]);
    }
}
