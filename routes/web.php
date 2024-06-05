<?php

use App\Http\Controllers\AdminSekolahController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\PpdbMasterController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\TahunPelajaranController;
use App\Http\Controllers\WilayahController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\PpdbMaster;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::middleware('guest')
->group(function(){

    Route::get('/',function(){return redirect('login');});
    Route::post('register',[RegisteredUserController::class,'store'])->name('register');
    Route::get('register',function(){
        return Inertia::render('Auth/Register');
    })->name('register');
    Route::post('login',[LoginController::class,'login'])->name('login');
    Route::get('login',[LoginController::class,'loginPage'])->name('login');
});

Route::middleware('auth')
->group(function(){
    
    Route::post('logout',[LoginController::class,'logout'])
    ->name('logout');

    Route::prefix('dashboard')
    ->name('dashboard.')
    ->controller(DashboardController::class)
    ->group(function(){
        Route::get('superadmin','superadmin')->name('superadmin');
        Route::get('admin','admin')->name('admin');
        Route::get('wali','wali')->name('wali');
    });


    Route::prefix('wilayah')
    ->name('wilayah.')
    ->controller(WilayahController::class)
    ->group(function(){
        Route::get('provinsi','provinsi')->name('provinsi');
        Route::get('kota/{province_id?}','kota')->name('kota');
        Route::get('kecamatan/{kota_id}','kecamatan')->name('kecamatan');
        Route::get('desa/{kecamatan_id}','desa')->name('desa');
    });

    Route::middleware(\App\Http\Middleware\SuperadminMiddleware::class)
    ->group(function(){

        Route::prefix('sekolah')
        ->name('sekolah.')
        ->controller(SekolahController::class)
        ->group(function(){
            Route::get('/','index')->name('index');
            Route::get('add','add')->name('add');
            Route::get('show','show')->name('show');
            Route::post('store','store')->name('store');
            Route::put('update/{id}','update')->name('update');
            Route::delete('delete/{id}','delete')->name('delete');
        });

        Route::prefix('admin_sekolah')
        ->name('admin_sekolah.')
        ->controller(AdminSekolahController::class)
        ->group(function(){
            Route::get('add_admin_page/{sekolah_id}','addAdminPage')->name('add_admin_page');
            Route::get('show/{sekolah_id}','show')->name('show');
            Route::post('add_admin','addAdminSekolah')->name('add_admin');
            Route::delete('delete/{user_id}','deleteAdmin')->name('delete');
            Route::put('restore/{user_id}','restoreAdmin')->name('restore');
        });
    });

    
    Route::middleware(AdminMiddleware::class)
    ->group(function(){

        Route::prefix('kelas')
        ->name('kelas.')
        ->controller(KelasController::class)
        ->group(function(){
            Route::get('index','index')->name('index');
            Route::get('edit/{id}','edit')->name('edit');
            Route::put('update/{id}','update')->name('update');
            Route::get('create','create')->name('create');
            Route::get('show','show')->name('show');
            Route::post('store','store')->name('store');
            Route::delete('delete/{id}','delete')->name('delete');
        });
    
        Route::prefix('tahun_ajaran')
        ->name('tahun_ajaran.')
        ->controller(TahunPelajaranController::class)
        ->group(function(){
            Route::get('index','index')->name('index');
            Route::post('create','create')->name('create');
            Route::get('show','show')->name('show');
            Route::get('show_all','showAll')->name('show_all');
            Route::put('update_status/{id}','updateStatus')->name('update_status');
            Route::put('update/{id}','update')->name('update');
            Route::delete('delete/{id}','delete')->name('delete');
        });

        Route::prefix('ppdb')
        ->group(function(){

            Route::name('ppdb.')
            ->controller(PpdbController::class)
            ->group(function(){
                Route::get('/','index')->name('index');
                Route::get('create','create')->name('create');
                Route::post('create_group','createGroup')->name('create_group');
                Route::post('store','store')->name('store');
                Route::get('show','show')->name('show');
                Route::get('validasi/{gelombang_id}','validasi')->name('validasi');
                Route::get('data_siswa/{gelombang_id}','dataSiswa')->name('data_siswa');
                Route::get('detail_pendaftar/{ppdb_id}','detailPendaftar')->name('detailPendaftar');
                Route::put('validasi/{ppdb_id}','validasiSiswa')->name('validasi');
            });

            Route::prefix('master')
            ->name('ppdb.master.')
            ->controller(PpdbMasterController::class)
            ->group(function(){
                Route::post('create','create')->name('create');
                Route::get('data','show')->name('show');
            });
        });
    });
   

   
});