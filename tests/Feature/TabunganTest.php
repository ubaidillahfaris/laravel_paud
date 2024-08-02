<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TabunganTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_mutasi_masuk(): void
    {
        $user = User::where('role','admin')->first();
        $response = $this->actingAs($user)->post(route('tabungan.mutasi_masuk'),[
            'siswa_id' => 4,
            'tahun_ajaran_id' => 7,
            'jenis' => 'deposit',
            'mutasi_masuk' => 100000,
            'tanggal_transaksi' => date('Y-m-d'),
            'keterangan' => 'tabungan pertama'
        ]);

        $response->assertStatus(200);
    }

    public function test_mutasi_keluar(): void
    {
        $user = User::where('role','admin')->first();
        $response = $this->actingAs($user)->post(route('tabungan.mutasi_keluar'),[
            'siswa_id' => 4,
            'tahun_ajaran_id' => 7,
            'jenis' => 'withdraw',
            'mutasi_keluar' => 100000,
            'tanggal_transaksi' => date('Y-m-d'),
            'keterangan' => 'tabungan pertama'
        ]);

        $response->assertStatus(200);
    }

    public function test_update_mutasi(): void
    {
        $user = User::where('role','admin')->first();
        $response = $this->actingAs($user)->put(route('tabungan.update',['transaksi_id' => 7]),[
            'jenis' => 'withdraw',
            'mutasi_masuk' => null,
            'mutasi_keluar' => 120000,
            'tanggal_transaksi' => date('Y-m-d'),
            'keterangan' => 'tabungan pertama'
        ]);

        $response->assertStatus(200);
    }
    
    public function test_destroy(): void
    {
        $user = User::where('role','admin')->first();
        $response = $this->actingAs($user)->delete(route('tabungan.destroy',['transaksi_id' => 8]));

        $response->assertStatus(200);
    }
}
