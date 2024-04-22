<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class SetupController extends Controller
{
    public function create()
    {

        try {

            DB::connection()->getPdo();

            // Check if the 'users' table exists
            if (!Schema::hasTable('users')) {
                // If the 'users' table doesn't exist, redirect to the setup page
                return view('auth.setup')->with('error', 'The users table does not exist.');
            }

            // Check if there are users with role 1
            if (!User::where('role', 1)->exists()) {
                // If there are no users with role 1, redirect to the setup page
                return view('auth.setup')->with('error', 'No users with role 1 found.');
            }
        } catch (\Exception $e) {
            return view('auth.setup');
        }

        return view('auth.setup');
    }

    public function store(Request $request)
    {
        // Validate the form data

        $validator = Validator::make($request->all(), [
            'db_name' => 'required|string',
            'db_username' => 'required|string',
            'db_host' => 'required',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->route('setup.create')->withErrors($validator)->withInput();
        }


        // If validation passes, update the .env file with the new database connection settings
        $envContent = file_get_contents(base_path('.env'));
        $envContent = preg_replace('/DB_DATABASE=.*\n/', 'DB_DATABASE=' . $request->input('db_name') . "\n", $envContent);
        $envContent = preg_replace('/DB_USERNAME=.*\n/', 'DB_USERNAME=' . $request->input('db_username') . "\n", $envContent);
        $envContent = preg_replace('/DB_PASSWORD=.*\n/', 'DB_PASSWORD=' . $request->input('db_password') . "\n", $envContent);
        $envContent = preg_replace('/DB_HOST=.*\n/', 'DB_HOST=' . $request->input('db_host') . "\n", $envContent);

        file_put_contents(base_path('.env'), $envContent);

        try {
            DB::connection()->getPdo();

            $this->mig();

            return view('auth.admin.register')->with('success', 'Database connection settings updated successfully.');
        } catch (\Exception $e) {
            $errorMessage = 'Database connection failed: ' . (strpos($e->getMessage(), ':') !== false ? explode(':', $e->getMessage(), 2)[1] : $e->getMessage());
            // Flash the error message to the session
            Session::flash('db_error', $errorMessage);
            return redirect()->route('setup.create');
        }
        return view('auth.admin.register')->with('success', 'Database connection settings updated successfully.');
    }

    public function mig()
    {
        if (!Schema::hasTable('users')) {
            Artisan::call('optimize:clear');
            Artisan::call('migrate');
            return view('auth.admin.register')->with('success', 'Database connection settings updated successfully.');
        }
    }
}
