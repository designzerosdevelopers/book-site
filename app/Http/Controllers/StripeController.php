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

  
  /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
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
                return redirect()->back()->withInput()->with('errorpaypal', $existingItemIds);
            }


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

            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();
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
                return redirect()
                    ->route('createTransaction')
                    ->with('error', 'Something went wrong.');
            } else {
                return redirect()
                    ->route('createTransaction')
                    ->with('error', $response['message'] ?? 'Something went wrong.');
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
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request['token']);
            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                return redirect()->route('user');
            } else {
                return redirect()
                    ->route('createTransaction')
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
        }
        /**
         * cancel transaction.
         *
         * @return \Illuminate\Http\Response
         */
        public function cancelTransaction(Request $request)
        {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'You have canceled the transaction.');
        }
    




    public function stripecharge(Request $request)
    {
        // Access the array
        $requestData = $request->all();

        // Loop through the request data and add to session
        foreach ($requestData as $key => $value) {
            session([$key => $value]);
        }

        // Optionally, you can store the entire request data as well
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
        
        

        Stripe::setApiKey(SiteviewHelper::getsettings('STRIPE_SECRET'));

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
            'success_url' => route('user'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        return redirect()->to($session->url);
    }


    public function cancel(Request $request)
    {
        return 'Payment Cancelled.';
    }
}
