<?php

namespace Database\Seeders;

use App\Models\Kota;
use App\Models\Sekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $location = [
            'provinsi' => 35,
            'kota' => 3571,
            'kecamatan' => 357101,
            'desa' => 3571011011
        ];

        for ($i=0; $i <= 100 ; $i++) { 
            $sekolah = [
                'name' => fake()->streetName(),
                'provinsi_id' => $location['provinsi'],
                'kota_id' => $location['kota'],
                'kecamatan' => $location['kecamatan'],
                'desa' => $location['desa'],
                'image' => fake()->image(),
                'kontak' => fake()->phoneNumber(),
                'akreditasi' => fake()->randomElement(['A','B','C']),
                'lat' => fake()->latitude(),
                'long' => fake()->longitude(),
                'alamat' => fake()->streetAddress()
            ];

            Sekolah::create($sekolah);
        }
    }
}
