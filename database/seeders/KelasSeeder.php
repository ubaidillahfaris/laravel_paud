<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Sekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sekolah = Sekolah::with('tahun_pelajaran')
        ->limit(10)
        ->whereHas('tahun_pelajaran')
        ->where('id', '>' , 10)->get();
        
        foreach ($sekolah as $key => $value) {
            $kelas = ['A','B','C'];

            foreach ($kelas as $keyKelas => $valueKelas) {
                Kelas::create([
                    'nama' => $valueKelas,
                    'tahun_pelajaran_id' => $value->tahun_pelajaran->id,
                    'sekolah_id' => $value->id
                ]);
            }
        }

    }
}
