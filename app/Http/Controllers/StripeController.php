<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Item;
use App\Models\Purchase;
use App\Helpers\SiteviewHelper;
use PayPalHttp\HttpException;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use Srmklive\PayPal\Services\PayPal as PayPalClient;



class StripeController extends Controller
{


    public function createTransaction()
    {
        return view('transaction');
    }
    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */

    //  process transaction
    public function paypalcharge(Request $request)
    {

       

        $validator = Validator::make($request->all(), [
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'state_country' => 'required|string|max:255',
            'postal_zip' => 'required|string|max:255',
            'email_address' => 'required|email|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        

        if ($validator->fails()) {
            return $this->redirectBackToCheckoutWithError($validator);
        }

       
        // Access the array
        $requestData = $request->all();


        // Optionally, you can store the entire request data as well
        session(['requestData' => $requestData]);

        $clientId = SiteviewHelper::getsettings('PAYPAL_KEY');
        $clientSecret = SiteviewHelper::getsettings('PAYPAL_SECRET');

       
        if (empty($clientId) || empty($clientSecret)) {
            return redirect()->back()->with('alert', 'Something went wrong with this payment system');
        }

     
        $provider = new PayPalClient;
        $credentials = [
            'mode' => SiteviewHelper::getsettings('PAYPAL_MODE'),
            'payment_action' => 'authorize',
            'locale' => 'en_US',
            'validate_ssl' => true,
            'notify_url' => request()->getSchemeAndHttpHost() . '/paypal/ipn',
            'currency' => 'USD',
            'sandbox' => [
                'client_id' => SiteviewHelper::getsettings('PAYPAL_KEY'),
                'client_secret' => SiteviewHelper::getsettings('PAYPAL_SECRET'),
            ],
            'live' => [
                'client_id' => SiteviewHelper::getsettings('PAYPAL_KEY'),
                'client_secret' => SiteviewHelper::getsettings('PAYPAL_SECRET'),
            ]

        ];

        

        $provider->setApiCredentials($credentials);

        $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('checkout.cancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => 'usd',
                        "value" => $request->amount
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()->back()->with('alert', 'Something went wrong with this payment system');
        } else {
            return redirect()->back()->with('alert', 'Something went wrong with this payment system');
        }
    }

    protected function redirectBackToCheckoutWithError($validator): RedirectResponse
    {
        return redirect()->route('checkout')->withInput()->withErrors($validator);
    }


    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    // executes the function if transaction is sucessful
    public function successTransaction(Request $request)
    {

        $provider = new PayPalClient;
        $credentials = [
            'mode' => SiteviewHelper::getsettings('PAYPAL_MODE'),
            'payment_action' => 'authorize',
            'locale' => 'en_US',
            'validate_ssl' => true,
            'notify_url' => request()->getSchemeAndHttpHost() . '/paypal/ipn',
            'currency' => 'USD',
            'sandbox' => [
                'client_id' => SiteviewHelper::getsettings('PAYPAL_KEY'),
                'client_secret' => SiteviewHelper::getsettings('PAYPAL_SECRET'),
            ],
            'live' => [
                'client_id' => SiteviewHelper::getsettings('PAYPAL_KEY'),
                'client_secret' => SiteviewHelper::getsettings('PAYPAL_SECRET'),
            ]

        ];
        $provider->setApiCredentials($credentials);
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()->route('user');
        } else {
            return redirect()->back()->with('alert', 'Something went wrong with this payment system');
        }
    }

    public function cancelTransaction(Request $request)
    {
        return redirect()->back()->with('alert', 'You have canceled the transaction');
    }

    public function stripecharge(Request $request)
    {
        $requestData = $request->all();
        $email = $request['email_address'];
        $user = User::where('email', $email)->first();
        if ($user) {
            $existingItemIds = [];
            foreach (array_keys($requestData['amp;cartItems']) as $itemId) {
                $existingItems = Purchase::where('user_id', $user->id)
                    ->where('item_id', $itemId)
                    ->pluck('item_id')
                    ->toArray();
                if (!empty($existingItems)) {
                    foreach ($existingItems as $itemId) {
                        $bookName = Item::where('id', $itemId)->value('name');
                        if ($bookName) {
                            $existingItemIds[] = $bookName;
                        }
                    }
                }
            }
            if (!empty($existingItemIds)) {
                return redirect()->back()->withInput()->with('errorpaypal', $existingItemIds);
            }
        }


        $requestData = $request->all();
        session(['requestData' => $requestData]);

        $validator = Validator::make($request->all(), [
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'state_country' => 'required|string|max:255',
            'postal_zip' => 'required|string|max:255',
            'email_address' => 'required|email|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        try {
            // Set Stripe API key
            Stripe::setApiKey(SiteviewHelper::getsettings('STRIPE_SECRET'));

            // Create a session
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => "book",
                            ],
                            'unit_amount' => str_replace('.', '', $request->amount),
                        ],
                        'quantity' => 1,
                    ],
                ],
                'customer_email' => $request->email_address,
                'mode' => 'payment',
                'success_url' => route('user'),
                'cancel_url' => route('checkout.cancel'),
            ]);

            // If everything is successful, redirect to success URL
            return redirect($session->url);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Handle invalid API key error
            // Redirect back with an error message
            return redirect()->back()->with('alert', 'Something went wrong with this payment system');
        } catch (\Exception $e) {
            // Handle other errors
            // Redirect back with an error message
            return redirect()->back()->with('alert', 'Something went wrong with this payment system');
        }
    }


    public function cancel(Request $request)
    {
        return redirect()->back()->with('alert', 'You have canceled the transaction');
    }
}
