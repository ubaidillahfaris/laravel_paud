<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{


    /**
     * show data guru by sekolah id
     */
    public function show(Request $request){
        $user = User::find(Auth::user()->id);
        $sekolah = $user->sekolah;
        $kelas = $request->kelas??null;
        $search = $request->search??null;

        $guru = Guru::where('sekolah_id',$sekolah->id)
        ->when($kelas,function($sub) use($kelas){
            $sub->where('kelas_id',$kelas);
        })
        ->when($search, function($sub) use($search){
            $sub->whereHas('akun',function($rel) use($search){
                $rel->whereAny(['name','email'],'ilike',"%$search%");
            });
        })
        ->paginate();

        return response()
        ->json($guru);

    }

    /**
     * update data guru
     */
    public function update(Request $request, int $userId){
        try {
            
            Guru::updateOrCreate(
                [
                    'user_id' => $userId
                ],
                array_filter(
                    [
                        'sekolah_id' => $request->sekolah_id,
                        'kelas_id' => $request->kelas_id
                    ]
                )
            );

            return response()
            ->json([
                'message' => 'Berhasil menempatkan data guru'
            ]);

        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal menempatkan data guru',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * delete data tautan user dan guru 
     */
    public function destroy(int $id){
        try {
            Guru::where('id',$id)->delete();
            return response()
            ->json([
                'message' => 'Berhasil menghapus tautan guru'
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal menghapus tautan guru',
                'detail' => $th->getMessage()
            ],500);
        }
    }
}
