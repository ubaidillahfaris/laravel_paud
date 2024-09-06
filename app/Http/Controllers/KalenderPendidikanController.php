<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostKalenderPendidikanRequest;
use App\Models\KalenderPendidikan;
use Illuminate\Http\Request;

class KalenderPendidikanController extends Controller
{

    public function __construct() {
        parent::__construct();
    }

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
    public function store(PostKalenderPendidikanRequest $request)
    {
        $data = $request->validated();

        try {
            
            KalenderPendidikan::create($data);

            return response()->json([
                'message' => "Berhasil membuat agenda"
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Gagal membuat agenda",
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * Display all data
     */
    public function show_all(Request $request){
        $search = $request->search;
        $length = $request->length??10;
        $tahun_ajaran = $request->tahun_ajaran??$this->tahunAjaranAktif->id;
        $tanggal = $request->tanggal;

        $kalenderPendidikan = KalenderPendidikan::when($search != null, function($sub)use($search){
            $sub->whereAny(['nama','deskripsi'],'ilike',"%$search%");
        })
        ->when($tanggal != null, function($sub)use($tanggal){
            $sub->where('start_date','<=',$tanggal);
        })
        ->where('sekolah_id',$this->sekolah->id)
        ->where('tahun_ajaran_id',$tahun_ajaran)
        ->paginate($length);

        return response()->json($kalenderPendidikan);
    }

    /**
     * Display the specified resource.
     */
    public function show($kalenderPendidikanId)
    {
        try {
            $kalender = KalenderPendidikan::findOrFail($kalenderPendidikanId);
            return response()->json($kalender);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ],500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KalenderPendidikan $kalenderPendidikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostKalenderPendidikanRequest $request, $kalenderPendidikanId)
    {
        $data = $request->validated();
        try {
            $kalenderPendidikan = KalenderPendidikan::findOrFail($kalenderPendidikanId);
            $kalenderPendidikan->update($data);
            $kalenderPendidikan->save();
            return response()->json([
                'message' => 'Berhasil memperbarui agenda'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal memperbarui agenda',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kalenderPendidikanId)
    {
        try {
            KalenderPendidikan::findOrFail($kalenderPendidikanId)->delete();
            return response()->json([
                'message' => 'Berhasil menghapus agenda'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal menghapus agenda',
                'detail' => $th->getMessage()
            ],500);
        }
    }
}
