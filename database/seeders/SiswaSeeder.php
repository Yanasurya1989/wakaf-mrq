<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Kelas;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua kelas
        $kelasList = Kelas::all();

        foreach ($kelasList as $kelas) {
            // Buat jumlah siswa acak antara 20 - 35
            $jumlahSiswa = rand(20, 35);

            for ($i = 1; $i <= $jumlahSiswa; $i++) {
                Siswa::create([
                    'nama_siswa' => 'Siswa ' . $kelas->nama . ' #' . $i,
                    'kelas_id' => $kelas->id,
                    // Acak: 60% kemungkinan menjadi pewakaf
                    'is_pewakaf' => rand(1, 100) <= 60,
                ]);
            }
        }
    }
}
