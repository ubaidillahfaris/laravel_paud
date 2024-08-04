<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostAsesmenDokumenHasilKaryaRequest;
use App\Models\AsesmenDokumenKarya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AsesmenDokumenKaryaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostAsesmenDokumenHasilKaryaRequest $request)
    {
        $data = $request->validated();
        $file = null;
        try {
            $file = Storage::put('images/dokumen_hasil_karya',$data['foto']);
            $data['foto'] = $file;
            AsesmenDokumenKarya::create($data);
            return response()->json(['messange' => 'Berhasil membuat asesmen dokumen hasil karya']);
        } catch (\Throwable $th) {
            Storage::delete($file);
            return response()->json([
                'messange' => 'Gagal membuat asesmen dokumen hasil karya',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AsesmenDokumenKarya $asesmenDokumenKarya)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AsesmenDokumenKarya $asesmenDokumenKarya)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostAsesmenDokumenHasilKaryaRequest $request, int $id)
    {
        $data = $request->validated();
        try {
            
            $asesmenDokumenKarya = AsesmenDokumenKarya::findOrFail($id);
            
            $file = Storage::put('images/dokumen_hasil_karya',$data['foto']);
            $data['foto'] = $file;

            Storage::delete($asesmenDokumenKarya->foto);
            
            $asesmenDokumenKarya->update($data);
            
            return response()->json(['message' => "Berhasil mengubah data asesmen dokumen hasil karya."]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Gagal mengubah data asesmen dokumen hasil karya.",
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $asesmenDokumenKarya = AsesmenDokumenKarya::findOrFail($id);
            $file_path = $asesmenDokumenKarya->foto;
            $asesmenDokumenKarya->delete();
            Storage::delete($file_path);
            return response()->json(['message' => "Berhasil menghapus data asesmen dokumen hasil karya."]);
        } catch (\Throwable $th) {
            return response()->json(['message' => "Gagal menghapus data asesmen dokumen hasil karya."],500);
        }
    }
}
