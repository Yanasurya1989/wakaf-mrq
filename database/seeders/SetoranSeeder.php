<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setoran;
use App\Models\Siswa;

class SetoranSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = Siswa::first(); // ambil satu siswa dulu
        if ($siswa) {
            Setoran::create([
                'siswa_id' => $siswa->id,
                'tanggal' => now(),
                'nominal' => 50000,
                'keterangan' => 'Setoran pertama',
            ]);
        }
    }
}
