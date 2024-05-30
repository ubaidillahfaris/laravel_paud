<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;

class AnakController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        try {
            Anak::updateOrCreate(
                [
                    'nik' => $data['nik'],
                ],
                [
                    'ortu_id' => $data['ortu_user_id'],
                    'nama' => $data['nama_lengkap'],
                    'nama_panggilan' => $data['nama_panggilan'],
                    'anak_ke' => $data['anak_ke'],
                    'jenis_kelamin' => $data['jenis_kelamin'],
                    'kota_lahir' => $data['kota_lahir'],
                    'tanggal_lahir' => $data['tanggal_lahir'],
                    'image_path' => $data['foto'],
                    'provinsi_id' => $data['provinsi']??null,
                    'kota_id' => $data['kota_kab']??null,
                    'kecamatan_id' => $data['kecamatan']??null,
                    'alamat' => $data['alamat']??null,
                ]
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
