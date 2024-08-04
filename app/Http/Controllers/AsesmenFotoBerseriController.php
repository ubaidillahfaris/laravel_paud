<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostAsesmenFotoBerseriFileRequest;
use App\Http\Requests\PostAsesmenFotoBerseriRequest;
use App\Models\AsesmenFotoBerseri;
use App\Models\AsesmenFotoBerseriFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AsesmenFotoBerseriController extends Controller
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
    public function store(PostAsesmenFotoBerseriRequest $request, AsesmenFotoBerseriFileController $asesmenFotoBerseriFileController)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $asesmenFotoBerseri = AsesmenFotoBerseri::create($data);
            
            foreach ($data['foto'] as $key => $value) {
                $value['asesmen_foto_id'] = $asesmenFotoBerseri->id;
                $requestFile = new PostAsesmenFotoBerseriFileRequest($value);
                $asesmenFotoBerseriFileController->store($requestFile);
            }

            DB::commit();
            return response()->json(['message' => 'Berhasil membuat asesmen foto berseri.']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal membuat asesmen foto berseri.',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AsesmenFotoBerseri $asesmenFotoBerseri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AsesmenFotoBerseri $asesmenFotoBerseri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostAsesmenFotoBerseriRequest $request, int $id, AsesmenFotoBerseriFileController $asesmenFotoBerseriFileController)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $asesmenFotoBerseri = AsesmenFotoBerseri::findOrFail($id);
            $asesmenFotoBerseri->update($data);

            // delete all synced image
            $asesmenFotoBerseriFileController->delete_from_asesmen($id);
            // re insert image
            foreach ($data['foto'] as $key => $value) {
                $value['asesmen_foto_id'] = $asesmenFotoBerseri->id;

                $requestFile = new PostAsesmenFotoBerseriFileRequest($value);
                $asesmenFotoBerseriFileController->store($requestFile);
            }
            DB::commit();
            return response()->json(['message' => 'Berhasil mengubah asesmen foto berseri.']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal mengubah asesmen foto berseri.',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id,AsesmenFotoBerseriFileController $asesmenFotoBerseriFileController)
    {
        DB::beginTransaction();
        try {

            $asesmenFotoBerseriFileController->delete_from_asesmen($id);
            AsesmenFotoBerseri::findOrFail($id)->delete();
            DB::commit();
            return response()->json([
                'message' => 'Berhasil menghapus asesmen foto berseri'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal menghapus asesmen foto berseri.',
                'detail' => $th->getMessage()
            ],500);
        }
    }
}
