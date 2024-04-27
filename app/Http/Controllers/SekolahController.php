<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class SekolahController extends Controller
{

    public function index(){
        return Inertia::render('Sekolah/Index');
    }

    public function add(){
        return Inertia::render('Sekolah/Create');
    }

    public function show(Request $request){
        $search = $request->search??null;
        $provinsi = $request->provinsi??null;
        $kota = $request->kota??null;

        $sekolah = Sekolah::with(['provinsi','kota','kecamatan','desa'])
        ->when($search, function($sub) use($search){
            $sub->whereAny(['name','kontak'],'ILIKE',"%$search%");
        })
        ->when($provinsi, function($sub) use($provinsi, $kota){
            $sub->where('provinsi_id',$provinsi)
            ->when($kota,function($subKota) use($kota){
                $subKota->where('kota_id',$kota);
            });
        })
        ->withCount('adminSekolah')
        ->paginate(10);

        return response()
        ->json($sekolah);

    }

    public function store(Request $request){
        try {
            
            $requestData = $request->validate([
                'name' => 'required',
                'provinsi' => 'nullable',
                'kota' => 'nullable',
                'kecamatan' => 'nullable',
                'desa' => 'nullable',
                'image' => 'nullable',
                'kontak' => 'nullable',
                'akreditasi' => 'nullable',
                'lat' => 'nullable',
                'long' => 'nullable',
                'data' => 'nullable',
                'alamat' => 'nullable'
            ]);

            $data = [
                'name' => $request->name,
                'provinsi_id' => $request->provinsi,
                'kota_id' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'desa' => $request->desa,
                'image' => $request->image,
                'kontak' => $request->kontak,
                'akreditasi' => $request->akreditasi,
                'lat' => $request->lat,
                'long' => $request->long,
                'data' => $request->data,
                'alamat' => $request->alamat
            ];

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
