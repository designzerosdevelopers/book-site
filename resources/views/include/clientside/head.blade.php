<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="{{ asset('clientside/images/favicon.png') }}">
    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />


    <!-- Bootstrap CSS -->
    @foreach (\App\Helpers\SiteviewHelper::customCode('Stylesheet', 'For Head Section') as $links)
        @if ($links->file == 1)
            <link href="{{ asset($links->link) }}" rel="stylesheet">
        @else
            <link href="{{ $links->link }}" rel="stylesheet">
        @endif
    @endforeach

    @foreach (\App\Helpers\SiteviewHelper::customCode('JavaScript', 'For Footer Section') as $links)
    @if ($links->file == 1)
    <script src="{{ asset($links->link) }}"></script>
    @else
    <script src="{{ $links->link }}"></script>
    @endif
    @endforeach

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
