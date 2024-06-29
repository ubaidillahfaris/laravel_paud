<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuruMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        try {
            $user = User::find(Auth::user()->id);
            $guru = $user->guru;
            if (Auth::user()->role != 'guru') {
                return $this->logout();
            }else if(!isset($guru)){
                return $this->logout();
            }
            return $next($request);
        } catch (\Throwable $th) {
            return $this->logout();
        }
    }

    private function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
