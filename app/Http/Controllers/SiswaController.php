<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SiswaController extends Controller implements HasMiddleware
{

    protected $sekolah_id;

    public static function middleware(): array
    {
        return ['sekolah'];
    }

    public function __construct(Request $request) {
        $this->sekolah_id = $request->attributes->get('sekolah_id');
    }

    /**
     * show index siswa page
     */ 
    public function index($kelas_id){
        return Inertia::render('Siswa/Index',[
            'kelas_id'=>$kelas_id
        ]);
    }

    /**
     * show siswa data json
     */
    public function store(Request $request){
        try {
            $data = $request->validate([
                'kelas_id' => 'nullable',
                'nama_lengkap' => 'required',
                'nama_panggilan' => 'required',
                'nik' => 'required',
                'anak_ke' => 'required',
                'jenis_kelamin' => 'required',
                'kota_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'nama_ayah' => 'required',
                'pekerjaan_ayah' => 'required',
                'no_hp_ayah' => 'nullable',
                'nama_ibu' => 'required',
                'pekerjaan_ibu' => 'required',
                'no_hp_ibu' => 'nullable',
                'foto' => 'nullable',
                'alamat' => 'nullable',
            ]);

            if ($request->hasFile('file')) {
                $path = $this->moveImage($request->file('file'));
            }
            $data['foto'] = $path;
            Siswa::create($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function moveImage($image){
        try {
            $path = $image->store('public/files/siswa');
            return $path;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * show data siswa
     */
    public function show(Request $request, $kelas_id = null){
        $search = $request->search??null;
        $length = $request->length??10;
        $tahunAjaran = $request->tahun_ajaran??null;
        $sekolah_id = $this->sekolah_id;

        $siswa = Siswa::with('kelas','kota_lahir','tabungan')
        ->whereHas('kelas',function($sub) use($sekolah_id){
            $sub->where('sekolah_id',$sekolah_id);
        })
        ->when($kelas_id, function($sub) use($kelas_id){
            $sub->where('kelas_id',$kelas_id);
        })
        ->orderBy('nama_lengkap','ASC')
        ->orderBy('kelas_id','ASC')
        ->paginate($length);

        return response()
        ->json($siswa);

    }
}
