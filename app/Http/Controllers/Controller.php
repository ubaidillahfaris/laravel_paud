<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\Kelas;
use App\Models\Sekolah;
use App\Models\TahunPelajaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class Controller
{

    public $user;
    public $sekolah;
    public $tahunAjaranAktif;
    public $kelas;

    /**
     * Initializes the controller with the authenticated user's data.
     *
     * Checks if the user is authenticated, then retrieves the user's data and 
     * sets the school, active academic year, and classes based on the user's role.
     *
     * @throws \Throwable if an error occurs during initialization
     */
    public function __construct() {
        try {
            if (Auth::check()) {
                $this->user = User::find(Auth::user()->id);
    
                if (in_array($this->user->role, ['guru','admin'])) {

                    switch ($this->user->role) {
                        case 'guru':
                            $this->sekolah = Sekolah::find($this->user->guru->sekolah_id);
                            break;
                        case 'admin':
                            $this->sekolah = Sekolah::find($this->user->sekolah->id);
                            break;
                            
                    }

        
        
                    $this->tahunAjaranAktif = TahunPelajaran::where('sekolah_id',$this->sekolah->id)
                    ->where('is_active',true)->first();
    
                    $this->kelas = Kelas::where('sekolah_id',$this->sekolah->id)
                    ->where('tahun_pelajaran_id',$this->tahunAjaranAktif->id)
                    ->get();
                }
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [$th]);
            Auth::logout();
            abort(500);
        }
    }
}
