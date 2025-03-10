<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function loginPage(){
        return Inertia::render('Auth/Login');
    }

    public function login(Request $request){
       try {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            switch (Auth::user()->role) {
                case 'superadmin':
                    return redirect()
                    ->route('dashboard.superadmin');
                break;
                case 'admin':
                    return redirect()
                    ->route('dashboard.admin');
                break;
                case 'guru':
                    return redirect()
                    ->route('dashboard.guru');
                case 'wali':
                        return redirect()
                        ->route('dashboard.wali');
                    break;
            }
        }

       } catch (\Throwable $th) {
        throw $th;
       }
    }

    public function loginApi(Request $request){
        // dd($request->all());

        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);
            
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                
                $token = Auth::user()->createToken('auth_token')->plainTextToken;
                
                return response()->json([
                    'message' => 'Login success',
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'user' => Auth::user()
                ]);
            }else{
                return response()
                ->json([
                    'message' => 'gagal login'
                ],500);
            }
    
           } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'gagal login'
            ],500);
           }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function logoutApi()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'logout success'
        ]);
    }
}

