<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\RiwayatKelas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class KelasController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['sekolah'];
    }

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        return Inertia::render('Kelas/Kelas');
    }

    public function create(){
        return Inertia::render('Kelas/Create');
    }

    public function edit(int $id){
        $kelas = Kelas::find($id);
        return Inertia::render('Kelas/Edit',[
            'kelas' => $kelas
        ]);
    }

    public function update(Request $request, $id){
        try {
            Kelas::where('id',$id)
            ->update(array_filter([
                'nama' => $request->nama,
                'tahun_pelajaran_id' => $request->tahun_pelajaran_id,
                'sekolah_id' => $request->sekolah_id,
            ]));

            return response()
            ->json([
                'message' => 'Berhasil mengubah data kelas'
            ]);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal mengubah data kelas',
                'description' => $th->getMessage()
            ],500);
        }
    }

    /**
     * show kelas by sekolah id
     */
    public function show_kelas_by_sekolah(int $sekolahId){
        $kelas = Kelas::where('sekolah_id',$sekolahId)
        ->orderBy('nama','ASC')
        ->get();
        return $kelas;
    }

    /**
     * Build the base query for fetching Kelas data.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function baseQuery()
    {
        return Kelas::where('sekolah_id', $this->sekolah->id)
        ->whereHas('tahun_ajaran', function ($query) {
            $query->where('is_active', true);
        });
    }

    /**
     * Show the paginated list of Kelas with optional search functionality.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $length = $request->input('length', 10); // default to 10 if not provided
        $search = $request->input('search', null);

        $kelasQuery = $this->baseQuery()
        ->with('tahun_ajaran', 'siswa')
        ->withCount('siswa')
        ->when($search, function ($query) use ($search) {
            $query->where('nama', 'ILIKE', "%{$search}%");
        })
        ->orderBy('nama', 'ASC');

        $kelas = $kelasQuery->paginate($length);

        return response()->json($kelas);
    }

    /**
     * Show all Kelas data without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show_all()
    {
        $kelas = $this->baseQuery()
        ->orderBy('nama','ASC')
        ->get();
        return response()->json($kelas);
    }

    public function attachClassToSchoolYear(Request $request){
        try {

            $request->validate([
                'kelas_id' => 'required',
                'tahun_pelajaran_id' => 'required'
            ]);
            $kelasId = $request->kelas_id;
            $tahunPelajaranId = $request->tahun_pelajaran_id;

            // update id tahun ajaran
            Kelas::where('id',$kelasId)
            ->update([
                'tahun_pelajaran_id' => $tahunPelajaranId
            ]);

            return response()
            ->json([
                'message' => 'Berhasil menambahkan kelas ke tahun ajaran'
            ]);

        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'Gagal menambahkan kelas ke tahun ajaran',
                'description' => $th->getMessage()
            ],500);
        }
    }

    public function store(Request $request){
        try {
            $request->validate([
                'name' => 'required|string',
                'id_tahun_ajaran' => 'required'
            ]);

            // get data admin sekolah
            $user = User::where('id',Auth::user()->id)
            ->with('sekolah')
            ->first();
            // create data kelas
            Kelas::create([
                'nama' => $request->name,
                'tahun_pelajaran_id' => $request->id_tahun_ajaran,
                'sekolah_id' => $user->sekolah->id
            ]);

            return response()
            ->json([
                'message' => 'Berhasil membuat kelas'
            ]);
        } 
        catch (ValidationException $th){
            Log::error($th->getMessage(), [$th]);
            return response()
            ->json([
                'message' => 'Gagal membuat kelas',
                'description' => $th->getMessage()
            ],400);
        }
        catch (\Throwable $th) {
            Log::error($th->getMessage(), [$th]);
            return response()
            ->json([
                'message' => 'Gagal membuat kelas',
                'description' => $th->getMessage()
            ],500);
        }
    }

    public function delete($id){
        try {
            Kelas::find($id)->delete();
            return response()
            ->json([
                'message' => 'Berhasil menghapus kelas'
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [$th]);
            return response()
            ->json([
                'message' => 'Gagal menghapus kelas'
            ],500);
        }
    }


}
