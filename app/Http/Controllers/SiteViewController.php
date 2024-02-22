<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homepage;
use App\Models\Item;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;

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

    public function cart(Request $request)
    {

        // $response = new Response('Content');
        // $response = $response->withoutCookie('cart'); // Remove 'cart' cookie
        // // Add more withoutCookie calls for other cookies if needed
    
        // return $response;
        // Retrieve existing cart data from the cookie
        $cart = json_decode($request->cookie('cart'), true) ?? [];
    
        // Find the item
        $item = Item::find($request->id);
    
        // Add the item to the cart
        $cart[$item->id] = [
            'id' => $item->id,
            'name' => $item->name,
            'price' => $item->price,
            // Add other item properties you want to store in the cart
        ];
  //  dd($request->cookies->all());
        // Update the cart data in the cookie
        return response()
            ->view('clientpages.cart')
            ->cookie('cart', json_encode($cart), 60);
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
