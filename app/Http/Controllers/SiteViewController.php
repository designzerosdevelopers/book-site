<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\About;
use App\Models\Contact;
use App\Models\Settings;
use App\Models\Item;
use App\Models\User;
use App\Models\Categories;
use Illuminate\Support\Str;
use App\Models\Purchase;
use App\Models\Component;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExampleMail;
use App\Mail\PostPurchaseMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Sabberworm\CSS\CSSList\Document;
use Sabberworm\CSS\Parser;
use Illuminate\Support\Facades\Crypt;


class SiteViewController extends Controller
{

    public function productDetail($product)
    {
        $item = Item::where('slug', $product)->first();

        $dom = new \DOMDocument();
        $dom->loadHTML(\App\Helpers\SiteViewHelper::page('productdetail')->html);
        $xpath = new \DOMXPath($dom);

        $title = "//*[contains(concat(' ', normalize-space(@class), ' '), 'product-title')]";
        $xpath->query($title)->item(0)->nodeValue =  $item->name;

        $price = "//*[contains(concat(' ', normalize-space(@class), ' '), 'product-price')]";
        $xpath->query($price)->item(0)->nodeValue = '$' . $item->price;

        $price = "//*[contains(concat(' ', normalize-space(@class), ' '), 'product-description')]";
        $xpath->query($price)->item(0)->nodeValue =  $item->description;

        $dom->getElementById("poster")->setAttribute('src', asset('book_images/' . $item->image));

        $dom->getElementById("cart")->setAttribute('href', route('cart', ['id' => encrypt($item->id)]));

        return view('clientpages.productdetail', ['product' => $dom->saveHTML()]);
    }


    public function getProductsByCategory($category)
    {
        $products = Item::where('id', $category)->get();
        return response()->json($products);
    }



    public function blog()
    {
        return view('clientpages.blog');
    }


    public function cart(Request $r, $encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        // Check if the 'id' parameter is present in the request
        if (!$id) {
            // Retrieve existing cart data from the cookie
            $cart = json_decode($r->cookie('cart'), true) ?? [];

            // Return the view with cart data
            return view('clientpages.cart', [
                'cartItems' => $cart,
            ]);
        }

        // Retrieve existing cart data from the cookie
        $cart = json_decode($r->cookie('cart'), true) ?? [];

        // Find the item
        $item = Item::find($id);

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
        $cookie = cookie('cart', json_encode($cartItems), 60 * 24 * 30);

        // Redirect back to the cart page
        return redirect()->route('cart')->withCookie($cookie);
    }


    public function checkout(request $request)
    {
        // // Retrieve the subtotal from the form data
        // $subtotal = $request->input('subtotal');

        // Retrieve the current cart items from the cookie
        $cartItems = json_decode(request()->cookie('cart'), true) ?? [];
        foreach ($cartItems as $value) {
            $subtotal = $value['item_price'];
        }

        $stripeIds = [1, 2];
        $stripeSettings = Settings::find($stripeIds)->pluck('value');
        $stripe = $stripeSettings->isNotEmpty() && !$stripeSettings->contains('');

        $paypalIds = [3, 4];
        $paypalSettings = Settings::find($paypalIds)->pluck('value');
        $paypal = $paypalSettings->isNotEmpty() && !$paypalSettings->contains('');

        return view('clientpages.checkout', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'paypal' => $paypal,
            'stripe' => $stripe
        ]);
    }


    public function contact()
    {
        $data = Contact::first();
        return view('clientpages.contact', ['contact' => $data]);
    }



    public function thankyou(request $request)
    {
        $cartItems = $request->cartItems;
        return view('clientpages.thankyou', ['cartItems' => $cartItems]);
    }

    public function about()
    {
        $data = About::first();
        $pages = Home::first();
        return view('clientpages.about', ['data' => $data, 'pages' => $pages]);
    }

    public function getCartItemCount()
    {
        $dataCookie = request()->cookie('cart');
        $records = json_decode($dataCookie, true);

        // Check if decoding was successful and $records is not null
        if ($records !== null) {
            $recordCount = count($records);
            return $recordCount;
        } else {
            // Handle the case when the cookie is empty or not set
            return 0; // or handle it in some other way
        }
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
                $customer_name =  ucwords($user->name . ' ' . $user->last_name);
                // if user exists get its id
                $userid = $user->id;

                foreach (array_keys($data['amp;cartItems']) as $itemId) {
                    Purchase::create([
                        'user_id' => $user->id,
                        'item_id' => $itemId
                    ]);
                }

                // Remove cart cookie
                if (isset($_COOKIE['cart'])) {
                    unset($_COOKIE['cart']);
                    setcookie('cart', '', time() - 3600, '/'); // expire the cart cookie
                }

                // Remove all data from the session
                Session::flush();

                try {
                    Mail::to($email)->send(new PostPurchaseMail($customer_name, $email));

                    Session::flash('repurchases', 'Your purchase was successful! You can now download your book and check your email for further instructions.');
                } catch (\Exception $e) {
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


                foreach (array_keys($data['amp;cartItems']) as $itemId) {
                    Purchase::create([
                        'user_id' => $user->id,
                        'item_id' => $itemId
                    ]);
                }



                // Remove cart cookie
                if (isset($_COOKIE['cart'])) {
                    unset($_COOKIE['cart']);
                    setcookie('cart', '', time() - 3600, '/'); // expire the cart cookie
                }

                $user = User::where('email', $email)->first();
                $customer_name =  ucwords($user->name . ' ' . $user->last_name);

                // Remove all data from the session
                Session::flush();

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
}
