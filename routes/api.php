<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\PpdbMasterController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SurveyAsesmenController;
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
            ->controller(SurveyAsesmenController::class)
            ->group(function(){
                Route::get('data/{ppdb_master}','showAsesmenFromPpdbMaster');
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