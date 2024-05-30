<?php

namespace App\Http\Controllers;

use App\Models\SurveyAsesmen;
use Illuminate\Http\Request;

class SurveyAsesmenController extends Controller
{
    public function store(Request $request){
        try {
            
            $data = $request->validate([
                'ppdb_master' => 'required',
                'data' => 'nullable'
            ]);

            SurveyAsesmen::create($data);


        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function showAsesmenFromPpdbMaster(int $ppdb_master){
        try {
            
            $surveyAsesmen = SurveyAsesmen::where('ppdb_master',$ppdb_master)
            ->first();

            return response()
            ->json($surveyAsesmen);

        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => $th->getMessage()
            ],500);
        }
    }
}
