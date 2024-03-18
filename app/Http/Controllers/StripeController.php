<?php

namespace App\Http\Controllers;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class StripeController extends Controller
{
    public function charge(Request $request){
       

        $validator = Validator::make($request->all(), [
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'state_country' => 'required|string|max:255',
            'postal_zip' => 'required|string|max:255',
            'email_address' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'amount' => 'required|numeric|min:0', 
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => "book",
                        ],
                        'unit_amount' =>str_replace('.', '', $request->amount),
                    ],
                    'quantity' => 1,
                ],
            ],
            'customer_email' => $request->email_address,
            'mode' => 'payment',
            'success_url' => $this->paymentsuccess($request),
            'cancel_url' => route('checkout.cancel'),
        ]);

        return redirect()->to($session->url);
    }


    public function paymentsuccess(Request $request)
    {
       
        $successMessage = "Your payment was successful";
    
        // Set flash message
        session()->flash('success_message', $successMessage);
    
        // Remove cart cookie
        if (isset($_COOKIE['cart'])) {
            unset($_COOKIE['cart']);
            setcookie('cart', '', time() - 3600, '/'); // expire the cart cookie
        }

        // Access the array
        $requestData = $request->all();

        // Store data in session
        session(['requestData' => $requestData]);

        // Redirect to the 'user' route
        return route('user');
        }



   
    

    public function cancel(Request $request)
    {
        return 'Payment Cancelled.';
    }
}
