<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
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
    public function show(Request $request)
    {
        
    }

    public function showTagihanByOrtuNotPaid(Request $request){
        $user = User::find(Auth::user()->id);

    }

    /**
     * Show data tagihan by user id
     */
    public function show_by_siswa_id(int $siswaId){
        $tagihan = Tagihan::find($siswaId);
        
        return response()
        ->json($tagihan);
    }
    
    public function show_by_kelas(int $kelasId){
        $tagihan = Siswa::select('tagihans.*')->with('tagihan')->where('kelas_id',$kelasId)
        ->paginate();

        return response()
        ->json($tagihan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tagihan $tagihan)
    {
        //
    }


    /**
     * method Pembayaran tagihan
     */
    public function bayar(Request $request, int $id){
        try {
            $request->validate([
                'nominal_terbayar'=> 'required',
                'tanggal_bayar'=> 'required',
                'gambar_faktur'=> 'required',
                'tempat_bayar'=> 'nullable',
                'teller'=> 'nullable',
            ]);

            $tagihan = Tagihan::find($id);
            if ($tagihan->nominal != $request->nominal_terbayar) {
                return response()
                ->json([
                    'message' => 'Gagal melakukan pembayaran',
                    'detail' => 'nominal tidak sama'
                ],400);
            }else if(isset($tagihan->tanggal_bayar) && $tagihan->nominal_terbayar > 0){
                return response()
                ->json([
                    'message' => 'Gagal melakukan pembayaran',
                    'detail' => 'tagihan sudah terbayar'
                ],400);
            }

            $data = array_filter($request->all());

            switch (Auth::user()->role) {
                case 'wali':
                    $data['status'] = 'paid';
                    break;
                case 'guru':
                    $data['status'] = 'validated';
                    break;
                default:
                    
                    break;
            }

            $tagihan->update($data);
            $tagihan->save();
    
            return response()
            ->json([
                'message' => 'Berhasil melakukan pembayaran'
            ]);
        } 
        catch(ValidationException $th){
            return response()
            ->json([
                'message' => 'Gagal melakukan pembayaran',
                'detail' => $th->getMessage()
            ],400);
        }
        catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal melakukan pembayaran',
                'detail' => $th->getMessage()
            ],500);
        }

    }

    /**
     * method validasi pembayaran oleh guru
     */
    public function validasi_pembayaran(Request $request, int $tagihanId){
        try {
            $request->validate([
                'status' => [Rule::in('validated')]
            ]);

            Tagihan::where('id',$tagihanId)
            ->where('status','paid') //tagihan yang dapat divalidasi harus berstatus paid
            ->update([
                'status' => $request->status
            ]);

            return response()
            ->json([
                'message' => 'Berhasil memvalidasi tagihan'
            ]);
            
        } 
        catch (ValidationException $th){
            return response()
            ->json([
                'message' => 'Gagal memvalidasi tagihan',
                'detail' => $th->getMessage()
            ],400);
        }
        catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal memvalidasi tagihan',
                'detail' => $th->getMessage()
            ],500);
        }
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
