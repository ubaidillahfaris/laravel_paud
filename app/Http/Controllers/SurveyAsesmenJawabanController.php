<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use App\Models\SurveyAsesmenJawaban;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class SurveyAsesmenJawabanController extends Controller
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
            $data = $request->validate([
                'ppdb_master_id' => 'required',
                'ppdb_id' => 'required',
                'tinggi_badan' => 'required',
                'berat_badan' => 'required',
                'data' => 'required',
            ]);

            // set ortu id data
            $orangTua = OrangTua::where('user_id',Auth::user()->id)->first();
            $data['ortu_id'] = $orangTua->id;

            // post survey asesmen jawaban
            SurveyAsesmenJawaban::create($data);

            return response()
            ->json([
                'message' => 'Berhasil menyimpan data survey'
            ]);

        } 
        catch (ValidationException $th){
            Log::error($th->getMessage(),[$th]);
            return response()
            ->json([
                'message' => 'Gagal menambahkan jawaban',
                'description' => $th->getMessage()
            ],400);
        }
        catch (\Throwable $th) {
            Log::error($th->getMessage(),[$th]);
            return response()
            ->json([
                'message' => 'Gagal menambahkan jawaban',
                'description' => $th->getMessage()
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SurveyAsesmenJawaban $surveyAsesmenJawaban)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SurveyAsesmenJawaban $surveyAsesmenJawaban)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SurveyAsesmenJawaban $surveyAsesmenJawaban)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SurveyAsesmenJawaban $surveyAsesmenJawaban)
    {
        //
    }
}
