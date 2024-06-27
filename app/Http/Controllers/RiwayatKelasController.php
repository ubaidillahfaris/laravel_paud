<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\RiwayatKelas;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RiwayatKelasController extends Controller
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
    public function store(Request $request)
    {
        
    }


    /**
     * Store history of student
     */

    public function createHistory(Request $request, int $siswa_id) :void {
        try {
            
            $request->validate([
                'tahun_ajaran_id' => 'required',
                'kelas_id' => 'required'
            ]);

            // cek data riwayat kelas is exists
            $riwayatKelas = RiwayatKelas::where('kelas_id',$request->kelas_id)
            ->where('siswa_id',$siswa_id)
            ->where('tahun_ajaran_id',$request->tahun_ajaran_id)
            ->first();

            if (isset($riwayatKelas)) {
                return;
            }

            RiwayatKelas::create(
                [
                    'kelas_id' => $request->kelas_id,
                    'siswa_id' => $siswa_id,
                    'tahun_ajaran_id' => $request->tahun_ajaran_id,
                ],
            );
        
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RiwayatKelas $riwayatKelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatKelas $riwayatKelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RiwayatKelas $riwayatKelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiwayatKelas $riwayatKelas)
    {
        //
    }
}
