<?php

namespace App\Http\Controllers;

use App\Models\AdminSekolah;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AdminSekolahController extends Controller
{
    public function addAdminSekolah(Request $request){

        try {
            $request->validate([
                'user_id' => 'required',
                'sekolah_id' => 'required'
            ]);

            $this->store($request->user_id, $request->sekolah_id);
            return response()
            ->json([
                'message' => 'Berhasil menambahkan admin'
            ]);
        } 
        catch (ValidationException $th){
            Log::error($th->getMessage(),[$th]);
            return response()
            ->json([
                'message' => $th->getMessage()
            ], 400);
        }
        catch (\Throwable $th) {
            Log::error($th->getMessage(),[$th]);
            return response()
            ->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function deleteAdmin($user_id){
        try {
            AdminSekolah::where('user_id',$user_id)
            ->delete();
            return response()
            ->json([
                'message' => 'Berhasil menghapus admin sekolah'
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(),[$th]);
            return response()
            ->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function restoreAdmin($user_id){
        try {
            $adminSekolahTrashed = AdminSekolah::withTrashed()
            ->where('user_id',$user_id)
            ->first();
            $adminSekolahTrashed->restore();
            return response()
            ->json([
                'message' => 'Berhasil memulihkan admin sekolah'
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(),[$th]);
            return response()
            ->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function store(int $user_id, int $sekolah_id){
        try {

            $user = User::find($user_id);
            if (!isset($user)) {
                throw new Exception('user tidak ditemukan');
            }

            AdminSekolah::create([
                'user_id' => $user_id,
                'sekolah_id' => $sekolah_id,
            ]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
