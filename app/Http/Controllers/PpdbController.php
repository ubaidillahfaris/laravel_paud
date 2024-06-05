<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Ppdb;
use App\Models\TahunPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class PpdbController extends Controller
{

    public function index(){
        return Inertia::render('Ppdb/Index');
    }

    public function create(){
        return Inertia::render('Ppdb/Create');
    }

    public function validasi(int $gelombang_id){
        return Inertia::render('PpdbValidasi/PpdbValidasi',[
            'gelombang_id' => $gelombang_id
        ]);
    }

    public function dataSiswa(Request $request, int $gelombangId){
        $length = $request->length??10;
        $search = $request->search??null;

        // get pendaftar by gelombang id
        $pendaftar = Ppdb::where('ppdb_master_id',$gelombangId)
        ->when($search, function($sub) use($search){
            $sub->whereAny([
                'nama_lengkap',
                'nama_panggilan',
                'nik',
                'nama_ayah',
                'no_hp_ayah',
                'nama_ibu',
                'no_hp_ibu',
                'alamat',
            ],'ILIKE',"%$search%");
        })
        ->orderBy('nama_lengkap','ASC')
        ->paginate($length);

        return response()
        ->json($pendaftar);
    }


    public function createGroup(Request $request){
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function store(Request $request, AnakController $anakController){
        
        $path = '';
        DB::beginTransaction();
        try {
            if ($request->hasFile('file')) {
                $path = $this->moveImage($request->file('file'));
            }

            $data = $request->validate([
                'ppdb_master_id' => 'required',
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
                'provinsi' => 'nullable',
                'kota_kab' => 'nullable',
                'kecamatan' => 'nullable',
                'kelurahan' => 'nullable',
                'alamat' => 'nullable',
            ]);

            $data['foto'] = $path;
            $data['ortu_user_id'] = Auth::user()->wali->id;
            
            $check = Ppdb::where('nik', $data['nik'])
            ->where('ppdb_master_id',$data['ppdb_master_id'])
            ->where('status','verified')
            ->first();
        
            if (isset($check)) {
                return response()
                ->json([
                    'message' => 'Anak sudah mendaftar'
                ],400);
            }

            $ppdb = Ppdb::create(
                $data
            );

            $dataAnak = new Request($data);
            $anakController->store($dataAnak);

            DB::commit();
            return response()
            ->json([
                'message' => 'Berhasil mendaftar ppdb',
                'data' => [
                    'ppdb_master_id' => intVal($request->ppdb_master_id),
                    'ortu_id' => intVal($data['ortu_user_id']),
                    'ppdb_id' => intVal($ppdb->id),
                ]
            ]);
        }
        catch (ValidationException $th){
            $this->deleteImage($path);
            Log::error($th->getMessage(),[$th]);
            DB::rollBack();
            return response()
            ->json([
                'message' => 'Gagal mendaftar ppdb'
            ],400);
        }
        catch (\Throwable $th) {
            $this->deleteImage($path);
            Log::error($th->getMessage(),[$th]);
            DB::rollBack();
            return response()
            ->json([
                'message' => 'Gagal mendaftar ppdb'
            ],500);
        }
    }

    public function showPpdbUser(Request $request){
        try {
            $user = Auth::user();
            $wali = $user->wali;

            $ppdb = Ppdb::with('sekolah','ppdbMaster','kota_lahir','kota_kab','provinsi','kecamatan','kelurahan')
            ->where('ortu_user_id',$wali->id)
            ->orderBy('created_at','DESC')
            ->paginate();

            return response()
            ->json($ppdb);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [$th]);
            return response()
            ->json([
                'message' => 'Gagal mengambil data'
            ],500);
        }
    }

    public function show(Request $request){
        try {
            $length = $request->length??10;
            $search = $request->search??null;
            $provinsi = $request->provinsi??null;
            $kota = $request->kota??null;
            $kecamatan = $request->kecamatan??null;
            $kelurahan = $request->kelurahan??null;
            $sortCol = $request->sortCol??null;
            $sortDir = $request->sortDir??null;

            $ppdb = Ppdb::with('ppdbMaster','kota_lahir','kota_kab','provinsi','kecamatan','kelurahan')
            ->when($search,function($sub) use($search){
                $sub->whereAny(['nama_lengkap','nama_panggilan'],'ilike',"%$search%");
            })
            ->when($provinsi, function($sub) use($provinsi){
                $sub->where('provinsi',$provinsi);
            })
            ->when($kota, function($sub) use($kota){
                $sub->where('kota_kab',$kota);
            })
            ->when($kecamatan, function($sub) use($kecamatan){
                $sub->where('kecamatan',$kecamatan);
            })
            ->when($kelurahan, function($sub) use($kelurahan){
                $sub->where('kelurahan',$kelurahan);
            })
            ->when($sortCol,function($sub) use($sortCol,$sortDir){
                $sub->orderBy($sortCol,$sortDir);
            })
            ->orderBy('created_at','DESC')
            ->paginate($length);
            return response()
            ->json($ppdb);

        } catch (\Throwable $th) {
            Log::error($th->getMessage(),[$th]);
            return response()
            ->json([
                'message' => 'Gagal menampilkan data'
            ],500);
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

    public function deleteImage($path):void{
        if (Storage::exists($path)) {
            Storage::delete($path);
        } 
    }

    public function detailPendaftar(int $ppdb_id){
        // mendapatkan data ppdb
        $ppdb = Ppdb::with('kota_lahir','sekolah')->find($ppdb_id);


        // cek tahun ajaran aktif dan get kelas
        $tahunAjaran = TahunPelajaran::with('kelas')->where('sekolah_id',$ppdb->sekolah->id)
        ->first();

        $kelas = [];
        if (count($tahunAjaran->kelas) > 0) {
            $kelas = $tahunAjaran->kelas;
        }
        
        return Inertia::render('PpdbValidasi/DetailDanValidasi',[
            'data_ppdb' => $ppdb,
            'kelas' => $kelas
        ]);
    }

    public function validasiSiswa(Request $request, int $ppdb_id){
        try {
            
            $request->validate([
                'kelas_id' => 'nullable',
                'status' => 'required'
            ]);

            if ($request->status == 'not verified' &&  $request->kelas_id == null) {
                return response()
                ->json([
                    'message' => 'Isi data kelas',
                ],400);
            }


            Ppdb::where('id',$ppdb_id)
            ->update(array_filter([
                'kelas_id' => $request->kelas_id,
                'status' => $request->status
            ]));

            return response()
            ->json([
                'message' => 'Berhasil memvalidasi calon pendaftar',
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'messsage' => 'Gagal memvalidasi calon pendaftar',
                'description' => $th->getMessage()
            ],500);
        }
    }
}
