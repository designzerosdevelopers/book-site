<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
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

            return redirect()->route('index');
        } catch (\Exception $e) {
            return view('auth.setup');
        }

        return view('auth.setup');
    }

    public function setConfig(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'db_name' => 'required|string',
            'db_username' => 'required|string',
            'db_host' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('setup.create')->withErrors($validator)->withInput();
        }



        $configFile = config_path('database.php');
        $configContent = file_get_contents($configFile);

        $configContent = preg_replace("/'host' => '.*?'/", "'host' => '{$request->input('db_host')}'", $configContent);
        $configContent = preg_replace("/'database' => '.*?'/", "'database' => '{$request->input('db_name')}'", $configContent);
        $configContent = preg_replace("/'username' => '.*?'/", "'username' => '{$request->input('db_username')}'", $configContent);
        $configContent = preg_replace("/'password' => '.*?'/", "'password' => '{$request->input('db_password')}'", $configContent);

        file_put_contents($configFile, $configContent);
        Artisan::call('config:clear');
        return view('auth.admin.test_db');
    }


    public function migrate()
    {
        try {
            DB::reconnect('mysql');
            DB::connection()->getPdo();

            if (!Schema::hasTable('users')) {
                Artisan::call('migrate');
                Session::flash('db_success', 'Database setup successful');
                return redirect()->route('register');
            }
        } catch (\Exception $e) {
            Session::flash('db_error', substr($e->getMessage(), strrpos($e->getMessage(), ']') + 2));
            return redirect()->route('setup.create');
        }

        if (Schema::hasTable('users')) {
            Session::flash('db_success', 'Database setup successful');
            return redirect()->route('register');
        }
    }
}
