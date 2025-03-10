<?php

namespace App\Http\Controllers;

use App\Exceptions\BelowZeroTabungan;
use App\Models\Tabungan;
use App\Models\TransaksiTabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class TabunganController extends Controller
{

    public function __construct(Request $request) {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Inertia::render('Tabungan/Index',[
            'user_role' => $this->user->role
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * menyimpan data mutasi masuk
     */
    public function mutasiMasuk(Request $request){
        DB::beginTransaction();
        
        
        if ($this->user->role != 'guru' && $this->user->role != 'admin') {
            return response()->json(['message' => 'unauthorized'],401);
        }
        
        $request->validate([
            'siswa_id' => 'required',
            'tahun_ajaran_id' => 'required',
            'jenis' => ['required',Rule::in(['deposit','withdraw'])],
            'mutasi_masuk' => 'required',
            'tanggal_transaksi' => 'required',
            'keterangan' => 'required'
        ]);
        try {
            
            // add siswa_id data
            $data = $request->all();

            // create data transaksi masuk
            TransaksiTabungan::create($data);

            // create data tabungan (overview)
                // mapping data overview tabungan
                $dataTabungan = new Request([
                    'tahun_ajaran_id' => $request->tahun_ajaran_id,
                    'nominal_masuk' => $request->mutasi_masuk,
                ]);

            // call store function
            $this->store($dataTabungan, $data['siswa_id']);
            
            // commit
            DB::commit();

            // response
            return response()
            ->json([
                'message' => 'Berhasil melakukan transaksi'
            ]);
        } 
        catch (ValidationException $th){
             // rollback
             DB::rollBack();
             return response()
             ->json([
                 'message' => 'Gagal melakukan transaksi',
                 'detail' => $th->getMessage()
             ],400);
        }
        catch (\Throwable $th) {
            // rollback
            DB::rollBack();

            return response()
            ->json([
                'message' => 'Gagal melakukan transaksi',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * menyimpan data mutasi keluar
     */
    public function mutasiKeluar(Request $request){
        DB::beginTransaction();
        if ($this->user->role != 'guru' && $this->user->role != 'admin') {
            return response()->json(['message' => 'unauthorized'],401);
        }
        try {
            $request->validate([
                'siswa_id' => 'required',
                'tahun_ajaran_id' => 'required',
                'jenis' => ['required',Rule::in(['deposit','withdraw'])],
                'mutasi_keluar' => 'required',
                'tanggal_transaksi' => 'required',
                'keterangan' => 'required'
            ]);

            // add siswa_id data
            $data = $request->all();

            // create data transaksi masuk
            TransaksiTabungan::create($data);

            // create data tabungan (overview)
                // mapping data overview tabungan
                $dataTabungan = new Request([
                    'tahun_ajaran_id' => $request->tahun_ajaran_id,
                    'nominal_keluar' => $request->mutasi_keluar,
                ]);

            // call store function
            $this->store($dataTabungan, $data['siswa_id']);
            
            // commit
            DB::commit();

            // response
            return response()
            ->json([
                'message' => 'Berhasil melakukan transaksi'
            ]);
        } 
        catch (ValidationException $th){
             // rollback
             DB::rollBack();
             Log::error($th->getMessage(),[$th]);

             return response()
             ->json([
                 'message' => 'Gagal melakukan transaksi',
                 'detail' => $th->getMessage()
             ],400);
        }
        catch (\Throwable $th) {
            // rollback
            DB::rollBack();
            Log::error($th->getMessage(),[$th]);
            
            return response()
            ->json([
                'message' => 'Gagal melakukan transaksi',
                'detail' => $th->getMessage()
            ],500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $siswaId)
    {
        if ($this->user->role != 'guru' && $this->user->role != 'admin') {
            return response()->json(['message' => 'unauthorized'],401);
        }
        try {
            $request->validate([
                'tahun_ajaran_id' => 'required',
                'nominal_masuk' => 'nullable',
                'nominal_keluar' => 'nullable',
            ]);

            // get data tabungan
            $tabungan = Tabungan::where('tahun_ajaran_id',$request->tahun_ajaran_id)
            ->where('siswa_id',$siswaId)
            ->first();

            // filter data nominal
            $dataNominal = [
                'nominal_masuk' => $request->nominal_masuk,
                'nominal_keluar' => $request->nominal_keluar,
            ];
            $dataNominal = array_filter($dataNominal);

            if (isset($tabungan)) {
                
                $dataNominal = [
                    'nominal_masuk' => $tabungan->nominal_masuk + ($dataNominal['nominal_masuk']??0),
                    'nominal_keluar' => $tabungan->nominal_keluar + ($dataNominal['nominal_keluar']??0),
                    'total' => $tabungan->total + ($dataNominal['nominal_masuk']??0 - $dataNominal['nominal_keluar']??0)
                ];

                if ($dataNominal['total'] < 0) {
                    throw new BelowZeroTabungan();
                }
                $tabungan->update($dataNominal);
            }else{
                Tabungan::create(array_filter([
                    'tahun_ajaran_id' => $request->tahun_ajaran_id, 
                    'siswa_id' => $siswaId,
                    'nominal_masuk' => $dataNominal['nominal_masuk']??0,
                    'nominal_keluar' => $dataNominal['nominal_keluar']??0,
                    'total' => $dataNominal['nominal_masuk']??0 - $dataNominal['nominal_keluar']??0,
                ]));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $search = $request->searchQuery??null;
        $kelas = $request->kelas??null;
        $length = $request->length??10;

        $tabungan = Tabungan::with('siswa')->when($search, function($sub) use($search) {
            $sub->whereHas('siswa',function($subSiswa) use($search) {
                $subSiswa->where('nama_lengkap','ilike',"%$search%");
            });
        })->when($kelas, function($sub) use($kelas) {
            $sub->whereHas('siswa',function($subSiswa) use($kelas) {
                $subSiswa->where('kelas_id',$kelas);
            });
        })
        ->orderBy('created_at','desc')
        ->paginate($length);

        return response()
        ->json($tabungan);
    }


    public function showTabunganBySiswa(int $siswaId){
        $tabungan = TransaksiTabungan::with('siswa')
        ->where('siswa_id',$siswaId)
        ->orderBy('id','DESC')
        ->paginate(10);

        Log::info($tabungan);
        return response()
        ->json($tabungan);
    }

    /**
     * Show data by siswa id
     */
    public function show_by_id(int $id){
        $tabungan = Tabungan::findOrFail($id);
        return response()->json($tabungan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $transaksiId)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $transaksi_id)
    {

        DB::beginTransaction();
        if ($this->user->role != 'guru' && $this->user->role != 'admin') {
            return response()->json(['message' => 'unauthorized'],401);
        }
        try {
            
            $request->validate([
                'jenis' => ['required',Rule::in(['deposit','withdraw'])],
            ]);

            // update data transaksi
            $updateTransaksi = TransaksiTabungan::where('id',$transaksi_id)->first();
            $tempData = clone $updateTransaksi;
            $updateTransaksi->update($request->all());
            $updateTransaksi->save();

            // get the difference value
            $diff = new Request([
                'tahun_ajaran_id' => $updateTransaksi->tahun_ajaran_id,
                'nominal_masuk' => $updateTransaksi->mutasi_masuk - $tempData->mutasi_masuk,
                'nominal_keluar' => $updateTransaksi->mutasi_keluar - $tempData->mutasi_keluar
            ]);
            
            $this->store($diff, $updateTransaksi->siswa_id);

            DB::commit();
            return response()
            ->json([
                'message' => 'Berhasil mengubah data transaksi'
            ]);
        } 
        catch (ValidationException $th){
            DB::rollBack();
            return response()
            ->json([
                'message' => 'Gagal mengubah data transaksi',
                'detail' => $th->getMessage()
            ],400);
        }
        catch (\Throwable $th) {
            Log::error($th->getMessage(),[$th]);
            DB::rollBack();
            return response()
            ->json([
                'message' => 'Gagal mengubah data transaksi',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $tabungan_id)
    {
        DB::beginTransaction();
        try {
            // delete data transaksi
            $dataTransaksi = TransaksiTabungan::findOrFail($tabungan_id);
            $tempData = clone $dataTransaksi;
            $dataTransaksi->delete();

            // mengurangi overview data
            $diff = new Request([
                'tahun_ajaran_id' => $tempData->tahun_ajaran_id,
                'nominal_masuk' => 0 - $tempData->mutasi_masuk,
                'nominal_keluar' => 0 - $tempData->mutasi_keluar
            ]);
            
            $this->store($diff, $tempData->siswa_id);
            
            DB::commit();
            return response()
            ->json([
                'message' => 'Berhasil menghapus data transaksi'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()
            ->json([
                'message' => 'Gagal menghapus data transaksi',
                'detail' => $th->getMessage()
            ],500);
        }
    }
}
