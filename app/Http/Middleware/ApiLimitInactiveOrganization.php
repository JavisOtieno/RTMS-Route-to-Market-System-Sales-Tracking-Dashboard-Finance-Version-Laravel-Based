<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiLimitInactiveOrganization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(
            Auth::user()->organization->status=='inactive' 
        ){

            return response()->json(['message' => 'Organization Suspended'], 401);

        }else if(
            Auth::user()->status=='inactive' 
        ){

            return response()->json(['message' => 'Seller Account Suspended'], 401);

        }
        //IDEAL NOT TO LET ADMIN ACCESS APP
        // else if(Auth::user()->usertype!='seller'){
        //     return redirect()->route('login')->withErrors([
        //         'seller' => 'The provided credentials do not match our records.',
        //     ])
        //     ->withInput($request->only('email'));
            
        // }  
        return $next($request);
    }
}
