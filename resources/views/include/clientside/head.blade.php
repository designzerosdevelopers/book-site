<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="{{ asset('clientside/images/favicon.png') }}">
    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS -->
   
    {{-- <link href="{{asset('clientside/css/product-detail.css')}}" rel="stylesheet"> --}}
    <link href="{{asset('clientside/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('clientside/css/tiny-slider.css') }}" rel="stylesheet">
    {{-- <link href="{{asset('clientside/css/style.css')}}" rel="stylesheet"> --}}

    <title>Digital store</title>
    <style>
        {!! App\Helpers\SiteviewHelper::page('site')->css !!} .cart-item {
            position: relative;
        }

        .cart-item .cart-count-container {
            position: absolute;
            top: 0px;
            right: 0px;
            background-color: #ff6347;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cart-item .cart-count {
            color: white;
            font-size: 14px;
        }
    </style>

</head>
