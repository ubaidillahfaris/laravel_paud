<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TagihanController extends Controller
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
        try {
            $request->validate([
                'siswa_id'=>'required',
                'status'=>'required',
                'nominal'=>'required',
                'nominal_terbayar'=>'nullable',
                'tanggal_bayar'=>'nullable',
                'gambar_faktur'=>'nullable',
                'tempat_bayar'=>'nullable',
                'teller'=>'nullable',
            ]);

            // filter nullable value
            $data = array_filter($request->all());

            // create tagihan data
            Tagihan::create($data);

            // response
            return response()
            ->json([
                'message' => 'Berhasil membuat tagihan siswa'
            ]);
        } 
        catch (ValidationException $th){
            return response()
            ->json([
                'message' => 'Gagal membuat tagihan siswa',
                'detail' => $th->getMessage()
            ],400);
        }
        catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal membuat tagihan siswa',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tagihan $tagihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tagihan $tagihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $taghanId)
    {
        try {
            $request->validate([
                'status'=>'nullable',
                'nominal'=>'nullable',
                'nominal_terbayar'=>'nullable',
                'tanggal_bayar'=>'nullable',
                'gambar_faktur'=>'nullable',
                'tempat_bayar'=>'nullable',
                'teller'=>'nullable',
            ]);

            // filter data request
            $data = array_filter($request->all());

            // update data tagihan
            Tagihan::where('id',$taghanId)
            ->update($data);
            
            // response
            return response()
            ->json([
                'message' => 'Berhasil mengubah tagihan siswa'
            ]);
            
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal mengubah tagihan siswa',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $tagihanId)
    {
        try {
            Tagihan::where('id',$tagihanId)->delete();
            return response()
            ->json([
                'message' => 'Berhasil menghapus tagihan siswa'
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal menghapus tagihan siswa',
                'detail' => $th->getMessage()
            ],500);
        }
    }
}
