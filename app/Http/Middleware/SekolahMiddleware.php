<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SekolahMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $sekolah_id = null;
        switch ($user->role) {
            case 'guru':
                $userData = $user->guru;
                $sekolah_id = $userData->sekolah_id;
                break;
            
            case 'admin':
                $userData = $user->sekolah;
                $sekolah_id = $userData->id;
                break;
        }

        if ($sekolah_id != null) {
            $request->attributes->set('sekolah_id', $sekolah_id);
            return $next($request);
        }



    }
}
