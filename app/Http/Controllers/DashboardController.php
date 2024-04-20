<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function superadmin(){
        
    }

    public function admin(){
        return Inertia::render('Dashboard/admin');
    }

    public function wali(){
        return Inertia::render('Dashboard/admin');
    }
}
