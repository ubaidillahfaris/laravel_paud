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
}
