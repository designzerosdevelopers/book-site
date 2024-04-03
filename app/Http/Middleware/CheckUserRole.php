<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if ($request->user() && $request->user()->role == 1) {
            return $next($request);
        }elseif ($request->user() && $request->user()->role == 0) {
            return redirect()->route('purchases.index');
        }

        // If the user is not authenticated or does not have the required role, redirect or abort as needed
        abort(403, 'Unauthorized');
    }
}

