<?php

namespace App\Http\Controllers;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StripeController extends Controller
{
    public function charge(Request $request){
        $cartItems  = $request->cartItems;

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
            'success_url' => $this->paymentsuccess($cartItems),
            'cancel_url' => route('checkout.cancel'),
        ]);

        return redirect()->to($session->url);
    }


    public function paymentsuccess($cartItems)
{
    $successMessage = "Your payment was successful";

    // Set flash message
    session()->flash('success_message', $successMessage);

    // Remove cart cookie
    if (isset($_COOKIE['cart'])) {
        unset($_COOKIE['cart']);
        setcookie('cart', '', time() - 3600, '/'); // expire the cart cookie
    }

    // Redirect to the 'thankyou' route with parameters
    return route('thankyou', ['cartItems' => $cartItems]);
}

    public function cancel(Request $request)
    {
        return 'Payment Cancelled.';
    }
}
