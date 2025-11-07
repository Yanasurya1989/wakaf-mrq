<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = [
            '7 Ibnu Sina',
            '7 Ibnu Rusydi',
            '7 Ibnu Bajah',
            '7 Ibnu Haitam',
        ];

        foreach ($kelas as $nama) {
            Kelas::create(['nama' => $nama]);
        }
    }
}
