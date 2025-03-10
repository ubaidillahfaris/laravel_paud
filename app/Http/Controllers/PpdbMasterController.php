<?php

namespace App\Http\Controllers;

use App\Models\PpdbMaster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PpdbMasterController extends Controller
{

    public function show(Request $request, UserController $userController){
        $search = $request->search??null;
        $length = $request->length??10;
        $status = $request->status??null;

        // get data user
        $user = $userController->adminWithSekolah(Auth::user()->id);


        $ppdbMaster = PpdbMaster::where('sekolah_id',$user->sekolah->id)
        ->when($search,function($sub) use($search){
            $sub->whereAny(['nama_gelombang','informasi_umum'],'ILIKE',"%$search%")
            ->orWhereYear('awal_pendaftaran',intVal($search));
        })
        ->when($status, function($sub) use($status){
            $sub->where('is_active',$status);
        })
        ->withCount('ppdb')
        ->orderBy('id','DESC')
        ->paginate($length);

        return response()
        ->json($ppdbMaster);
    }

    public function showPpdbFromSchool(Request $request, int $sekolah_id){
        $ppdbMaster = PpdbMaster::where('sekolah_id',$sekolah_id)
        ->where('awal_pendaftaran','<=',date('Y-m-d'))
        ->where('akhir_pendaftaran','>=',date('Y-m-d'))
        ->where('is_active',true)
        ->paginate(10);

        return response()
        ->json($ppdbMaster);
    }

    public function create(Request $request, SurveyAsesmenController $surveyAsesmenController, UserController $userController){
        DB::beginTransaction();
        try {
            $user = $userController->adminWithSekolah(Auth::user()->id);
            $ppdbMaster = $request->validate([
                'nama_gelombang' => 'required',
                'informasi_umum' => 'nullable',
                'awal_pendaftaran' => 'required|date',
                'akhir_pendaftaran' => 'required|date|after_or_equal:awal_pendaftaran'
            ]);
            $ppdbMaster['sekolah_id'] = $user->sekolah->id;
            $ppdbMaster = PpdbMaster::create($ppdbMaster);

            $surveyData = new Request([
                'ppdb_master' => $ppdbMaster->id,
                'data' => $request->data
            ]);

            $surveyAsesmenController->store($surveyData);
            DB::commit();
            return response()
            ->json([
                'message' => 'Berhasil membuat data PPDB'
            ]);
        } 
        catch (ValidationException $th){
            DB::rollBack();
            return response()
            ->json([
                'message' => $th->getMessage()
            ],400);
        }
        catch (\Throwable $th) {
            DB::rollBack();
            return response()
            ->json([
                'message' => $th->getMessage()
            ],500);
        }
    }
}
