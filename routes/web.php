<?php

use App\Http\Controllers\AdminSekolahController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\SekolahController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('guest')
->group(function(){
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

    Route::prefix('admin_sekolah')
    ->name('admin_sekolah.')
    ->controller(AdminSekolahController::class)
    ->group(function(){
        Route::post('add_admin','addAdminSekolah')->name('add_admin');
        Route::delete('delete/{user_id}','deleteAdmin')->name('delete');
        Route::put('restore/{user_id}','restoreAdmin')->name('restore');
    });

    Route::prefix('sekolah')
    ->name('sekolah.')
    ->controller(SekolahController::class)
    ->group(function(){
        Route::post('store','store')->name('store');
        Route::put('update/{id}','update')->name('update');
        Route::delete('delete/{id}','delete')->name('delete');
    });

    Route::prefix('kelas')
    ->name('kelas.')
    ->controller(KelasController::class)
    ->group(function(){
        Route::post('store','store')->name('store');
        Route::delete('delete','delete')->name('delete');
    });

    Route::prefix('ppdb')
    ->name('ppdb.')
    ->controller(PpdbController::class)
    ->group(function(){
        Route::post('store','store')->name('store');
        Route::get('show','show')->name('show');
    });
});