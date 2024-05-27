<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\About;
use App\Models\Contact;
use App\Models\Settings;
use App\Models\Categories;
use App\Models\Component;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Models\Purchase;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExampleMail;
use App\Mail\PostPurchaseMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;


class SiteViewController extends Controller
{

    public function productDetail($product)
    {
        $item = Item::where('slug', $product)->first();

        return view('clientpages.productdetail', ['item' => $item]);
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


    public function addCart($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $cart = json_decode(request()->cookie('cart'), true) ?? [];

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

        $response = Redirect::route('cart')
            ->withCookie(cookie('cart', json_encode($cart), 60));

        return $response;
    }


    public function removeFromCart($itemId)
    {
        $cartItems = json_decode(request()->cookie('cart'), true) ?? [];

        unset($cartItems[$itemId]);

        $cookie = cookie('cart', json_encode($cartItems), 60 * 24 * 30);

        return redirect()->route('cart')->withCookie($cookie);
    }


    public function checkout(request $request)
    {
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

        // return view('clientpages.checkout');
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
                $customer_name = ucwords($user->name . ' ' . $user->last_name);
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
                    'country' => $data['state_country'],
                    'zip' => $data['postal_zip'],
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
                $customer_name = ucwords($user->name . ' ' . $user->last_name);

                // Remove all data from the session
                Session::flush();

                try {
                    Mail::to($email)->send(new ExampleMail($customer_name, $randomPassword, $email, ));

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

    public function shop(Request $request)
    {
        $categories = Categories::whereHas('items')->pluck('category_name')->toArray();
        array_unshift($categories, 'All');

        return view('clientpages.shop', ['categories' => $categories]);

    }


    public function books(Request $request)
    {
        $component = Component::find(4);
        $data = $component->data;
        $dataArray = json_decode($data, true); 
        $perpage = $dataArray['display_product'];
       

        $category = '';
        if ($request->input('all')) {
            $category == 'All';
            $allItems = Item::paginate($perpage);
            $response = '';
            foreach ($allItems as $item) {
                $response .= '<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">';
                $response .= '<div class="product-item">';
                $response .= '<a style="text-decoration: none;" href="' . $item->slug . '">';
                $response .= '<img src="' . asset('book_images/' . $item->image) . '" class="img-fluid product-thumbnail">';
                $response .= '<h3 class="product-title">' . e($item->name) . '</h3>';
                $response .= '<div>';
                $response .= '<strong class="product-price">$' . number_format($item->price, 2) . '</strong>';
                $response .= '</div>';
                $response .= '</a>';
                $response .= '<a href="' . route('add.product', ['id' => encrypt($item->id)]) . '">';
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

            $category = 'All';
            if ($allItems->onFirstPage()) {
                $response .= '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a></li>';
            } else {
                $previousUrl = $allItems->previousPageUrl() . '&category=' . urlencode($category);
                $response .= '<li class="page-item"><a class="page-link" href="' . $previousUrl . '" tabindex="-1" aria-disabled="true">Previous</a></li>';
            }

            foreach ($allItems->getUrlRange(1, $allItems->lastPage()) as $pageNumber => $url) {
                $url = $url . '&category=' . urlencode($category);
                $response .= '<li class="page-item ' . ($pageNumber == $allItems->currentPage() ? 'active' : '') . '">';
                $response .= '<a class="page-link" href="' . $url . '">' . $pageNumber . '</a>';
                $response .= '</li>';
            }

            if ($allItems->hasMorePages()) {
                $nextUrl = $allItems->nextPageUrl() . '&category=' . urlencode($category);
                $response .= '<li class="page-item"><a class="page-link" href="' . $nextUrl . '">Next</a></li>';
            } else {
                $response .= '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
            }

            $response .= '</ul>';
            $response .= '</nav>';
            $response .= '</div>';
            $response .= '</div>';

            return $response;
        }


        if ($request->ajax()) {
            if ($request->has('category')) {
                $category = $request->input('category');
                if ($category == 'All') {
                    $allItems = Item::paginate($perpage);
                } else {
                    $categoryId = Categories::where('category_name', $category)->pluck('id')->first();
                    $allItems = Item::where('category', $categoryId)->paginate($perpage);
                }


                $response = '';
                foreach ($allItems as $item) {
                    $response .= '<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">';
                    $response .= '<div class="product-item">';
                    $response .= '<a style="text-decoration: none;" href="' . $item->slug . '">';
                    $response .= '<img src="' . asset('book_images/' . $item->image) . '" class="img-fluid product-thumbnail">';
                    $response .= '<h3 class="product-title">' . e($item->name) . '</h3>';
                    $response .= '<div>';
                    $response .= '<strong class="product-price">$' . number_format($item->price, 2) . '</strong>';
                    $response .= '</div>';
                    $response .= '</a>';
                    $response .= '<a href="' . route('add.product', ['id' => encrypt($item->id)]) . '">';
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

                if ($allItems->onFirstPage()) {
                    $response .= '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a></li>';
                } else {
                    $previousUrl = $allItems->previousPageUrl() . '&category=' . urlencode($category);
                    $response .= '<li class="page-item"><a class="page-link" href="' . $previousUrl . '" tabindex="-1" aria-disabled="true">Previous</a></li>';
                }

                foreach ($allItems->getUrlRange(1, $allItems->lastPage()) as $pageNumber => $url) {
                    $url = $url . '&category=' . urlencode($category);
                    $response .= '<li class="page-item ' . ($pageNumber == $allItems->currentPage() ? 'active' : '') . '">';
                    $response .= '<a class="page-link" href="' . $url . '">' . $pageNumber . '</a>';
                    $response .= '</li>';
                }

                if ($allItems->hasMorePages()) {
                    $nextUrl = $allItems->nextPageUrl() . '&category=' . urlencode($category);
                    $response .= '<li class="page-item"><a class="page-link" href="' . $nextUrl . '">Next</a></li>';
                } else {
                    $response .= '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
                }

                $response .= '</ul>';
                $response .= '</nav>';
                $response .= '</div>';
                $response .= '</div>';

                return $response;

            }
        }




        // if ($request->ajax()) {
        //     if ($request->ajax()) {
        //         if ($request->has('page')) {
        //             return 'reached';
        //             $page = $request->query('page'); // Extract the page number
        //             $category = $request->query('category'); // Extract the category
        //             return $category;

        //             $allItems = Item::paginate(1, ['*'], 'page', $page);
        //             $response = '';

        //             foreach ($allItems as $item) {
        //                 $response .= '<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">';
        //                 $response .= '<div class="product-item">';
        //                 $response .= '<a style="text-decoration: none;" href="#">';
        //                 $response .= '<img src="' . asset('book_images/' . $item->image) . '" class="img-fluid product-thumbnail">';
        //                 $response .= '<h3 class="product-title">' . e($item->name) . '</h3>';
        //                 $response .= '<div>';
        //                 $response .= '<strong class="product-price">$' . number_format($item->price, 2) . '</strong>';
        //                 $response .= '</div>';
        //                 $response .= '</a>';
        //                 $response .= '<a href="' . route('cart', ['id' => $item->id]) . '">';
        //                 $response .= '<button class="btn btn-primary" style="font-size: 12px; padding: 5px 10px;">';
        //                 $response .= '<p style="margin: 0;">Add to Cart</p>';
        //                 $response .= '</button>';
        //                 $response .= '</a>';
        //                 $response .= '</div>';
        //                 $response .= '</div>';
        //             }

        //             $response .= '<div class="row">';
        //             $response .= '<div class="col-md-12 text-center">';
        //             $response .= '<nav aria-label="Page navigation example">';
        //             $response .= '<ul class="pagination justify-content-center">';

        //             if ($allItems->onFirstPage()) {
        //                 $response .= '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a></li>';
        //             } else {
        //                 $response .= '<li class="page-item"><a class="page-link" href="' . $allItems->previousPageUrl() . '" tabindex="-1" aria-disabled="true">Previous</a></li>';
        //             }

        //             foreach ($allItems->getUrlRange(1, $allItems->lastPage()) as $pageNumber => $url) {
        //                 $response .= '<li class="page-item ' . ($pageNumber == $allItems->currentPage() ? 'active' : '') . '">';
        //                 $response .= '<a class="page-link" href="' . $url . '">' . $pageNumber . '</a>';
        //                 $response .= '</li>';
        //             }

        //             if ($allItems->hasMorePages()) {
        //                 $response .= '<li class="page-item"><a class="page-link" href="' . $allItems->nextPageUrl() . '">Next</a></li>';
        //             } else {
        //                 $response .= '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
        //             }

        //             $response .= '</ul>';
        //             $response .= '</nav>';
        //             $response .= '</div>';
        //             $response .= '</div>';

        //             return $response;
        //         }
        //     }


        //     if ($request->has('all')) {
        //         return 'all';
        //         $allItems = Item::paginate(1);
        //         $response = '';

        //         foreach ($allItems as $item) {
        //             $response .= '<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">';
        //             $response .= '<div class="product-item">';
        //             $response .= '<a style="text-decoration: none;" href="">';
        //             $response .= '<img src="' . asset('book_images/' . $item->image) . '" class="img-fluid product-thumbnail">';
        //             $response .= '<h3 class="product-title">' . $item->name . '</h3>';
        //             $response .= '<div>';
        //             $response .= '<strong class="product-price">$' . $item->price . '</strong>';
        //             $response .= '</div>';
        //             $response .= '</a>';
        //             $response .= '<a href="' . route('cart', ['id' => $item->id]) . '">';
        //             $response .= '<button class="btn btn-primary" style="font-size: 12px; padding: 5px 10px;">';
        //             $response .= '<p style="margin: 0;">Add to Cart</p>';
        //             $response .= '</button>';
        //             $response .= '</a>';
        //             $response .= '</div>';
        //             $response .= '</div>';
        //         }

        //         $response .= '<div class="row">';
        //         $response .= '<div class="col-md-12 text-center">';
        //         $response .= '<nav aria-label="Page navigation example">';
        //         $response .= '<ul class="pagination justify-content-center">';
        //         $response .= '<li class="page-item ' . ($allItems->previousPageUrl() ? '' : 'disabled') . '">';
        //         $response .= '<a class="page-link" href="' . $allItems->previousPageUrl() . '" tabindex="-1" aria-disabled="true">Previous</a>';
        //         $response .= '</li>';

        //         foreach ($allItems->getUrlRange(1, $allItems->lastPage()) as $page => $url) {
        //             $response .= '<li class="page-item ' . ($page == $allItems->currentPage() ? 'active' : '') . '">';
        //             $response .= '<a class="page-link" href="' . $url . '">' . $page . '</a>';
        //             $response .= '</li>';
        //         }

        //         $response .= '<li class="page-item ' . ($allItems->nextPageUrl() ? '' : 'disabled') . '">';
        //         $response .= '<a class="page-link" href="' . $allItems->nextPageUrl() . '">Next</a>';
        //         $response .= '</li>';
        //         $response .= '</ul>';
        //         $response .= '</nav>';
        //         $response .= '</div>';
        //         $response .= '</div>';

        //         return $response;
        //     }
        // }



    }

}
