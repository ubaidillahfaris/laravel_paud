<?php

namespace App\Http\Controllers;

use App\Models\TahunPelajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class TahunPelajaranController extends Controller
{
    public function index(){
        return Inertia::render('TahunAjaran/TahunAjaran');
    }

    public function create(Request $request){
        try {
            // validasi
            $request->validate([
                'start_tahun' => ['required','integer'],
                'end_tahun' => ['required','integer'],
                'semester' => ['required','in:ganjil,genap'],
                'id_kota_pembagian_raport' => ['required'],
                'tanggal_pembagian_raport' => ['required','date']
            ]);

            // get admin sekolah id
            $admin = User::where('id',Auth::user()->id)
            ->with('sekolah')
            ->first();


            // cek tahun ajaran di sekolah terkait
            $cekData = TahunPelajaran::where('sekolah_id',$admin->sekolah->id)
            ->where('start_tahun',$request->start_tahun)
            ->where('end_tahun',$request->end_tahun)
            ->where('semester',$request->semester)
            ->first();

            // kembalikan response jika ditemukan
            if (isset($cekData)) {
                return response()
                ->json([
                    'message' => 'Data tahun ajaran telah diisi',
                    'description' => "data $cekData->semester telah diisi"
                ],500);
            }

            // insert data jika tidak ditemukan tahun ajaran
            TahunPelajaran::create([
                'sekolah_id' => $admin->sekolah->id,
                'start_tahun' => $request->start_tahun,
                'end_tahun' => $request->end_tahun,
                'semester' => $request->semester,
                'id_kota_pembagian_raport' => $request->id_kota_pembagian_raport['code'],
                'tanggal_pembagian_raport' => $request->tanggal_pembagian_raport,
                'is_active' => true,
                'created_by' => $admin->id
            ]);

            return response()
            ->json([
                'message' => 'Berhasil membuat data tahun ajaran'
            ]);
        }   
        catch (ValidationException $th){
            return response()
            ->json([
                'message' => 'Gagal membuat tahun ajaran',
                'description' => $th->getMessage()
            ],400);
        }
        catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal membuat tahun ajaran',
                'description' => $th->getMessage()
            ],500);
        }
    }

    public function showAll(Request $request){
         // mengambil data sekolah user request
        $user = $request->user();
        $sekolahId = null;
        switch ($user->role) {
            case 'guru':
                $sekolahId = $user->guru->sekolah_id;
            break;
            case 'admin':
                $sekolahId = $user->sekolah->sekolah_id;
            break;
        }

        $tahunAjaran = TahunPelajaran::where('sekolah_id',$sekolahId)
        ->where('is_active',true)
        ->orderBy('id','DESC')
        ->first();

        return response()
        ->json($tahunAjaran);
    }

    public function show(Request $request){
        // parameter
        $length = $request->length??10;
        $getTahunAjaran = $request->tahun_ajaran??null;
        $tahun_ajaran = explode('/',$getTahunAjaran);

        // mengambil data sekolah user request
        $user = $request->user();
        $sekolahId = null;
        switch ($user->role) {
            case 'guru':
                $sekolahId = $user->guru->sekolah_id;
            break;
            case 'admin':
                $sekolahId = $user->sekolah->sekolah_id;
            break;
        }
    
        // mengambil data tahun ajaran
        $tahunAjaran = TahunPelajaran::with('kota_pembagian')->when(count($tahun_ajaran) > 1,function($sub) use($tahun_ajaran){
            $sub->where('start_tahun',$tahun_ajaran[0])
            ->where('end_tahun',$tahun_ajaran[1]);
        })
        ->where('sekolah_id',$sekolahId)
        ->orderBy('id','DESC')
        ->paginate($length);
        return response()
        ->json($tahunAjaran);
    }


    /**
     * show active tahun ajaran
     */
    public function show_active(int $sekolahId){
        $tahun_ajaran = TahunPelajaran::where('sekolah_id',$sekolahId)
        ->where('is_active',true)
        ->first();

        return $tahun_ajaran;
    }

    public function update(Request $request, $id){
        try {
            $data = array_filter($request->all());

            TahunPelajaran::where('id',$id)
            ->update([
                'start_tahun' => $data['start_tahun'],
                'end_tahun' => $data['end_tahun'],
                'semester' => $data['semester'],
                'id_kota_pembagian_raport' => $data['id_kota_pembagian_raport']['code'],
                'tanggal_pembagian_raport' => $data['tanggal_pembagian_raport'],
            ]);

            return response()
            ->json([
                'message' => 'Berhasil memperbarui data tahun ajaran',
            ]);

        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal memperbarui data tahun ajaran',
                'description' => $th->getMessage()
            ],500);
        }
    }

    public function updateStatus(Request $request, $id){
        try {

            $status = $request->status;
            TahunPelajaran::where('id',$id)
            ->update([
                'is_active' => $status
            ]);

            return response()
            ->json([
                'message' => 'Berhasil mengubah status tahun ajaran'
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal mengubah status tahun ajaran',
                'description' => $th->getMessage()
            ],500);
        }
    }



    public function delete($id){
        try {
            TahunPelajaran::where('id',$id)
            ->delete();
            return response()
            ->json([
                'message' => 'Berhasil menghapus data',
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal menghapus data',
                'description' => $th->getMessage()
            ],500);
        }
    }
    
}
