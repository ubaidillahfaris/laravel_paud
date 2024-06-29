<?php

use App\Http\Controllers\AdminSekolahController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KegiatanRpphController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\PpdbMasterController;
use App\Http\Controllers\ProgramLayananController;
use App\Http\Controllers\RiwayatKelasController;
use App\Http\Controllers\RpphController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TahunPelajaranController;
use App\Http\Controllers\WilayahController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\GuruMiddleware;
use App\Models\KegiatanRpph;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('guest')
->group(function(){

    Route::get('/',function(){return redirect('login');});
    Route::post('register',[RegisteredUserController::class,'store'])->name('register_page');
    Route::get('register',function(){
        return Inertia::render('Auth/Register');
    })->name('register');
    Route::post('login',[LoginController::class,'login'])->name('login_page');
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

    
    /**
     * Admin route
     */
    Route::middleware(AdminMiddleware::class)
    ->group(function(){

        Route::prefix('siswa')
        ->name('siswa.')
        ->controller(SiswaController::class)
        ->group(function(){
            Route::get('show/{kelas_id}','show')->name('show');
            Route::get('/{kelas_id}','index')->name('index');
        });

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

        Route::prefix('guru')
        ->name('guru.')
        ->controller(GuruController::class)
        ->group(function(){
            Route::get('show','show')->name('show');
            Route::put('update/{userId}','update')->name('update');
            Route::delete('delete/{id}','destroy')->name('delete');
        });

        Route::prefix('riwayat_kelas')
        ->name('riwayat_kelas.')
        ->controller(RiwayatKelasController::class)
        ->group(function(){
            
        });

        Route::name('program_layanan.')
        ->prefix('program_layanan')
        ->controller(ProgramLayananController::class)
        ->group(function(){
            Route::get('index','index')->name('index');
            Route::get('data','data')->name('data');
            Route::post('store','store')->name('store');
            Route::get('show/{id}','show')->name('show');
            Route::put('update/{id}','update')->name('update');
            Route::delete('delete/{id}','destroy')->name('delete');
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
                Route::get('validasi/{gelombang_id}','validasi')->name('validasi_gelombang');
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


        Route::prefix('tabungan')
        ->name('tabungan.')
        ->controller(TabunganController::class)
        ->group(function(){
            Route::post('mutasi_masuk','mutasiMasuk')->name('mutasi_masuk');
            Route::post('mutasi_keluar','mutasiKeluar')->name('mutasi_keluar');
            Route::put('update/{transaksi_id}','update')->name('update');
            Route::delete('destroy/{transaksi_id}','destroy')->name('destroy');
        });
    });



    // middleware : guru

    Route::middleware(GuruMiddleware::class)
    ->group(function(){
        
        Route::prefix('tagihan')
        ->name('tagihan.')
        ->controller(TagihanController::class)
        ->group(function(){
            Route::post('store','store')->name('store');
            Route::put('bayar/{id}','bayar')->name('bayar');
            Route::put('validasi/{id}','validasi_pembayaran')->name('validasi_pembayaran');
            Route::delete('delete/{id}','destroy')->name('destroy');
            Route::get('show_siswa/{siswaId}','show_by_siswa_id')->name('show_by_siswa_id');
            Route::get('show_kelas/{kelasId}','show_by_kelas')->name('show_by_kelas');
        });

        Route::prefix('rpph')
        ->group(function(){
           
            Route::name('rpph.')->controller(RpphController::class)
            ->group(function(){
                Route::post('create','create')->name('create');
                Route::put('update/{rpphId}','update')->name('update');
                Route::delete('delete/{id}','delete')->name('delete');
            });

            Route::prefix('kegiatan')
            ->name('kegiatan.')
            ->controller(KegiatanRpphController::class)
            ->group(function(){
                Route::post('{rpphId}/store','store')->name('store');
                Route::put('update/{id}','id')->name('update');
                Route::delete('delete/{id}','delete')->name('delete');
            });
        });

    });
   

   
});