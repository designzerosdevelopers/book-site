<?php

return [
    'mode' => env('PAYPAL_MODE', 'sandbox'),
    'sandbox' => [
        'client_id' => 'AdxZA-198yt8P_cm0Rbu_ibEITPH4XN3qmGIjIgZjngwl59frswSSvuDr3rRAwYN-JedwiTW0vshFGZp',
        'client_secret' => 'EPbGm8InqJBTa0zNLFe7DdXvpEuSkqAgn9CEf6OxdGbOZpUn7GQYefbyqE6m9VFRYQ-3yV8k4JtRIg0G',
    ],
    'live' => [
        'client_id' => env('PAYPAL_LIVE_CLIENT_ID'),
        'client_secret' => env('PAYPAL_LIVE_CLIENT_SECRET'),
    ],
];