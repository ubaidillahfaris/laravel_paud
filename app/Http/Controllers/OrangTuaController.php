<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use Illuminate\Http\Request;

class OrangTuaController extends Controller
{
    public function index(){

    }

    public function create(){

    }

    public function update(){

    }

    public function delete(){

    }

    public function show(){

    }

    public function data(int $userId){
        try {
            $dataOrtu = OrangTua::where('user_id',$userId)
            ->first();
            return response()
            ->json($dataOrtu);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal mengambil data orang tua'
            ],500);
        }
    }
}
