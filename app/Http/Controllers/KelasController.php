<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class KelasController extends Controller
{
    public function store(Request $request){
        try {
            $request->validate([
                'name' => 'required|string'
            ]);

            Kelas::create([
                'name' => $request->name
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
                'message' => 'Gagal membuat kelas'
            ],400);
        }
        catch (\Throwable $th) {
            Log::error($th->getMessage(), [$th]);
            return response()
            ->json([
                'message' => 'Gagal membuat kelas'
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
