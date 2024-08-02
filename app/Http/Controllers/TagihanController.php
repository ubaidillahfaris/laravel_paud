<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class TagihanController extends Controller
{

    protected $user;

    public function __construct(Request $request) {
        $this->user = $request->user();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Tagihan/Index',[
            'user_role' => $this->user->role
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Tagihan/Create',[
            'user_role' => $this->user->role
        ]);
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
        $search = $request->search??null;
        $length = $request->length??10;
        $kelas = $request->input('kelas',null);

        $guruData = $this->user->guru;
        $sekolahId = $guruData->sekolah_id;
        if (!isset($sekolahId)) {
            return response()
            ->json([
                'message' => 'no permission found'
            ],401);
        }

        $tagihan = Tagihan::with('siswa','siswa_kelas')
        ->whereHas('siswa_kelas',function($sub) use($sekolahId){
            $sub->where('sekolah_id',$sekolahId);
        })
        ->when($search, function($sub) use($search){
            $sub->whereHas('siswa',function($subSiswa) use($search){
                $subSiswa->whereAny(['nama_lengkap','nama_panggilan'],'ilike',"%$search%");
            });
        })
        ->when($kelas != null, function($sub) use($kelas){
            $sub->whereHas('siswa_kelas',function($subKelas) use($kelas){
                $subKelas->where('kelas_id',$kelas);
            });
        })
        ->orderBy('created_at','DESC')
        ->paginate($length);

        return response()
        ->json($tagihan);
    }

    public function showTagihanByOrtuNotPaid(Request $request){
        $user = $request->user();
        $idWaliMurid = $user->id;
        
        $tagihan = Tagihan::with('siswa')
        ->whereHas('siswa',function($sub) use($idWaliMurid){
            $sub->where('ortu_id',$idWaliMurid);
        })
        ->whereNull('nominal_terbayar')
        ->whereNull('tanggal_bayar')
        ->get();

        return $tagihan;
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
        $tagihan = Siswa::select('tagihans.*')
        ->with('tagihan')
        ->where('kelas_id',$kelasId)
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
     * Show pembayaran page
     * @param int $id
     */
    public function pembayaran_page(int $id){
        // get tagihan
        $tagihan = Tagihan::findOrFail($id);

        // get siswa
        $siswa = Siswa::findOrFail($tagihan->siswa_id);

        return Inertia::render('Tagihan/Bayar',[
            'tagihan' => $tagihan,
            'siswa' => $siswa
        ]);
    }

    /**
     * method Pembayaran tagihan
     */
    public function bayar(Request $request, int $id){
        try {
            $request->validate([
                'nominal_terbayar'=> 'required|numeric|min:10000',
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
            throw $th;
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
