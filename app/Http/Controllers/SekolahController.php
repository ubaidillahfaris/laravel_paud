<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SekolahController extends Controller
{
    public function store(Request $request){
        try {
            
            $data = $request->validate([
                'name' => 'required',
                'provinsi_id' => 'nullable',
                'kota_id' => 'nullable',
                'kecamatan' => 'nullable',
                'desa' => 'nullable',
                'image' => 'nullable',
                'kontak' => 'nullable',
                'akreditasi' => 'nullable',
                'lat' => 'nullable',
                'long' => 'nullable',
                'data' => 'nullable',
            ]);

            Sekolah::create($data);

            return response()
            ->json([
                'message' => 'Berhasil membuat data sekolah'
            ]);

        } 
        catch (\Illuminate\Validation\ValidationException $th) {
            Log::error($th->getMessage(),[$th]);
            return response()
            ->json([
                'message' => 'Gagal membuat data sekolah'
            ],500);
        }
        catch (\Throwable $th) {
            Log::error($th->getMessage(),[$th]);
            return response()
            ->json([
                'message' => 'Gagal membuat data sekolah'
            ],500);
        }
    }
}
