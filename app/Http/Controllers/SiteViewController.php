<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homepage;
use App\Models\Item;
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
        // Retrieve existing cart items from the request
        $cartItems = $request->cookie('cart_items') ? json_decode($request->cookie('cart_items'), true) : [];
    
        // Find the item
        $item = Item::find($request->id);
    
        if (!$item) {
            // Handle the case where the item is not found
            return response()->json(['error' => 'Item not found'], 404);
        }
    
        // Check if the request contains the quantity parameter
        $quantity = $request->has('quantity') ? $request->input('quantity') : 1;
    
        // Add the item as a new entry in the cart
        $cartItems[$item->id] = [
            'item_id'       => $item->id,
            'item_image'    => $item->image,
            'item_price'    => $item->price,
            'item_name'     => $item->name,
            'item_quantity' => $quantity
        ];
    
        // Set the cart items as a cookie
        $cookie = cookie('cart_items', json_encode($cartItems), strtotime('+1 month'));

        dd($cookie);
    
        // Return the view with the cart items
        return view('clientpages.cart', ['cartItems' => $cookie])->withCookie($cookie);
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
