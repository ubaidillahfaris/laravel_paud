<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function adminWithSekolah(int $id){
        $user = User::with('sekolah')->find($id);
        return $user;
    }

    /**
     * Update user data
     */
    public function update(PostUserRequest $request, $userId){
        $data = $request->validated();
        try {

            $user = User::findOrFail($userId);
            $user->update($data);
            $user->save();

            return response()->json(['message' => 'Berhasil memperbarui user']);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal memperbarui user',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    
    public function destroy($userId)
    {
        try {
            $user = User::findOrFail($userId);
            $user->delete();
            return response()->json(['message' => 'Berhasil menghapus user']);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal menghapus user',
                'detail' => $th->getMessage()
            ],500);
        }
    }
}
