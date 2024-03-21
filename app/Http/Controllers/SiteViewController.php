<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homepage;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Purchase;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExampleMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class SiteViewController extends Controller
{
    
 /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $latestItems = Item::latest()->take(3)->get();
        return view('clientpages.index', ['items'=>$latestItems]);
    }

    public function productdetails(Request $request)
    {
        $product = Item::find($request->id);
        return view('clientpages/productdetail',['product' => $product]);
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
            $cart[$item->id] = [
                'item_id' => $item->id,
                'item_image' => $item->image,
                'item_file' => $item->file,
                'item_name' => $item->name,
                'item_price' => $item->price
            ];
        }
    
        // Update the cart data in the cookie
        $response = response()->view('clientpages.cart', [
            'cartItems' => $cart,
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
        $cookie = cookie('cart', json_encode($cartItems), 60*24*30);

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

    public function getCartItemCount(){
        $dataCookie = request()->cookie('cart');
        $records = json_decode($dataCookie, true);
        $recordCount = count($records);
        return $recordCount;
    }
    

   

    public function user(Request $request)
    {
    
        if (!empty(session('requestData'))) {

            // Retrieve data from session
            $data = session('requestData');

            // if the account is previously added fetch that through email
            $email = $data['email_address'];
            $user = User::where('email', $email)->first();
            
            if ($user) {
                 // if user exists get its id
                $userid = $user->id;

                $itemIds = [];
                foreach ($data['cartItems'] as $cartItem) {
                    $itemIds[] = $cartItem['item_id'];
                }
                
                // Create separate purchases for each item ID
                foreach ($itemIds as $itemId) {
                    Purchase::create([
                        'user_id' => $user->id,
                        'item_id' => $itemId
                    ]);
                }

            } else {
                // Generate random password
                $randomPassword = Str::random(8);
                $hashedPassword = Hash::driver('bcrypt')->make($randomPassword);

                // Create user
                $user = User::create([
                    'name' => $data['f_name'],
                    'last_name' => $data['l_name'],
                    'address' => $data['address1'],
                    'state/country' => $data['state_country'],
                    'postal/zip' => $data['postal_zip'],
                    'email' => $data['email_address'],
                    'phone' => $data['phone'],
                    'password' => $hashedPassword
                ]);

                $itemIds = [];
                foreach ($data['cartItems'] as $cartItem) {
                    $itemIds[] = $cartItem['item_id'];
                }
                
                // Create separate purchases for each item ID
                foreach ($itemIds as $itemId) {
                    Purchase::create([
                        'user_id' => $user->id,
                        'item_id' => $itemId
                    ]);
                }

              
               $customer_name =  ucwords($user->name.' '.$user->last_name);


            //    // Generate a unique token
            //    $token = Str::random(60);

            //    // Store the token and email in the password_resets table
            //   // Store the token and email in the password_resets table
            //     DB::table('password_reset_tokens')->updateOrInsert(
            //         ['email' => $email],
            //         ['email' => $email, 'token' => $token, 'created_at' => now()]
            //     );


                try {
                  Mail::to($email)->send(new ExampleMail($customer_name, $randomPassword, $email,));

                    
                    Session::flash('email_sent');
                } catch (\Exception $e) {
                 
                    // Log the exception or handle it as per your application's requirement
                    Session::flash('error');
                }



            }

            event(new Registered($user));

            Auth::login($user);
    
            return redirect()->route('purchases.index');
        }


    }

    public function passwordreset()
    {
       
    }
}