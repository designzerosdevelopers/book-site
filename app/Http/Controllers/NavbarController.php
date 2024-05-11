<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Navbar;
use Illuminate\Support\Facades\DB;


class NavbarController extends Controller
{
    public function index()
    {
        return view('adminpages.editpages.editmanu');
    }

    public function update(Request $request, $id)
    {
        $navbarcount = DB::table('navbar')->count();
        if ($request->position > $navbarcount) {
            return redirect()->back()->with('error', 'The position should not be greater than '.$navbarcount);
        }
        
        $navbar = Navbar::find($id);
        if (!$navbar) {
            return redirect()->back()->with('error', 'Navbar item not found');
        }

        $navbar->name = $request->name;
        $navbar->position = $request->position;

        if ($navbar->save()) {
            return redirect()->back()->with('success', "Changes saved successfully!");
        } else {
            return redirect()->back()->with('error', 'Navbar item could not be updated');
        }
    }

}
