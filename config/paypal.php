<?php

return [
    'mode' => env('PAYPAL_MODE', 'sandbox'),
    'sandbox' => [
        'client_id' => 'AZpUqpvG8mms_t-YZiPnA6N0CR3ik8J8Wpl6eCSQIL70WtchCer8JWNIIs17u8exjG1Y1qES3twWsV7r',
        'client_secret' => 'EN3weUICqmd_XWb1oH2T_mj3tM9CtTofCVxVmefVt5UoqyXo4__q7jC7UmQgMcvrfJ63AAPvF-xHQnvP',
    ],
    'live' => [
        'client_id' => '',
        'client_secret' => '',
    ],
];