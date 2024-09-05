<?php

use App\Http\Controllers\AsesmenCatatanAnekdotController;
use App\Http\Controllers\AsesmenCeklisController;
use App\Http\Controllers\AsesmenDokumenKaryaController;
use App\Http\Controllers\AsesmenFotoBerseriController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\PortofolioSiswaController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\PpdbMasterController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\RpphController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SurveyAsesmenController;
use App\Http\Controllers\SurveyAsesmenJawabanController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TahunPelajaranController;
use App\Http\Controllers\WilayahController;
use App\Models\PortofolioSiswa;
use App\Models\Presensi;
use Illuminate\Support\Facades\Route;


Route::post('/login', [LoginController::class, 'loginApi']);
Route::post('/register',[RegisteredUserController::class,'registerApi']);

Route::middleware('auth:sanctum')->group(function () {

    // Group route guru
    Route::prefix('guru')
    ->middleware('role:guru')
    ->group(function(){
        
        /**
         * Route group kelas
         */
        Route::prefix('kelas')
        ->name('kelas.')
        ->controller(KelasController::class)
        ->group(function(){
            Route::get('show','show')->name('show');
        });

        /**
         * Route group siswa
         */
        Route::prefix('siswa')
        ->name('siswa.')
        ->controller(SiswaController::class)
        ->group(function(){
            Route::get('show/{kelas_id?}','show')->name('show');
        });


        Route::prefix('presensi')
        ->name('presensi.')
        ->controller(PresensiController::class)
        ->group(function(){
            Route::get('show_all','show_all')->name('show_all');
            Route::get('show/{presensiId}','show')->name('show');
            Route::post('store','store')->name('store');
            Route::put('update/{presensiId}','update')->name('update');
            Route::delete('delete/{presensiId}','destroy')->name('delete');
        });

        Route::prefix('portofolio_siswa')
        ->controller(PortofolioSiswaController::class)
        ->group(function(){
            Route::get('show/{portofolioId}','show');
            Route::get('show_all','show_all');
            Route::post('store','store');
            Route::put('update/{portofolioId}','update');
            Route::delete('delete/{portofolioId}','destroy');
        });
    });

    // Group route wali meurid
    Route::prefix('wali')
    ->middleware('role:wali')
    ->group(function(){
        
        Route::prefix('sekolah')
        ->controller(SekolahController::class)
        ->group(function(){
            Route::get('data','show');
            Route::get('detail','detail');
        });

        Route::prefix('ppdb')
        ->controller(PpdbMasterController::class)
        ->group(function(){
            Route::get('data/{sekolah_id}','showPpdbFromSchool');
        });

        Route::prefix('ppdb_anak')
        ->controller(PpdbController::class)
        ->group(function(){
            Route::get('data','showPpdbUser');
            Route::post('create','store');
      
      
            Route::prefix('ppdb_asesmen')
        
            ->group(function(){
                Route::get('data/{ppdb_master}',[SurveyAsesmenController::class,'showAsesmenFromPpdbMaster']);
                Route::post('create',[SurveyAsesmenJawabanController::class,'store']);
            });
            
            
        });

        Route::prefix('tagihan')
        ->name('tagihan.')
        ->controller(TagihanController::class)
        ->group(function(){
            Route::get('tagihan_by_ortu','showTagihanByOrtuNotPaid')->name('tagihan_by_ortu');
        });

        Route::prefix('orang_tua')
        ->controller(OrangTuaController::class)
        ->group(function(){
            Route::get('data/{user_id}','data');
        });

    });


    Route::prefix('wilayah')
    ->controller(WilayahController::class)
    ->group(function(){
        Route::get('kota/{slug?}','kota');
    });


    Route::prefix('tahun_ajaran')
    ->controller(TahunPelajaranController::class)
    ->group(function(){
        Route::get('show','show');
        Route::get('active','showAll');
    });

    // tabungan route
    Route::prefix('tabungan')
    ->controller(TabunganController::class)
    ->group(function(){
        Route::post('deposit','mutasiMasuk');
        Route::post('withdraw','mutasiKeluar');
        Route::put('update/{transaksi_id}','update');
        Route::delete('delete/{tabungan_id}','destroy');
        Route::get('tabungan_siswa/{id}','show_by_id');
    });


    /**
     * Rpph route
     */
    Route::prefix('rpph')
    ->controller(RpphController::class)
    ->group(function(){
        Route::get('show_rpph_today_by_kelas','show_rpph_today_by_kelas');
        Route::get('show_siswa_doesnt_have_asesmen/{rpph_id}/{kelas_id}','show_siswa_doesnt_have_asesmen');
        Route::get('show_siswa_have_asesmen/{rpph_id}/{kelas_id}','show_siswa_have_asesmen');
    });

    // asesmen route
    Route::prefix('asesmen')
    ->group(function(){

        // asesmen ceklis
        Route::prefix('ceklis')
        ->controller(AsesmenCeklisController::class)
        ->group(function(){
            Route::put('update/{id}','update');
            Route::post('store','store');
            Route::get('show_by_id/{id}','show_by_id');
            Route::get('show_rpph','show_by_rpph_today');
            Route::delete('delete/{asesmen_ceklis}','destroy');
        });

        // asesmen catatan anekdot
        Route::prefix('catatan_anekdot')
        ->controller(AsesmenCatatanAnekdotController::class)
        ->group(function(){
            Route::put('update/{id}','update');
            Route::post('store','store');
            Route::get('show','show');
            Route::get('show_by_id/{id}','show_by_id');
            Route::delete('delete/{asesmen_ceklis}','destroy');
        });

        // asesmen foto berseri
        Route::prefix('dokumen_karya')
        ->controller(AsesmenDokumenKaryaController::class)
        ->group(function(){
            Route::put('update/{id}','update');
            Route::post('store','store');
            Route::get('show','show');
            Route::get('show_by_id/{id}','show_by_id');
            Route::delete('delete/{asesmen_ceklis}','destroy');
        });

        // asesmen foto berseri
        Route::prefix('foto_berseri')
        ->controller(AsesmenFotoBerseriController::class)
        ->group(function(){
            Route::put('update/{id}','update');
            Route::post('store','store');
            Route::get('show','show');
            Route::get('show_by_id/{id}','show_by_id');
            Route::delete('delete/{asesmen_ceklis}','destroy');
        });

    });

    Route::post('/logout', [LoginController::class, 'logoutApi']);
});