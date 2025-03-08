<?php

namespace App\Http\Controllers;

use App\Models\ProgramLayanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class ProgramLayananController extends Controller
{

    public function __construct() {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('ProgramLayanan/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * show data as json
     */
    public function data(Request $request){
        $length = $request->length??10;
        $search = $request->search??null;

        $programLayanan = ProgramLayanan::when($search, function($sub) use($search){
            $sub->where('name','ILIKE',"%$search%");
        })
        ->where('sekolah_id',$this->sekolah->id)
        ->paginate($length);

        return response()
        ->json($programLayanan);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required'
        ]);
        
        try {
            ProgramLayanan::create([
                'sekolah_id' => $this->sekolah->id,
                'name' => $request->name
            ]);

            return response()
            ->json([
                'message' => 'Berhasil membuat data program layanan'
            ]);
        } 
        catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal membuat data program layanan',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $length = $request->length??10;
        $sekolah = $this->sekolah;
        
        $programLayanan = ProgramLayanan::where('sekolah_id',$sekolah->id)
        ->paginate($length);
        
        return response()
        ->json($programLayanan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramLayanan $programLayanan)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try {
            ProgramLayanan::where('id',$id)
            ->update([
                'name' => $request->name
            ]);

            return response()
            ->json([
                'message' => 'Berhasil membuat data program layanan',
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal mengubah data program layanan',
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
            ProgramLayanan::where('id',$id)->delete();
            return response()
            ->json([
                'message' => 'Berhasil menghapus data program layanan',
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal menghapus data program layanan',
                'detail' => $th->getMessage()
            ],500);
        }
    }
}
