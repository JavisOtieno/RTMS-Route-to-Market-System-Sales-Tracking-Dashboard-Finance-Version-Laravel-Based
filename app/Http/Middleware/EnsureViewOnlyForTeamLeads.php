<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class EnsureViewOnlyForTeamLeads
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $product = Product::find($request->route()->parameter('id')); // Assumes the model is passed as a route parameter

        if ($user->usertype === 'teamlead') {
            if ($product && $product->team_id === null) {
                // abort(403, 'Access denied');

                if (in_array($request->route()->getActionMethod(), ['saveEditProduct', 'saveEditService',
                'deleteProduct','deleteService'])) {
                    abort(403, 'View-only access for teamleads');
                }
            }

            
        }

        return $next($request);
    }
}
