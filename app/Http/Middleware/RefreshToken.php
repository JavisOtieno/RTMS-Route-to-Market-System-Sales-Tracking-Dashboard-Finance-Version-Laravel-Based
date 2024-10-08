<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class RefreshToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
        Log::info('Current Token: ', ['token' => 'start']);
        if (Auth::check()) {
            Log::info('Current Token: ', ['token' => 'check']);
            // Refresh the token's expiration (e.g., add more time)
            $user = Auth::user();
            if($user){
            $token = $request->user()->currentAccessToken();
            Log::info('Current Token: ', ['token' => $token]);
            // $token->forceFill([
            //     'expires_at' => now()->addMinutes(config('sanctum.expiration')),
            // ])->save();
            $token->update([
                'expires_at' => now()->addMinutes(config('sanctum.expiration')),
            ]);
            }else{
                Log::info('Current Token: ', ['token' => 'else']);
            }
        }

        return $next($request);
    }

    // public function handle($request, Closure $next)
    // {
    //     // Check if the user is authenticated
    //     if (Auth::check()) {
    //         // Refresh the token's expiration (e.g., add more time)
    //         $user = Auth::user();
    //         $token = $request->user()->currentAccessToken();
    //         $token->forceFill([
    //             'expires_at' => now()->addMinutes(config('sanctum.expiration')),
    //         ])->save();
    //     }

    //     return $next($request);
    // }
}

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Support\Facades\Auth;

// class RefreshToken
// {

// }

