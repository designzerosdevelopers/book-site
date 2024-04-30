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
use App\Models\Footer;
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



class SiteViewController extends Controller
{
 /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Home::first();
        $latestItems = Item::latest()->take(3)->get();
        return view('clientpages.index', ['items'=>$latestItems, 'data' => $data]);
    }

    public function productdetails(Request $request)
    {
        $product = Item::find($request->id);
        return view('clientpages/productdetail',['product' => $product]);
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function shop(Request $request)
    {

        $categories = Categories::all();
        if ($request->ajax()) {
            if ($request->has('all')) {
                $allItems = Item::paginate(1);

                if ($allItems->isEmpty()) {
                    // Custom message for an empty page
                    $response = "<div style='text-align: center;'><p>Sorry, there are currently no items to display on this page.</p></div>";
                    return $response;
                }
                
                $response = '';
                foreach ($allItems as $item) {
                    $response .= '<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">';
                    $response .= '<div class="product-item">';
                    $response .= '<a style="text-decoration: none;" href="' . route('product.details', ['id' => $item->id]) . '">';
                    $response .= '<img src="' . asset('book_images/'.$item->image) . '" class="img-fluid product-thumbnail">';
                    $response .= '<h3 class="product-title">' . $item->name . '</h3>';
                    $response .= '<div>';
                    $response .= '<strong class="product-price">$' . $item->price . '</strong>';
                    $response .= '</div>';
                    $response .= '</a>';
                    $response .= '<a href="' . route('cart', ['id' => $item->id]) . '">';
                    $response .= '<button class="btn btn-primary" style="font-size: 12px; padding: 5px 10px;">';
                    $response .= '<p style="margin: 0;">Add to Cart</p>';
                    $response .= '</button>';
                    $response .= '</a>';
                    $response .= '</div>';
                    $response .= '</div>';
                }
        
                // Append pagination links to the response
                $response .= '<div class="row">';
                $response .= '<div class="col-md-12 text-center">';
                $response .= '<nav aria-label="Page navigation example">';
                $response .= '<ul class="pagination justify-content-center">';
                $response .= '<li class="page-item' . ($allItems->previousPageUrl() ? '' : ' disabled') . '">';
                $response .= '<a class="page-link" href="' . $allItems->previousPageUrl() . '" tabindex="-1" aria-disabled="true">Previous</a>';
                $response .= '</li>';
        
                foreach ($allItems->getUrlRange(1, $allItems->lastPage()) as $page => $url) {
                    $response .= '<li class="page-item ' . ($page == $allItems->currentPage() ? 'active' : '') . '">';
                    $response .= '<a class="page-link" href="' . $url . '">' . $page . '</a>';
                    $response .= '</li>';
                }
        
                $response .= '<li class="page-item ' . ($allItems->nextPageUrl() ? '' : 'disabled') . '">';
                $response .= '<a class="page-link" href="' . $allItems->nextPageUrl() . '">Next</a>';
                $response .= '</li>';
                $response .= '</ul>';
                $response .= '</nav>';
                $response .= '</div>';
                $response .= '</div>';
                return $response;
            }
       
            if ($request->has('category')) {
                $category = $request->category;
                $category_id = Categories::where('category_name', $request->category)->pluck('id')->first();
                $allitems = Item::where('category', $category_id)->paginate(1);
            
                if ($allitems->count() == 0) {
                    $response = '<div style="text-align: center;"><p>There are no items available in this category.</p></div>';

                    return $response;
                } else {
                    
                    $response = '';

                foreach ($allitems as $item) {
                    $response .= '<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">';
                    $response .= '<div class="product-item">';
                    $response .= '<a style="text-decoration: none;" href="'.route('product.details', ['id' => $item->id]).'">';
                    $response .= '<img src="'.asset('book_images/'.$item->image).'" class="img-fluid product-thumbnail">';
                    $response .= '<h3 class="product-title">'.$item->name.'</h3>';
                    $response .= '<div>';
                    $response .= '<strong class="product-price">$'.$item->price.'</strong>';
                    $response .= '</div>';
                    $response .= '</a>';
                    $response .= '<a href="'.route('cart', ['id' => $item->id]).'">';
                    $response .= '<button class="btn btn-primary" style="font-size: 12px; padding: 5px 10px;">';
                    $response .= '<p style="margin: 0;">Add to Cart</p>';
                    $response .= '</button>';
                    $response .= '</a>';
                    $response .= '</div>';
                    $response .= '</div>';
                }
                
                // Append pagination links to the response
                $response .= '<div class="row">';
                $response .= '<div class="col-md-12 text-center">';
                $response .= '<nav aria-label="Page navigation example">';
                $response .= '<ul class="pagination justify-content-center">';
                $response .= '<li class="page-item' . ($allitems->previousPageUrl() ? '' : ' disabled') . '">';
                $response .= '<a class="page-link" href="' . ($allitems->previousPageUrl() ? $allitems->previousPageUrl().'?category_id='.$category_id : '#') . '" tabindex="-1" aria-disabled="true">Previous</a>';
                $response .= '</li>';
            
                foreach ($allitems->getUrlRange(1, $allitems->lastPage()) as $page => $url) {
                    $response .= '<li class="page-item ' . ($page == $allitems->currentPage() ? 'active' : '') . '">';
                    // Append '?category_id=$category_id' to the URL
                    $response .= '<a class="page-link" href="' . $url . '?category_id=' . $category_id . '">' . $page . '</a>';
                    $response .= '</li>';
                }
            
                $response .= '<li class="page-item ' . ($allitems->nextPageUrl() ? '' : ' disabled') . '">';
                $response .= '<a class="page-link" href="' . ($allitems->nextPageUrl() ? $allitems->nextPageUrl().'?category_id='.$category_id : '#') . '">Next</a>';
                $response .= '</li>';
                $response .= '</ul>';
                $response .= '</nav>';
                $response .= '</div>';
                $response .= '</div>';
            
                return $response;
            
            }
            }

            if ($request->has('page')) {
                $data = $request->page;
                if (strpos($data, 'category') !== false) {
                    $perPage = 1;
                    $parts = explode('?', $data); // Split the string at the '?'
                    $page_number = $parts[0]; // Extract the page number
                    $combined_category = $parts[1]; // Extract the page number
                    $category = explode('=', $combined_category);
                    $category_id = $category[1]; 
                   
                    $allitems = Item::where('category', $category_id)->paginate($perPage, ['*'], 'page', $page_number);

                    $response = '';
                    foreach ($allitems as $item) {
                        $response .= '<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">';
                        $response .= '<div class="product-item">';
                        $response .= '<a style="text-decoration: none;" href="'.route('product.details', ['id' => $item->id]).'">';
                        $response .= '<img src="'.asset('book_images/'.$item->image).'" class="img-fluid product-thumbnail">';
                        $response .= '<h3 class="product-title">'.$item->name.'</h3>';
                        $response .= '<div>';
                        $response .= '<strong class="product-price">$'.$item->price.'</strong>';
                        $response .= '</div>';
                        $response .= '</a>';
                        $response .= '<a href="'.route('cart', ['id' => $item->id]).'">';
                        $response .= '<button class="btn btn-primary" style="font-size: 12px; padding: 5px 10px;">';
                        $response .= '<p style="margin: 0;">Add to Cart</p>';
                        $response .= '</button>';
                        $response .= '</a>';
                        $response .= '</div>';
                        $response .= '</div>';
                    }
                    
                    // Append pagination links to the response
                    $response .= '<div class="row">';
                    $response .= '<div class="col-md-12 text-center">';
                    $response .= '<nav aria-label="Page navigation example">';
                    $response .= '<ul class="pagination justify-content-center">';
                    $response .= '<li class="page-item' . ($allitems->previousPageUrl() ? '' : ' disabled') . '">';
                    $response .= '<a class="page-link" href="' . ($allitems->previousPageUrl() ? $allitems->previousPageUrl().'?category_id='.$category_id : '#') . '" tabindex="-1" aria-disabled="true">Previous</a>';
                    $response .= '</li>';
                
                    foreach ($allitems->getUrlRange(1, $allitems->lastPage()) as $page => $url) {
                        $response .= '<li class="page-item ' . ($page == $allitems->currentPage() ? 'active' : '') . '">';
                        // Append '?category_id=$category_id' to the URL
                        $response .= '<a class="page-link" href="' . $url . '?category_id=' . $category_id . '">' . $page . '</a>';
                        $response .= '</li>';
                    }
                
                    $response .= '<li class="page-item ' . ($allitems->nextPageUrl() ? '' : ' disabled') . '">';
                    $response .= '<a class="page-link" href="' . ($allitems->nextPageUrl() ? $allitems->nextPageUrl().'?category_id='.$category_id : '#') . '">Next</a>';
                    $response .= '</li>';
                    $response .= '</ul>';
                    $response .= '</nav>';
                    $response .= '</div>';
                    $response .= '</div>';
                
                    return $response;

                } else {
                    $perPage = 1;
                    $page_number = $data;
                    $allitems = Item::paginate($perPage, ['*'], 'page', $page_number);
                }
                
                $response = '';
                foreach($allitems as $item) {
                    $response .= '<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">';
                    $response .= '<div class="product-item">';
                    $response .= '<a style="text-decoration: none;" href="'.route('product.details', ['id' => $item->id]).'">';
                    $response .= '<img src="'.asset('book_images/'.$item->image).'" class="img-fluid product-thumbnail">';
                    $response .= '<h3 class="product-title">'.$item->name.'</h3>';
                    $response .= '<div>';
                    $response .= '<strong class="product-price">$'.$item->price.'</strong>';
                    $response .= '</div>';
                    $response .= '</a>';
                    $response .= '<a href="'.route('cart', ['id' => $item->id]).'">';
                    $response .= '<button class="btn btn-primary" style="font-size: 12px; padding: 5px 10px;">';
                    $response .= '<p style="margin: 0;">Add to Cart</p>';
                    $response .= '</button>';
                    $response .= '</a>';
                    $response .= '</div>';
                    $response .= '</div>';
                }
                
                // Append pagination links to the response
                $response .= '<div class="row">';
                $response .= '<div class="col-md-12 text-center">';
                $response .= '<nav aria-label="Page navigation example">';
                $response .= '<ul class="pagination justify-content-center">';
                $response .= '<li class="page-item' . ($allitems->previousPageUrl() ? '' : ' disabled') . '">';
                $response .= '<a class="page-link" href="' . $allitems->previousPageUrl() . '" tabindex="-1" aria-disabled="true">Previous</a>';
                $response .= '</li>';
            
                foreach ($allitems->getUrlRange(1, $allitems->lastPage()) as $page => $url) {
                    $response .= '<li class="page-item ' . ($page == $allitems->currentPage() ? 'active' : '') . '">';
                    $response .= '<a class="page-link" href="' . $url . '">' . $page . '</a>';
                    $response .= '</li>';
                }
            
                $response .= '<li class="page-item ' . ($allitems->nextPageUrl() ? '' : 'disabled') . '">';
                $response .= '<a class="page-link" href="' . $allitems->nextPageUrl() . '">Next</a>';
                $response .= '</li>';
                $response .= '</ul>';
                $response .= '</nav>';
                $response .= '</div>';
                $response .= '</div>';
            
                return $response;
            }

            // Check if the request has the 'query' parameter
            if ($request->has('query')) {

                $searchQuery = $request->input('query');
           
                // Retrieve all items that match the search query
                $allitems = Item::where('name', 'like', '%'.$searchQuery.'%')->paginate(1);

                // Optionally, you can check if any items were found
                if ($allitems->isEmpty()) {
                    $response = "No items found for search query: " . $searchQuery;
                    return $response;
                } else {
                    $response = '';
                    foreach($allitems as $item) {
                        $response .= '<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">';
                        $response .= '<div class="product-item">';
                        $response .= '<a style="text-decoration: none;" href="'.route('product.details', ['id' => $item->id]).'">';
                        $response .= '<img src="'.asset('book_images/'.$item->image).'" class="img-fluid product-thumbnail">';
                        $response .= '<h3 class="product-title">'.$item->name.'</h3>';
                        $response .= '<div>';
                        $response .= '<strong class="product-price">$'.$item->price.'</strong>';
                        $response .= '</div>';
                        $response .= '</a>';
                        $response .= '<a href="'.route('cart', ['id' => $item->id]).'">';
                        $response .= '<button class="btn btn-primary" style="font-size: 12px; padding: 5px 10px;">';
                        $response .= '<p style="margin: 0;">Add to Cart</p>';
                        $response .= '</button>';
                        $response .= '</a>';
                        $response .= '</div>';
                        $response .= '</div>';
                    }
                    
                    $response .= '<div class="row">';
                    $response .= '<div class="col-md-12 text-center">';
                    $response .= '<nav aria-label="Page navigation example">';
                    $response .= '<ul class="pagination justify-content-center">';
                    $response .= '<li class="page-item' . ($allitems->previousPageUrl() ? '' : ' disabled') . '">';
                    $response .= '<a class="page-link" href="' . ($allitems->previousPageUrl() ? $allitems->previousPageUrl() . '?search=' . urlencode($searchQuery) : '#') . '" tabindex="-1" aria-disabled="true">Previous</a>';
                    $response .= '</li>';

                    foreach ($allitems->getUrlRange(1, $allitems->lastPage()) as $page => $url) {
                        $response .= '<li class="page-item ' . ($page == $allitems->currentPage() ? 'active' : '') . '">';
                        $response .= '<a class="page-link" href="' . $url . '?search=' . urlencode($searchQuery) . '">' . $page . '</a>';
                        $response .= '</li>';
                    }

                    $response .= '<li class="page-item ' . ($allitems->nextPageUrl() ? '' : 'disabled') . '">';
                    $response .= '<a class="page-link" href="' . ($allitems->nextPageUrl() ? $allitems->nextPageUrl() . '?search=' . urlencode($searchQuery) : '#') . '">Next</a>';
                    $response .= '</li>';
                    $response .= '</ul>';
                    $response .= '</nav>';
                    $response .= '</div>';
                    $response .= '</div>';

                    
                    return $response;
                }
            }
            if ($request->has('search')) {
                $page = $request->input('search');
                $searchQuery = substr($page, strpos($page, 'search=') + 7);
                $perPage = 1; 
                $page_number = str_replace('?search', '', $page); 
                $page_number = substr($page_number, 0, 1);
               
                $allitems = Item::where('name', 'like', '%'.$searchQuery.'%')->paginate($perPage, ['*'], 'page', $page_number);

                $response = '';
                foreach($allitems as $item) {
                    $response .= '<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">';
                    $response .= '<div class="product-item">';
                    $response .= '<a style="text-decoration: none;" href="'.route('product.details', ['id' => $item->id]).'">';
                    $response .= '<img src="'.asset('book_images/'.$item->image).'" class="img-fluid product-thumbnail">';
                    $response .= '<h3 class="product-title">'.$item->name.'</h3>';
                    $response .= '<div>';
                    $response .= '<strong class="product-price">$'.$item->price.'</strong>';
                    $response .= '</div>';
                    $response .= '</a>';
                    $response .= '<a href="'.route('cart', ['id' => $item->id]).'">';
                    $response .= '<button class="btn btn-primary" style="font-size: 12px; padding: 5px 10px;">';
                    $response .= '<p style="margin: 0;">Add to Cart</p>';
                    $response .= '</button>';
                    $response .= '</a>';
                    $response .= '</div>';
                    $response .= '</div>';
                }
                
                $response .= '<div class="row">';
                $response .= '<div class="col-md-12 text-center">';
                $response .= '<nav aria-label="Page navigation example">';
                $response .= '<ul class="pagination justify-content-center">';
                $response .= '<li class="page-item' . ($allitems->previousPageUrl() ? '' : ' disabled') . '">';
                $response .= '<a class="page-link" href="' . ($allitems->previousPageUrl() ? $allitems->previousPageUrl() . '?search=' . urlencode($searchQuery) : '#') . '" tabindex="-1" aria-disabled="true">Previous</a>';
                $response .= '</li>';

                foreach ($allitems->getUrlRange(1, $allitems->lastPage()) as $page => $url) {
                    $response .= '<li class="page-item ' . ($page == $allitems->currentPage() ? 'active' : '') . '">';
                    $response .= '<a class="page-link" href="' . $url . '?search=' . urlencode($searchQuery) . '">' . $page . '</a>';
                    $response .= '</li>';
                }

                $response .= '<li class="page-item ' . ($allitems->nextPageUrl() ? '' : 'disabled') . '">';
                $response .= '<a class="page-link" href="' . ($allitems->nextPageUrl() ? $allitems->nextPageUrl() . '?search=' . urlencode($searchQuery) : '#') . '">Next</a>';
                $response .= '</li>';
                $response .= '</ul>';
                $response .= '</nav>';
                $response .= '</div>';
                $response .= '</div>';

                return $response;
            
            }
            
        }
        return view('clientpages.shop', ['categories' => $categories]);
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
        return view('clientpages.contact',['contact' => $data]);
    }



    public function thankyou(request $request)
    {
        $cartItems = $request->cartItems;
        return view('clientpages.thankyou',['cartItems' => $cartItems]);
    }

    public function about()
    {
        $data = About::first();
        return view('clientpages.about',['data' => $data]);
    }

    public function getCartItemCount(){
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
                $customer_name =  ucwords($user->name.' '.$user->last_name);
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
                $customer_name =  ucwords($user->name.' '.$user->last_name);

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