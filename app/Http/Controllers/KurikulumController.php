<?php

namespace App\Http\Controllers;

use App\Models\Kurikulum;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class KurikulumController extends Controller
{
    /**
     * Show index page
     */
    public function index(){
        return Inertia::render('Kurikulum/Index');
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Kurikulum/Create');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kurikulum = Kurikulum::find($id);

        if (!$kurikulum) {
            abort(404);
        }

        return Inertia::render('Kurikulum/Show', [
            'kurikulum' => $kurikulum
        ]);
    }


    public function show_all(Request $request){
        $length = $request->length??10;
        $search = $request->search??null;
        $sekolah = $this->sekolah;

        $kurikulum = Kurikulum::where('sekolah_id',$sekolah->id)
        ->when($search != null, function($sub)use($search){
            $sub->where('name','ilike',"%$search%");
        })
        ->paginate($length);

        return response()->json($kurikulum);
    }

    /**
     * Store data 
     */
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'is_active' => 'required',
            'curriculum_start_date' => 'nullablle',
            'curriculum_end_date' => 'nullablle'
        ]);

        $data['sekolah_id'] = $this->sekolah->id;

        try {
    
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

        $data = $request->validate([
            'name' => 'required',
            'is_active' => 'required',
        ]);
        try {
            
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
