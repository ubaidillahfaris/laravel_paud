<?php

namespace App\Http\Controllers;

use App\Http\Requests\PresensiStoreRequest;
use App\Http\Requests\PresensiUpdaterequest;
use App\Models\Presensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
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
    public function store(PresensiStoreRequest $request)
    {
        // $data = $request->validated();
        try {
        
            $userId = Auth::user()->id;
            $data['created_by'] = $userId;
            
            Presensi::create($data);
            return response()
            ->json([
                'message' => 'Berhasil membuat presensi'
            ]);

        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal membuat presensi',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($presensiId)
    {
        try {
            $presensi = Presensi::findOrFail($presensiId);
            return response()->json($presensi);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal menampilkan data presensi',
                'detail' => $th->getMessage()
            ]);
        }
    }

    public function show_all(Request $request)
    {

        $search = $request->search??null;
        $length = $request->length??10;
        $date = $request->date??null;
        $siswa = null;
        $tahunAjaran = $request->tahun_ajaran??null;
        $kelas = null;
        $status = $request->status??null;
        $created_by = $request->created_by??null;
        
        $user = User::find(Auth::user()->id);
        
        switch ($user->role) {
            case 'guru':
                $userSekolah = $user->guru;
                $kelas = $userSekolah->kelas_id;
                break;
            case 'wali':
                $siswa = $request->siswa;
                break;
        }
    
        $presensi = Presensi::with('siswa','kelas','tahun_ajaran','created_by')
        ->when($search != null, function($sub)use($search){
            $sub->whereHas('siswa',function($subSiswa)use($search){
                $subSiswa->whereAny(['nama_lengkap','nama_panggilan','nik'],'ilike',"%$search%");
            });
        })
        ->when($siswa != null, function($sub)use($siswa){
            $sub->where('siswa_id',$siswa);
        })
        ->when($date != null,function($sub)use($date){
            $sub->where('date',$date);
        })
        ->when($tahunAjaran != null, function($sub)use($tahunAjaran){
            $sub->where('tahun_ajaran_id',$tahunAjaran);
        })
        ->when($kelas != null, function($sub)use($kelas){
            $sub->where('kelas_id',$kelas);
        })
        ->when($created_by != null, function($sub)use($created_by){
            $sub->where('created_by',$created_by);
        })
        ->when($status != null, function($sub)use($status){
            $sub->where('status',$status);
        })
        ->paginate($length);

        return response()->json($presensi);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presensi $presensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PresensiUpdaterequest $request, $presensiId)
    {
        $data = $request->validated();
        try {
            $presensi = Presensi::findOrFail($presensiId);
            $presensi->update($data);
            $presensi->save();

            return response()
            ->json([
                'message' => 'Berhasil mengubah data presensi'
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal mengubah data presensi',
                'detail' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($presensiId)
    {
        try {
            Presensi::findOrFail($presensiId)->delete();
            return response()
            ->json([
                'message' => 'Berhasil menghapus data presensi'
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal menghapus data presensi',
                'detail' => $th->getMessage()
            ]);
        }
    }
}
