<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\OrangTua;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OrangTuaWithUserAndSiswa extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas = Kelas::all();

        foreach ($kelas as $keyKelas => $valueKelas) {
            
            for ($i=0; $i < 10; $i++) { 
                
                $fatherName = fake()->name('male');
                $fatherEmail = fake()->email();
                $motherName = fake()->name('female');
                $motherEmail = fake()->email();
                $jobTitleFather = fake()->jobTitle();
                $jobTitleMother = fake()->jobTitle();
                $fatherPhone = fake()->phoneNumber();
                $motherPhone = fake()->phoneNumber();

                $user = User::create([
                    'name' => $fatherName,
                    'email' => $fatherEmail,
                    'password' => Hash::make('password'),
                    'role' => 'wali'
                ]);

                $orangTua = OrangTua::create([
                    'user_id' => $user->id,
                    'nama_ayah' => $fatherEmail,
                    'nama_ibu' => $motherName,
                    'pekerjaan_ayah' => $fatherEmail,
                    'pekerjaan_ibu' => $motherEmail,
                    'no_ayah' => $fatherPhone,
                    'no_ibu' => $motherPhone,
                    'email_ayah' => $fatherEmail,
                    'email_ibu' => $motherEmail,
                    'provinsi_id' => 35,
                    'kota_id' => 3571,
                    'kecamatan_id' => 357101,
                ]);

                $siswa = Siswa::create([
                    'kelas_id' => $valueKelas->id,
                    'nama_lengkap' => fake()->name(),
                    'nama_panggilan' => fake()->firstName(),
                    'nik' => fake()->randomNumber(),
                    'anak_ke' => fake()->numberBetween(1,3),
                    'jenis_kelamin' => fake()->randomElement(['male','female']),
                    'kota_lahir' => 3571,
                    'tanggal_lahir' => fake()->date(),
                    'nama_ayah' => $fatherName,
                    'pekerjaan_ayah' => $jobTitleFather,
                    'no_hp_ayah' => $fatherPhone,
                    'nama_ibu' => $motherName,
                    'pekerjaan_ibu' => $jobTitleMother,
                    'no_hp_ibu' => $motherPhone,
                    'foto' => fake()->image(),
                    'alamat' => fake()->address(),
                    'ortu_id' => $orangTua->id,
                ]);
            }


        }
    }
}
