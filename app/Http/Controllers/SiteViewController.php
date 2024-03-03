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
    public function cart(Request $request)
    {
       // Check if the 'id' parameter is present in the request
        if (!$request->has('id')) {
            // Retrieve existing cart data from the cookie
            $cart = json_decode($request->cookie('cart'), true) ?? [];
            
            // Return the view with cart data
            return view('clientpages.cart', [
                'cartItems' => $cart,
            ]);
        }
    
        // Retrieve existing cart data from the cookie
        $cart = json_decode($request->cookie('cart'), true) ?? [];
    
        // Find the item
        $item = Item::find($request->id);
    
        if (!isset($cart[$item->id])) {
            // If the item is not in the cart, add it with a quantity of 1
            $cart[$item->id] = [
                'item_id' => $item->id,
                'item_image' => $item->image,
                'item_file' => $item->file,
                'item_name' => $item->name,
                'item_price' => $item->price,
                'item_quantity' => 1,
            ];
        }
    
        // Update the cart data in the cookie
        $response = response()->view('clientpages.cart', [
            'cartItems' => $cart, // Pass the cart data with the name 'cartItems' to the view
        ])->cookie('cart', json_encode($cart), 60);
    
        return $response;
    }
    

    public function removeFromCart($itemId)
    {
        // Retrieve the current cart items from the cookie
        $cartItems = json_decode(request()->cookie('cart'), true) ?? [];

        // Remove the item with the given itemId from the cart
        unset($cartItems[$itemId]);

        // Encode the modified cart items and update the cookie
        $cookie = cookie('cart', json_encode($cartItems), 60*24*30); // 1 month expiry (60 minutes * 24 hours * 30 days)

        // Redirect back to the cart page
        return redirect()->route('cart')->withCookie($cookie);
    }


    public function checkout(request $request)
    {
        // Retrieve the subtotal from the form data
        $subtotal = $request->input('subtotal');

        // Retrieve the current cart items from the cookie
        $cartItems = json_decode(request()->cookie('cart'), true) ?? [];
        
        return view('clientpages.checkout', ['cartItems' => $cartItems], ['subtotal' => $subtotal]);
    }
    

    public function contact()
    {
        return view('clientpages.contact');
    }



    public function thankyou(request $request)
    {
        $cartItems = $request->cartItems;
        return view('clientpages.thankyou',['cartItems' => $cartItems]);
    }

    public function about()
    {
        return view('clientpages.about');
    }
}
