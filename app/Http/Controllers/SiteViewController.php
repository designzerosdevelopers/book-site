<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homepage;
use App\Models\Item;
class SiteViewController extends Controller
{
    
 /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $latestItems = Item::latest()->take(3)->get();
        $heroData = Homepage::first();
        return view('clientpages.index', ['heroData'=>$heroData, 'items'=>$latestItems]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function shop()
    {
        $Items = Item::get();
        return view('clientpages.shop', ['allitems' => $Items]);

    }

    public function blog()
    {
        return view('clientpages.blog');
    }

    public function cart()
    {
        return view('clientpages.cart');
    }

    public function checkout()
    {
        return view('clientpages.checkout');
    }

    public function contact()
    {
        return view('clientpages.contact');
    }



    public function thankyou()
    {
        return view('clientpages.thankyou');
    }

    public function about()
    {
        return view('clientpages.about');
    }
}
