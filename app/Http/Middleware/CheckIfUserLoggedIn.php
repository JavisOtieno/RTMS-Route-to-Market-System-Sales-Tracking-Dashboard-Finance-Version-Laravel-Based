<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class CheckIfUserLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!Auth::check()) {
            // return route('signup'); 
            
            return redirect()->route('login');         
        }
        // else if(
        //     Auth::user()->organization->status=='inactive' 
        // ){
        //     return redirect()->route('login')->withErrors([
        //         'organization' => 'Organization suspended. Contact Support',
        //     ])
        //     ->withInput($request->only('email'));

        // }
        else if(Auth::user()->usertype=='seller'){
            return redirect()->route('login')->withErrors([
                'seller' => 'The provided credentials do not match our records.',
            ])
            ->withInput($request->only('email'));
            
        }  
            // return route('signup');
            // return redirect()->route('signup');
        

        return $next($request);
    }
}
