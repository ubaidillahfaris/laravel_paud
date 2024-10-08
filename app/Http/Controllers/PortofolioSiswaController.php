<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostPortofolioSiswaRequest;
use App\Http\Requests\UpdatePortofolioSiswaRequest;
use App\Models\PortofolioSiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortofolioSiswaController extends Controller
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
    public function store(PostPortofolioSiswaRequest $request)
    {
        $data = $request->validated();
        try {
            if ($request->file('foto')) {
                $file = $request->file('foto');
                $filename = $file->getClientOriginalName();
                $file->storeAs('public/images/portofolio', $filename);
                $data['foto'] = $filename;
            }
            
            PortofolioSiswa::create($data);

            return response()
            ->json([
                'message' => 'Berhasil menyimpan data portofolio siswa'
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal menyimpan data portofolio siswa',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($portofolioId)
    {
        try {
            $data = PortofolioSiswa::findOrFail($portofolioId);
            return response()->json($data);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Data tidak ditemukan',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * Display paginated data
     */
    public function show_all(Request $request){
        $length = $request->length??10;
        $search = $request->search??null;
        $kelas = $request->kelas != null ? [$request->kelas] : /** set to array  **/
        $this->kelas->pluck('id');
        $tahun_ajaran = $request->tahun_ajaran??$this->tahunAjaranAktif->id;
        
        
        $portofolioSiswa = PortofolioSiswa::with('siswa','kelas','tahun_ajaran')
        ->when($search, function($sub)use($search){
            $sub->whereHas('siswa',function($subSiswa)use($search){
                $subSiswa->whereAny(['nama_lengkap','nama_panggilan','nik',],'ilike',"%$search%");
            });
        })
        ->when($kelas != null, function($sub)use($kelas){;
            $sub->whereIn('kelas_id',$kelas);
        })
        ->where('tahun_ajaran_id',$tahun_ajaran)
        ->paginate($length);

        return response()->json($portofolioSiswa);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($portofolioId)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePortofolioSiswaRequest $request, $portofolioId)
    {
        $data = $request->validated();
        try {

            $portofolioSiswa = PortofolioSiswa::findOrFail($portofolioId);
            $portofolioSiswa->update($data);
            $portofolioSiswa->save();

            return response()
            ->json([
                'message' => 'Berhasil mengubah data portofolio'
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal mengubah data portofolio',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($portofolioId)
    {
        try {
            $portofolioSiswa = PortofolioSiswa::findOrFail($portofolioId);
            $portofolioSiswa->delete();
            return response()
            ->json([
                'message' => 'Berhasil menghapus data portofolio'
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal menghapus data portofolio',
                'detail' => $th->getMessage()
            ],500);
        }
    }
}
