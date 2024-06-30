<?php

namespace App\Http\Controllers;

use App\Models\KurikulumSekolah;
use App\Models\Rpph;
use App\Models\TahunPelajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class RpphController extends Controller
{


    /**
     * Create page
     */
    public function create(KelasController $kelasController){
        $user_guru = Auth::user();
        $sekolahId = $user_guru->guru->sekolah_id;
        $kelas = $kelasController->show_kelas_by_sekolah($sekolahId);
        $kurikulum = KurikulumSekolah::where('sekolah_id',$sekolahId)->first();
        
        return Inertia::render('Rpph/Create',[
            'guru' => $user_guru,
            'kelas' => $kelas,
            'kurikulum' => $kurikulum->kurikulum
        ]);
    }

    /**
     * public function show rpph
     */
    public function show(Request $request){
        $search = $request->search??null;
        $kelas = $request->kelas??null;
        $semester = $request->semester??null;
        $start_date = $request->start_date??null;
        $end_date = $request->end_date??null;

        // get data sekolah
        $user_guru = Auth::user();
        $sekolahId = $user_guru->guru->sekolah_id;

        $rpph = Rpph::with('kelas','semester','kurikulum','kegiatan')
        ->whereHas('kelas',function($sub) use($sekolahId){
            $sub->where('sekolah_id',$sekolahId);
        })
        ->when($kelas,function($sub) use($kelas){
            $sub->where('kelas_id',$kelas);
        })
        ->when($semester, function($sub) use($semester){
            $sub->where('semester_id',$semester);
        })
        ->when($start_date != null && $end_date != null, function($sub) use($start_date, $end_date){
            $sub->where('start_date', '>=' ,$start_date)
            ->where('end_date','<=',$end_date);
        })
        ->when($search, function($sub) use($search){
            $sub->whereAny(['tema','sub_tema'],'ilike',"%$search%");
        })
        ->orderBy('created_at','ASC')
        ->paginate();

        return response()
        ->json($rpph);
    }

    /**
     * store data rpph
     */
    public function store(Request $request, TahunPelajaranController $tahunPelajaranController){
        try {
            // get user data
            $user = User::find(Auth::user()->id);

            // get guru data
            $guru = $user->guru;
            
            $data = $request->validate([
                'kelas_id' => ['required'],
                'kurikulum_id' => ['required'],
                'tema' => ['required'],
                'sub_tema' => ['required'],
                'start_date' => ['required','date'],
                'end_date' => ['nullable','date'],
                'guru_id' => ['required'],
                'capaian_pembelajaran' => ['nullable'],
                'tujuan_pembelajaran' => ['nullable'],
                'metode' => ['nullable'],
                'sumber_belajar' => ['nullable'],
                'alat_bahan' => ['nullable'],
            ]);

            // convert array to string
            $data['capaian_pembelajaran'] = json_encode($data['capaian_pembelajaran']);
            $data['tujuan_pembelajaran'] = json_encode($data['tujuan_pembelajaran']);
            $data['metode'] = json_encode($data['metode']);
            $data['sumber_belajar'] = json_encode($data['sumber_belajar']);
            $data['alat_bahan'] = json_encode($data['alat_bahan']);

            // get active semester
            $semester = $tahunPelajaranController->show_active($guru->sekolah_id);
            $data['semester_id'] = $semester->id;
            
            // store data
            $rpph = Rpph::create($data);

            return response()
            ->json([
                'message' => 'Berhasil membuat rpph',
                'id_rpph' => $rpph->id
            ]);
        } 
        catch (ValidationException $th){
            return response()
            ->json([
                'message' => 'Gagal membuat rpph',
                'detail' => $th->errors()
            ],422);
        }
        catch (\Throwable $th) {
            dd($th);
            return response()
            ->json([
                'message' => 'Gagal membuat rpph',
                'detail' => $th->getMessage()
            ],500);
        }

    }    
    
    /**
     * update data rpph by id
     */
    public function update(Request $request, int $rpphId){
        try {
            $data = $request->validate([
                'kelas_id' => ['required'],
                'kurikulum_id' => ['required'],
                'tema' => ['required'],
                'sub_tema' => ['required'],
                'start_date' => ['nullable','date'],
                'end_date' => ['nullable','date'],
                'guru_id' => ['required'],
                'tujuan_pembelajaran' => ['nullable'],
                'metode' => ['nullable'],
                'sumber_belajar' => ['nullable'],
                'alat_bahan' => ['nullable'],
            ]);

            $data = array_filter($data);

            Rpph::where('id',$rpphId)
            ->update($data);

            return response()
            ->json([
                'message' => 'Berhasil memperbarui data RPPH'
            ]);
        } 
        catch (ValidationException $th){
            return response()
            ->json([
                'message' => 'Gagal memperbarui data RPPH',
                'detail' => $th->getMessage()
            ],400);
        }
        catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal memperbarui data RPPH',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * delete data rpph by id
     */
    public function destroy(int $id){
        try {
            Rpph::where('id',$id)
            ->delete();
            return response()
            ->json([
                'message' => 'Berhasil menghapus data RPPH'
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal menghapus data RPPH',
                'detail' => $th->getMessage()
            ],500);
        }
    }
}
