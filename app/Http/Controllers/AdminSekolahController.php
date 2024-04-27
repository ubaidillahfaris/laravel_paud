<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\AdminSekolah;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Illuminate\Validation\Rules;

class AdminSekolahController extends Controller
{
    public function addAdminPage($sekolah_id){
        return Inertia::render('Sekolah/AddAdmin',[
            'sekolah_id' => $sekolah_id
        ]);
    }

    public function show(Request $request, $sekolah_id){
        $search = $request->search??null;
        
        $adminSekolah = AdminSekolah::with('user')
        ->where('sekolah_id',$sekolah_id)
        ->when($search, function($sub) use($search){
            $sub->whereHas('user',function($user) use($search){
                $user->whereAny(['name','email'],'ILIKE',"%$search%");
            });
        })
        ->paginate(10);

        return response()
        ->json($adminSekolah);
    }

    public function addAdminSekolah(Request $request){

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role' => 'nullable',
                'sekolah_id' => 'required',
                'kontak' => 'nullable'
            ]);

            $registerController = new RegisteredUserController();
            $user = $registerController->createData($request);

            $this->store($user->id, $request->sekolah_id, $request->kontak);
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

    public function store(int $user_id, int $sekolah_id, String $kontak = null ){
        try {

            $user = User::find($user_id);
            if (!isset($user)) {
                throw new Exception('user tidak ditemukan');
            }

            AdminSekolah::create([
                'user_id' => $user_id,
                'sekolah_id' => $sekolah_id,
                'kontak' => $kontak
            ]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
