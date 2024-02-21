<?php

namespace App\Http\Controllers;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
                            'name' => $request->product_name,
                        ],
                        'unit_amount' => intval($request->amount . '00'),
                    ],
                    'quantity' => 1,
                ],
            ],
            'customer_email' => $request->email_address,
            'mode' => 'payment',
            'success_url' => route('thankyou'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        return redirect()->to($session->url);
    }


    public function cancel(Request $request)
    {
        return 'Payment Cancelled.';
    }
}
