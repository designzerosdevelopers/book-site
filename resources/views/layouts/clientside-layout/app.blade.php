<!doctype html>
<html lang="en">
@include('include.clientside.head')

<body>
    <!-- Start Header/Navigation -->
    @include('include.clientside.navbar')
    <!-- End Header/Navigation -->

    @yield('content')

    <!-- Start Footer Section -->
    @include('include.clientside.footer')
    <!-- End Footer Section -->

    <script src="{{ asset('clientside/js-css-other/custom.js') }}"></script>

    @foreach (\App\Helpers\SiteviewHelper::customCode('Stylesheet', 'For Footer Section') as $links)
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
    
</body>

</html>
