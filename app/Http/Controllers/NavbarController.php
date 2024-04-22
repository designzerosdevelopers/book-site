<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Navbar;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class NavbarController extends Controller
{
    public function index()
    {
        $navbarItems = Navbar::get();
        return view('adminpages.editpages.editmanu', compact('navbarItems'));
    }

    public function update(Request $request, $id)
    {
       
        $navbarcount = DB::table('navbar')->count();
        if($request->position > $navbarcount){
            return redirect()->back()->with('error', 'The position should not be greather then '.$navbarcount);
        }
        $navbar = Navbar::find($id);
        
        if (!$navbar) {
            return redirect()->back()->with('error', 'Navbar item not found');
        }

        $oldFileName = $navbar->route . '.blade.php';

        $navbar->name = $request->name;
        $navbar->position = $request->position;
        $navbar->route = $request->route;
        
        if ($navbar->save()) {
            // Get the new file name
            $newFileName = $request->route. '.blade.php';
            // Get the path to the directory where your Blade files are stored
            $directoryPath = resource_path('views/clientpages');

            // Check if the old file exists
            if (File::exists($directoryPath . '/' . $oldFileName)) {
                
                // Rename the file
                File::move($directoryPath . '/' . $oldFileName, $directoryPath . '/' . $newFileName);
                return redirect()->back()->with('success', "Changes saved successfully!");
            } else {
                return redirect()->back()
                ->with('error', 'Old file does not exist!');
            }

        } else {
            return redirect()->back()
                ->with('error', 'Navbar item could not be updated');
        }
        
    }
}
