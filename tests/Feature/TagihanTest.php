<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagihanTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create(): void
    {

        $user = User::where('email','guru@gmail.com')
        ->first();

        $data = [
            'siswa_id'=> 4,
            'status'=> 'send',
            'nominal'=> 100000,
        ];

        $response = $this->actingAs($user)->post(route('tagihan.store'),$data);
        $response->assertStatus(200);
    }

    public function test_bayar(){
        $user = User::where('email','guru@gmail.com')
        ->first();

        $data = [
            'nominal_terbayar' => 100000,
            'tanggal_bayar' => date('Y-m-d'),
            'gambar_faktur' => fake()->image(),
            'tempat_bayar' => fake()->address(),
            'teller' => fake()->name('female')
        ];

        $response = $this->actingAs($user)
        ->put(route('tagihan.bayar',['id' => 1]),$data);
        $response->assertStatus(200);
    }

    public function test_validasi(){
        $user = User::where('email','guru@gmail.com')
        ->first();

        $response = $this->actingAs($user)
        ->put(route('tagihan.validasi_pembayaran',['id' => 1]),['status' => 'validated']);
        $response->assertStatus(200);
    }

    public function test_fetch_by_siswa_id(){
        $user = User::where('email','guru@gmail.com')
        ->first();

        $response = $this->actingAs($user)
        ->get(route('tagihan.show_by_siswa_id',['siswaId' => 4]));
        $response->assertStatus(200);
    }
}
