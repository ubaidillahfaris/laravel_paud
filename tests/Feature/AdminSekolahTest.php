<?php

namespace Tests\Feature;

use App\Models\AdminSekolah;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminSekolahTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_add_admin(): void
    {
        
        $superadmin = User::where('role','superadmin')->first();
        $admin = User::where('role','admin')->first();
        $response = $this->actingAs($superadmin)->post(route('admin_sekolah.add_admin'),[
            'user_id' => $admin->id,
            'sekolah_id' => 1
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_admin(): void{
        $superadmin = User::where('role','superadmin')->first();
        $admin = AdminSekolah::first();

        $response = $this->actingAs($superadmin)
        ->delete(route('admin_sekolah.delete',['user_id' => $admin->user_id]));
        $response->assertStatus(200);

    }

    public function test_restore_admin(): void{
        $superadmin = User::where('role','superadmin')->first();
        $admin = AdminSekolah::withTrashed()->first();

        $response = $this->actingAs($superadmin)
        ->put(route('admin_sekolah.restore',['user_id' => $admin->user_id]));
        $response->assertStatus(200);

    }
}
