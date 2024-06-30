<?php

namespace App\Http\Controllers;

use App\Models\KegiatanRpph;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class KegiatanRpphController extends Controller
{

    /**
     * Create page by rpph id
     */
    public function create(Request $request, int $rpphId){

        return Inertia::render('Rpph/Kegiatan/Create',[
            'rpph_id' => $rpphId
        ]);
    }

    /**
     * store kegiatan rpph by rpph id
     */
    public function store(Request $request, $rpphId){
        try {

            // dd($request->all());
            
            $request->validate([
                'data.*.name' => ['required'],
                'data.*.start_time' => ['required'],
                'data.*.end_time' => ['required'],
                'data.*.langkah' => ['required'],
            ]);

            // mapping data 
            foreach ($request->data as $key => $value) {

                $value['langkah'] = json_encode($value['langkah']);
                $value['rpph_id'] = $rpphId;
                KegiatanRpph::create($value);
            }

            return response()
            ->json([
                'message' => 'Berhasil membuat kegiatan RPPH'
            ]);
        } 
        catch (ValidationException $th) {
            return response()
            ->json([
                'message' => 'Gagal membuat kegiatan RPPH',
                'detail' => $th->getMessage()
            ],400);
        }
        catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal membuat kegiatan RPPH',
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * update data kegiatan rpph by id
     */
    public function update(Request $request, int $id){
        try {
            $data = $request->validate([
                'name' => 'required',
                'start_time' => 'nullable',
                'end_time' => 'nullable',
                'langkah' => 'required'
            ]);

            KegiatanRpph::where('id',$id)
            ->update(array_filter($data));

            return response()
            ->json([
                'message' => "Berhasil mengubah data"
            ]);
        }
        catch (ValidationException $th) {
            return response()
            ->json([
                'message' => "Gagal mengubah data",
                'detail' => $th->getMessage()
            ],400);
        }
        catch (\Throwable $th) {
            return response()
            ->json([
                'message' => "Gagal mengubah data",
                'detail' => $th->getMessage()
            ],500);
        }
    }

    /**
     * delete data rpph by id
     */
    public function destroy(int $id){
        try {
            KegiatanRpph::where('id',$id)
            ->delete();
            return response()
            ->json([
                'message' => "Berhasil menghapus data",
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => "Gagal menghapus data",
                'detail' => $th->getMessage()
            ],500);
        }
    }
}
