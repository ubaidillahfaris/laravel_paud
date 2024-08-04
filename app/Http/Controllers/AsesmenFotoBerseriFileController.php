<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostAsesmenFotoBerseriFileRequest;
use App\Models\AsesmenFotoBerseriFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AsesmenFotoBerseriFileController extends Controller
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
    public function store(PostAsesmenFotoBerseriFileRequest $request)
    {
        try {
            $data = $request->validate([
                'asesmen_foto_id' => ['required','exists:asesmen_foto_berseris,id'],
                'foto' => ['required','image'],
                'deskripsi' => ['nullable'],
            ]);

            $file = Storage::put('images/foto_berseri',$data['foto']);
            $data['foto'] = $file;
            
            AsesmenFotoBerseriFile::create($data);
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AsesmenFotoBerseriFile $asesmenFotoBerseriFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AsesmenFotoBerseriFile $asesmenFotoBerseriFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AsesmenFotoBerseriFile $asesmenFotoBerseriFile)
    {
        //
    }

    public function delete_from_asesmen(int $asesmenId){
       try {
         
         $file = AsesmenFotoBerseriFile::where('asesmen_foto_id',$asesmenId)->get();
         foreach ($file as $key => $value) {
             $path = $value['foto'];
             Storage::delete($path);
             $value->delete();
         }
       } catch (\Throwable $th) {
        throw $th;
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AsesmenFotoBerseriFile $asesmenFotoBerseriFile)
    {

    }
}
