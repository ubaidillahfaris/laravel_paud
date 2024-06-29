<?php

namespace App\Http\Controllers;

use App\Models\Rpph;
use App\Models\TahunPelajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RpphController extends Controller
{
    /**
     * store data rpph
     */
    public function store(Request $request, TahunPelajaranController $tahunPelajaranController){
        try {
            $user = User::find(Auth::user()->id);
            $sekolah = $user->sekolah;
            
            $data = $request->validate([
                'kelas_id' => ['required'],
                'kurikulum_id' => ['required'],
                'tema' => ['required'],
                'sub_tema' => ['required'],
                'start_date' => ['nullable','date'],
                'end_date' => ['nullable','date'],
                'guru_id' => ['required'],
                'tujuan_pembelajaran' => ['nullable'],
                'metode' => ['nullable'],
                'sumber_belajar' => ['nullable'],
                'alat_bahan' => ['nullable'],
            ]);

            
            $data['semester_id'] = $tahunPelajaranController->show_active($sekolah->id);

            $rpph = Rpph::create($data);

            return response()
            ->json([
                'message' => 'Berhasil membuat rpph',
                'id_rpph' => $rpph->id
            ]);
        } 
        catch (ValidationException $th){
            return response()
            ->json([
                'message' => 'Gagal membuat rpph',
                'detail' => $th->getMessage()
            ],400);
        }
        catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal membuat rpph',
                'detail' => $th->getMessage()
            ],500);
        }

    }    
    
    /**
     * update data rpph by id
     */
    public function update(Request $request, int $rpphId){
        try {
            $data = $request->validate([
                'kelas_id' => ['required'],
                'kurikulum_id' => ['required'],
                'tema' => ['required'],
                'sub_tema' => ['required'],
                'start_date' => ['nullable','date'],
                'end_date' => ['nullable','date'],
                'guru_id' => ['required'],
                'tujuan_pembelajaran' => ['nullable'],
                'metode' => ['nullable'],
                'sumber_belajar' => ['nullable'],
                'alat_bahan' => ['nullable'],
            ]);

            $data = array_filter($data);

            Rpph::where('id',$rpphId)
            ->update($data);

            return response()
            ->json([
                'message' => 'Berhasil memperbarui data RPPH'
            ]);
        } 
        catch (ValidationException $th){
            return response()
            ->json([
                'message' => 'Gagal memperbarui data RPPH',
                'detail' => $th->getMessage()
            ],400);
        }
        catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal memperbarui data RPPH',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * delete data rpph by id
     */
    public function destroy(int $id){
        try {
            Rpph::where('id',$id)
            ->delete();
            return response()
            ->json([
                'message' => 'Berhasil menghapus data RPPH'
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal menghapus data RPPH',
                'detail' => $th->getMessage()
            ],500);
        }
    }
}
