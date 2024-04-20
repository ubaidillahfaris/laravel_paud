<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i=0; $i <= 10 ; $i++) { 
            User::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => 'password',
                'role' => $faker->randomElement(['superadmin','admin','guru','wali'])
            ]);
        }
    }
}
