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
                'semester' => ['required','in:ganjil, genap'],
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
}
