<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class WaliMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request,Closure $next): Response
    {

        
        dd($request->all());
        // if (Auth::user()->role != 'wali') {
        //     return response()->json([
        //         'error' => 'Unauthorized'
        //     ],400);

        // }
        return $next($request);
    }
}
