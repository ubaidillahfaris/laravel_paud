<?php

namespace Tests\Feature;

use App\Models\ProgramLayanan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProgramLayananTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store(): void
    {

        $user = User::where('email','admin@gmail.com')
        ->with('sekolah')
        ->first();
        
        $response = $this->actingAs($user)->post(route('program_layanan.store'),[
            'sekolah_id' => $user->sekolah->id,
            'name' => 'Kelompok Bermain'
        ]);

        $response->assertStatus(200);
    }

    public function test_update(){
        $user = User::where('email','admin@gmail.com')
        ->first();

        $programLayanan = ProgramLayanan::first();
        $response = $this->actingAs($user)->put(route('program_layanan.update',$programLayanan->id),[
            'name' => 'Kelompok Belajar'
        ]);

        $response->assertStatus(200);
    }

    public function test_delete(){
        $user = User::where('email','admin@gmail.com')
        ->first();
        $programLayanan = ProgramLayanan::first();

        $response = $this->actingAs($user)->delete(route('program_layanan.delete',$programLayanan->id));
        $response->assertStatus(200);

    }
}
