<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class KelasController extends Controller
{

    public function index(){
        return Inertia::render('Kelas/Kelas');
    }

    public function create(){
        return Inertia::render('Kelas/Create');
    }

    public function edit(int $id){
        $kelas = Kelas::find($id);
        return Inertia::render('Kelas/Edit',[
            'kelas' => $kelas
        ]);
    }

    public function update(Request $request, $id){
        try {
            Kelas::where('id',$id)
            ->update(array_filter([
                'nama' => $request->nama,
                'tahun_pelajaran_id' => $request->tahun_pelajaran_id,
                'sekolah_id' => $request->sekolah_id,
            ]));

            return response()
            ->json([
                'message' => 'Berhasil mengubah data kelas'
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal mengubah data kelas',
                'description' => $th->getMessage()
            ],500);
        }
    }

    public function show(Request $request){
        $length = $request->length??10;
        $search = $request->search??null;

        // mendapatkan id sekolah dari user
        $user = User::where('id',Auth::user()->id)->with('sekolah')
        ->first();

        // mengambil data kelas
        $kelas = Kelas::where('sekolah_id',$user->sekolah->id)
        ->with('tahun_ajaran')
        ->whereHas('tahun_ajaran',function($sub){
            $sub->where('is_active',true);
        })
        ->when($search != null,function($sub) use($search){
            $sub->where('nama','ILIKE',"%$search%");
        })
        ->orderBy('created_at','DESC')
        ->paginate($length);

        return response()
        ->json($kelas);
    }

    public function attachClassToSchoolYear(Request $request){
        try {

            $request->validate([
                'kelas_id' => 'required',
                'tahun_pelajaran_id' => 'required'
            ]);
            $kelasId = $request->kelas_id;
            $tahunPelajaranId = $request->tahun_pelajaran_id;

            // update id tahun ajaran
            Kelas::where('id',$kelasId)
            ->update([
                'tahun_pelajaran_id' => $tahunPelajaranId
            ]);

            return response()
            ->json([
                'message' => 'Berhasi; menambahkan kelas ke tahun ajaran'
            ]);

        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal menambahkan kelas ke tahun ajaran',
                'description' => $th->getMessage()
            ],500);
        }
    }

    public function store(Request $request){
        try {
            $request->validate([
                'name' => 'required|string',
                'id_tahun_ajaran' => 'required'
            ]);

            // get data admin sekolah
            $user = User::where('id',Auth::user()->id)
            ->with('sekolah')
            ->first();
            // create data kelas
            Kelas::create([
                'nama' => $request->name,
                'tahun_pelajaran_id' => $request->id_tahun_ajaran,
                'sekolah_id' => $user->sekolah->id
            ]);

            return response()
            ->json([
                'message' => 'Berhasil membuat kelas'
            ]);
        } 
        catch (ValidationException $th){
            Log::error($th->getMessage(), [$th]);
            return response()
            ->json([
                'message' => 'Gagal membuat kelas',
                'description' => $th->getMessage()
            ],400);
        }
        catch (\Throwable $th) {
            Log::error($th->getMessage(), [$th]);
            return response()
            ->json([
                'message' => 'Gagal membuat kelas',
                'description' => $th->getMessage()
            ],500);
        }
    }

    public function delete($id){
        try {
            Kelas::find($id)->delete();
            return response()
            ->json([
                'message' => 'Berhasil menghapus kelas'
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [$th]);
            return response()
            ->json([
                'message' => 'Gagal menghapus kelas'
            ],500);
        }
    }

}
