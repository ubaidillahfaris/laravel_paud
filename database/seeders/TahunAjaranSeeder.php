<?php

namespace Database\Seeders;

use App\Models\Sekolah;
use App\Models\TahunPelajaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sekolah = Sekolah::limit(10)->where('id', '>' , 10)->get();
        foreach ($sekolah as $key => $value) {
            TahunPelajaran::create([
                'sekolah_id' => $value->id,
                'start_tahun' => 2024,
                'end_tahun' => 2025,
                'semester' => 'Genap',
                'id_kota_pembagian_raport' => 3571,
                'tanggal_pembagian_raport' => date('Y-m-d'),
                'is_active' => true,
                'created_by' => 2
            ]);
        }
    }
}
