<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Sekolah;
use App\Models\TahunPelajaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Controller
{

    public $user;
    public $sekolah;
    public $tahunAjaranAktif;
    public $kelas;

    public function __construct() {
        if (Auth::check()) {
            $this->user = User::find(Auth::user()->id);

            if (in_array($this->user->role, ['guru','admin'])) {
                switch ($this->user->role) {
                    case 'guru':
                        $this->sekolah = Sekolah::find($this->user->guru->sekolah_id);
                        break;
                    case 'admin':
                        $this->sekolah = Sekolah::find($this->user->sekolah->sekolah_id);
                        break;
                        
                }
    
    
                $this->tahunAjaranAktif = TahunPelajaran::where('sekolah_id',$this->sekolah->id)
                ->where('is_active',true)->first();

                $this->kelas = Kelas::where('sekolah_id',$this->sekolah->id)
                ->where('tahun_pelajaran_id',$this->tahunAjaranAktif->id)
                ->get();
            }
        }
    }
}
