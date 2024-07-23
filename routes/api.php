<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\PpdbMasterController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SurveyAsesmenController;
use App\Http\Controllers\SurveyAsesmenJawabanController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\WilayahController;
use App\Models\SurveyAsesmen;
use Illuminate\Support\Facades\Route;


Route::post('/login', [LoginController::class, 'loginApi']);
Route::post('/register',[RegisteredUserController::class,'registerApi']);

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('wilayah')
    ->controller(WilayahController::class)
    ->group(function(){
        Route::get('kota/{slug?}','kota');
    });


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

    });

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

        Route::prefix('keuangan')
        ->name('keuangan.')
        ->group(function(){

            Route::prefix('tagihan')
            ->name('tagihan.')
            ->controller(TagihanController::class)
            ->group(function(){
                Route::get('tagihan_by_ortu','showTagihanByOrtuNotPaid')->name('tagihan_by_ortu');
            });

        });


        Route::prefix('orang_tua')
        ->controller(OrangTuaController::class)
        ->group(function(){
            Route::get('data/{user_id}','data');
        });

    });

    Route::post('/logout', [LoginController::class, 'logoutApi']);
});