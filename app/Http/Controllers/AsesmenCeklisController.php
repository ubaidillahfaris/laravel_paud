<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostAsesmenCeklis;
use App\Http\Requests\UpdateAsesmenCeklisRequest;
use App\Models\AsesmenCeklis;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class AsesmenCeklisController extends Controller
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
    public function store(PostAsesmenCeklis $request)
    {
        // dd($request->validate);
        $data = $request->validated();
        try {
            AsesmenCeklis::create($data);
            return response()->json(['message' => 'Berhasil membuat data asesmen ceklis.']);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal membuat data asesmen ceklis.',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * Menampilkan daftar siswa asesmen ceklis pada rpph hari ini 
     */
    public function show_by_rpph_today(Request $request){
        $requestParam = $request->validate([
            'kelas' => 'required',
            'tahun_ajaran' => 'nullable',
            'has_asesmen' => ['required',Rule::in('true','false')]
        ]);

        $requestParam['length'] = $request->length??10;
        $now = Carbon::now();

        $siswa = Siswa::where('kelas_id',$requestParam['kelas'])
        ->with('rpph',function($sub) use($now, $requestParam) {
            $sub->where('start_date','>=',$now)
            ->where('end_date','<=',$now);
        })
        ->with('rpph.asesmen_ceklis')
        ->whereHas('rpph.asesmen_ceklis')
        ->paginate($requestParam['length']);

        return response()->json($siswa);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $siswa = $request->siswa??null;
        $kelas = $request->kelas??null;
        

        $asesmenCeklis = AsesmenCeklis::paginate();
    }

    /**
     * Display asesmen ceklis by data id
     */
    public function show_by_id(int $id)
    {
        $asesmenCeklis = AsesmenCeklis::find($id);
        return $asesmenCeklis;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AsesmenCeklis $asesmenCeklis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAsesmenCeklisRequest $request,int $id)
    {
        Log::info('Request Data:', $request->all());
        $data = $request->validated();
        try {
            $asesmenCeklis = AsesmenCeklis::findOrFail($id);
            $asesmenCeklis->update($data);
            return response()->json(['message' => 'Berhasil mengubah data asesmen ceklis.']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Gagal mengubah data asesmen ceklis.'],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AsesmenCeklis $asesmenCeklis)
    {
        try {
            $asesmenCeklis->delete();
            return response()->json(['message' => 'Berhasil menghapus data asesmen ceklis.']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Gagal menghapus data asesmen ceklis.'],500);
        }
    }
}
