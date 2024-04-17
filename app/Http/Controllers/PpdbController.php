<?php

namespace App\Http\Controllers;

use App\Models\Ppdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PpdbController extends Controller
{
    public function store(Request $request){
        
        $path = '';
        try {
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
            $this->deleteImage($path);
            Log::error($th->getMessage(),[$th]);
            return response()
            ->json([
                'message' => 'Gagal mendaftar ppdb'
            ],400);
        }
        catch (\Throwable $th) {
            $this->deleteImage($path);
            Log::error($th->getMessage(),[$th]);
            return response()
            ->json([
                'message' => 'Gagal mendaftar ppdb'
            ],500);
        }
    }

    public function show(Request $request){
        try {
            $length = $request->length??10;
            $search = $request->search??null;
            $provinsi = $request->provinsi??null;
            $kota = $request->kota??null;
            $kecamatan = $request->kecamatan??null;
            $kelurahan = $request->kelurahan??null;
            $sortCol = $request->sortCol??null;
            $sortDir = $request->sortDir??null;

            $ppdb = Ppdb::with('kota_lahir','kota_kab','provinsi','kecamatan','kelurahan')
            ->when($search,function($sub) use($search){
                $sub->whereAny(['nama_lengkap','nama_panggilan'],'ilike',"%$search%");
            })
            ->when($provinsi, function($sub) use($provinsi){
                $sub->where('provinsi',$provinsi);
            })
            ->when($kota, function($sub) use($kota){
                $sub->where('kota_kab',$kota);
            })
            ->when($kecamatan, function($sub) use($kecamatan){
                $sub->where('kecamatan',$kecamatan);
            })
            ->when($kelurahan, function($sub) use($kelurahan){
                $sub->where('kelurahan',$kelurahan);
            })
            ->when($sortCol,function($sub) use($sortCol,$sortDir){
                $sub->orderBy($sortCol,$sortDir);
            })
            ->paginate($length);
            return response()
            ->json($ppdb);

        } catch (\Throwable $th) {
            Log::error($th->getMessage(),[$th]);
            return response()
            ->json([
                'message' => 'Gagal menampilkan data'
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

    public function deleteImage($path):void{
        if (Storage::exists($path)) {
            Storage::delete($path);
        } 
    }
}
