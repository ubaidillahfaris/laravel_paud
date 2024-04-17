<?php

namespace App\Http\Controllers;

use App\Models\Ppdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class PpdbController extends Controller
{
    public function store(Request $request){
        
        try {
            $path = '';
            if ($request->hasFile('foto')) {
                $path = $this->moveImage($request->file('foto'));
            }

            $data = $request->validate([
                'kelas_id' => 'required',
                'nama_lengkap' => 'required',
                'nama_panggilan' => 'required',
                'nik' => 'required',
                'anak_ke' => 'required',
                'jenis_kelamin' => 'required',
                'kota_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'nama_ayah' => 'required',
                'pekerjaan_ayah' => 'required',
                'no_hp_ayah' => 'required',
                'nama_ibu' => 'required',
                'pekerjaan_ibu' => 'required',
                'no_hp_ibu' => 'required',
                'foto' => 'nullable',
                'provinsi' => 'required',
                'kota_kab' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'alamat' => 'nullable',
            ]);

            $data['foto'] = $path;
            Ppdb::create(
                $data
            );

            return response()
            ->json([
                'message' => 'Berhasil mendaftar ppdb'
            ]);
        }
        catch (ValidationException $th){
            Log::error($th->getMessage(),[$th]);
            return response()
            ->json([
                'message' => 'Gagal mendaftar ppdb'
            ],400);
        }
        catch (\Throwable $th) {
            Log::error($th->getMessage(),[$th]);
            return response()
            ->json([
                'message' => 'Gagal mendaftar ppdb'
            ],500);
        }
    }

    public function moveImage($image){
        try {
            $path = $image->store('public/files/siswa');
            return $path;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
