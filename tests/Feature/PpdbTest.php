<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Testing\Fakes\Fake;

class PpdbTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store(): void
    {   
        $faker = \Faker\Factory::create('en_US');
        $IdFaker = new \Faker\Provider\id_ID\Person($faker);
        $usFaker = new \Faker\Provider\en_Us\Address($faker);

        $data  = [
            'kelas_id' => $faker->numberBetween(1,100),
            'nama_lengkap' => $faker->name(),
            'nama_panggilan' => $faker->userName(),
            'nik' => $IdFaker->nik(),
            'anak_ke' => $faker->numberBetween(1,4),
            'jenis_kelamin' => $faker->randomElement(['male', 'female']),
            'kota_lahir' =>  $faker->randomElement([3506,3571]),
            'tanggal_lahir' => $faker->date('Y-m-d'),
            'nama_ayah' => $faker->name('male'), 
            'pekerjaan_ayah' => $faker->jobTitle(),
            'no_hp_ayah' => $faker->phoneNumber(),
            'nama_ibu' => $faker->name('female'),
            'pekerjaan_ibu' => $faker->jobTitle(),
            'no_hp_ibu' => $faker->phoneNumber(),
            'foto' => UploadedFile::fake()->image('image.jpg'),
            'provinsi' => 35,
            'kota_kab' => $faker->randomElement([3506,3571]),
            'kecamatan' => 357101,
            'kelurahan' => 3571011011,
            'alamat' => $usFaker->address(),
        ];
        $response = $this->post(route('ppdb.store'),$data);
        $response->assertStatus(200);
    }
}
