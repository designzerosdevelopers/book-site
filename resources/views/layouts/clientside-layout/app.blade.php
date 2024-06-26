<!doctype html>
<html lang="en">
@include('include.clientside.head')

<body>
    <!-- Start Header/Navigation -->
    @include('include.clientside.navbar')
    <!-- End Header/Navigation -->

<body>
    <!-- Start Header/Navigation -->
    @include('include.clientside.navbar')
    <!-- End Header/Navigation -->

    @yield('content')
    @yield('content')

    <!-- Start Footer Section -->
    @include('include.clientside.footer')
    <!-- End Footer Section -->
    <!-- Start Footer Section -->
    @include('include.clientside.footer')
    <!-- End Footer Section -->

    <script src="{{ App\Helpers\SiteviewHelper::generates3url('clientside/js-css-other/custom.js') }}"></script>

    @foreach (\App\Helpers\SiteviewHelper::customCode('Stylesheet', 'For Footer Section') as $links)
        @if ($links->file == 1)
            <link href="{{App\Helpers\SiteviewHelper::generates3url($links->link)}}" rel="stylesheet">
        @else
            <link href="{{ $links->link }}" rel="stylesheet">
        @endif
    @endforeach

    @foreach (\App\Helpers\SiteviewHelper::customCode('JavaScript', 'For Footer Section') as $links)
        @if ($links->file == 1)
            <script src="{{App\Helpers\SiteviewHelper::generates3url($links->link)}}"></script>
        @else
            <script src="{{ $links->link }}"></script>
        @endif
    @endforeach
    
</body>

</html>
