<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckDatabase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        try {
            DB::connection()->getPdo();

            // Check if the 'users' table exists
            if (!Schema::hasTable('users')) {
                // If the 'users' table doesn't exist, redirect to the setup page
                return redirect()->route('setup.create')->with('error', 'The users table does not exist.');
            }

            // Check if there are users with role 1
            if (!User::where('role', 1)->exists()) {
                // If there are no users with role 1, redirect to the setup page
                return redirect()->route('setup.create')->with('error', 'No users with role 1 found.');
            }

            // If both conditions are met, proceed with the request
            return $next($request);
        } catch (\Exception $e) {
            // If an exception occurs (indicating a database connection failure), redirect to the setup page
            return redirect()->route('setup.create')->with('error', 'Database connection failed.');
        }
    }
}
