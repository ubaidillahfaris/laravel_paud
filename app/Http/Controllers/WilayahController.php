<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function provinsi(){
        $provinsi = Provinsi::get();
        return response()
        ->json($provinsi);
    }

    public function kota(int $province_id = null){
        $kota = Kota::when(
            $province_id,function($item) use($province_id){
                $item->where('province_id',$province_id);
            }
        )
        ->get();

        return response()
        ->json($kota);
    }

    public function kecamatan(int $kota_id){
        $kecamatan = Kecamatan::where('regency_id',$kota_id)
        ->get();

        return response()
        ->json($kecamatan);
    }

    public function desa(int $kecamatan_id){
        $desa = Desa::where('district_id',$kecamatan_id)
        ->get();

        return response()
        ->json($desa);
    }
}
