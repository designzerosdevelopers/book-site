<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">Furni<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item {{ setActive('index') }}">
                    <a class="nav-link" href="{{ route('index') }}">Home</a>
                </li>
                <li class="nav-item {{ setActive('shop') }}">
                    <a class="nav-link" href="{{ route('shop') }}">Shop</a>
                </li>
                <li class="nav-item {{ setActive('about') }}">
                    <a class="nav-link" href="{{ route('about') }}">About us</a>
                </li>
                <li class="nav-item {{ setActive('blog') }}">
                    <a class="nav-link" href="{{ route('blog') }}">Blog</a>
                </li>
                <li class="nav-item {{ setActive('contact') }}">
                    <a class="nav-link" href="{{ route('contact') }}">Contact us</a>
                </li>
            </ul>
            
            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li><a class="nav-link" href="#"><img src="{{ asset('clientside/images/user.svg')}}"></a></li>
                <li><a class="nav-link" href="{{ route('cart') }}"><img src="{{ asset('clientside/images/cart.svg')}}"></a></li>
            </ul>
        </div>
    </div>
</nav>

@php
function setActive($routeName) {
    return request()->routeIs($routeName) ? 'active' : '';
}
@endphp
