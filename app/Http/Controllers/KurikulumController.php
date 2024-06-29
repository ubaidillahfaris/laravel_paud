<?php

namespace App\Http\Controllers;

use App\Models\Kurikulum;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KurikulumController extends Controller
{
    /**
     * Show index page
     */
    public function index(){

    }

    /**
     * Store data 
     */
    public function store(Request $request){
        try {
            $data = $request->validate([
                'name' => 'required',
                'is_active' => 'required',
                'curriculum_start_date' => 'nullablle',
                'curriculum_end_date' => 'nullablle'
            ]);
    
            Kurikulum::create($data);
            return response()
            ->json([
                'message' => 'Berhasil membuat data'
            ]);
        } 
        catch (ValidationException $th){
            return response()
            ->json([
                'message' => 'Gagal membuat data',
                'detail' => $th->getMessage()
            ],400);
        }
        catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal membuat data',
                'detail' => $th->getMessage()
            ],500);
        }

    }

    /**
     * Update data by id
     */
    public function update(Request $request, int $kurikulumId){
        try {
            $data = $request->all();
            $data = array_filter($data);

            Kurikulum::where('id',$kurikulumId)
            ->update($data);

            return response()
            ->json([
                'message' => "Berhasil mengubah data kurikulum"
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => "Gagal mengubah data kurikulum",
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * delete kurikulum by id
     */
    public function destroy(int $kurikulumId){
        try {
            Kurikulum::where('id',$kurikulumId)
            ->delete();
            return response()
            ->json([
                'message' => 'Berhasil menghapus data kurikulum'
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal menghapus data kurikulum',
                'detail' => $th->getMessage()
            ],500);
        }
    }
}
