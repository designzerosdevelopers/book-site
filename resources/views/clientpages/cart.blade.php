{{-- @extends('layouts.clientside-layout.app')
@section('content')
{{ App\Helpers\SiteViewHelper::getCart() }}


@stop --}}







@extends('layouts.clientside-layout.app')

@section('content')

    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Cart</h1>
                    </div>
                </div>
                <div class="col-lg-7">
                    <!-- You can add content here if needed -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
                <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                        @if (count(App\Helpers\SiteViewHelper::getCart()) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Image</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalprice = 0;

                                    @endphp

                                    @foreach (App\Helpers\SiteViewHelper::getCart() as $item)
                                        @php
                                            $totalprice += (float) $item['item_price'];
                                        @endphp

                                        <tr>
                                            <td class="product-thumbnail">
                                                <img src="{{ asset('book_images/' . $item['item_image']) }}" alt="Image"
                                                    class="img-fluid" width="25%">
                                            </td>
                                            <td class="product-name">
                                                <h2 class="h5 text-black">{{ $item['item_name'] }}</h2>
                                            </td>
                                            <td id="price{{ $loop->index }}">${{ $item['item_price'] }}</td>
                                            <td>
                                                <a href="{{ route('remove.from.cart', ['id' => $item['item_id']]) }}"
                                                    class="btn btn-black btn-sm">X</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="empty-cart-message text-center mt-2">
                                <p class="empty-cart-text display-6">Your cart is empty.</p>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <a href="{{ route('shop') }}" class="btn btn-outline-black btn-sm btn-block">Continue
                                Shopping</a>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="text-black h4" for="coupon">Coupon</label>
                            <p>Enter your coupon code if you have one.</p>
                        </div>
                        <div class="col-md-8 mb-3 mb-md-0">
                            <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-black">Apply Coupon</button>
                        </div>
                    </div>
                </div>
                @if (count(App\Helpers\SiteViewHelper::getCart()) > 0)
                    <div class="col-md-6 pl-5">
                        <div class="row justify-content-end">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12 text-right border-bottom mb-5">
                                        <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <span class="text-black">Subtotal</span>
                                    </div>
                                    <div class="col-md-6 text-right">

                                        <strong class="text-black"
                                            id="subtotal">${{ number_format($totalprice, 2) }}</strong>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <span class="text-black">Total</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black"
                                            id="totalprice">${{ number_format($totalprice, 2) }}</strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="checkoutForm" method="get" action="{{ route('checkout') }}">
                                            <button type="submit" class="btn btn-black btn-lg py-3 btn-block">Proceed To
                                                Checkout</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
