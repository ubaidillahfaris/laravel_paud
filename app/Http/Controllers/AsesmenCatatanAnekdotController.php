<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostAsesmenCatatanAnekdotRequest;
use App\Http\Requests\UpdateAsesmenCatatanAnekdotRequest;
use App\Models\AsesmenCatatanAnekdot;
use Illuminate\Http\Request;

class AsesmenCatatanAnekdotController extends Controller
{

    /**
     * Display data catatan anekdot
     */
    public function show(Request $request){
        
    }

    /**
     * Display data catatan anekdot by id
     */
    public function show_by_id(int $id){
        $asesmenCatatanAnekdot = AsesmenCatatanAnekdot::findOrFail($id);
        return response()->json($asesmenCatatanAnekdot);
    }

    /**
     * store data asesmen catatan anekdot
     */
    public function store(PostAsesmenCatatanAnekdotRequest $request){
        $data = $request->validated();
        try {
            AsesmenCatatanAnekdot::create($data);
            return response()->json(['message' => 'Berhasil menambahkan data asesmen catatan anekdot']);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal menambahkan data asesmen catatan anekdot',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * update data asesmen catatan anekdot
     */
    public function update(UpdateAsesmenCatatanAnekdotRequest $request, int $id){
        $data = $request->validated();
        try {
            $asesmenCatatanAnekdot = AsesmenCatatanAnekdot::findOrFail($id);
            $asesmenCatatanAnekdot->update($data);
            return response()->json(['message' => 'Berhasil melakukan update data asesmen catatan anekdot']);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal melakukan update data asesmen catatan anekdot',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * delete data asesmen catatan anekdot
     */
    public function destroy(int $id){
        try {
            $asesmenCatatanAnekdot = AsesmenCatatanAnekdot::findOrFail($id);
            $asesmenCatatanAnekdot->delete();
            return response()->json(['message' => 'Berhasil menghapus data asesmen catatan anekdot']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Gagal menghapus data asesmen catatan anekdot'],500);
        }
    }
}
