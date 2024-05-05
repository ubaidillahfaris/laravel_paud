<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function adminWithSekolah(int $id){
        $user = User::with('sekolah')->find($id);
        return $user;
    }
}
