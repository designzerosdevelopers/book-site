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
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <img src="{{ asset('book_images/' . $item['item_image']) }}" alt="Image" class="img-fluid" width="30%">
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black">{{ $item['item_name'] }}</h2>
                                        </td>
                                        <td id="price{{ $loop->index }}">${{ $item['item_price'] }}</td>
                                        <td>
                                            <a href="{{ route('remove_from_cart', ['itemId' => $item['item_id']]) }}" class="btn btn-black btn-sm">X</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <button class="btn btn-black btn-sm btn-block">Update Cart</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('shop') }}" class="btn btn-outline-black btn-sm btn-block">Continue Shopping</a>
                        </div>
                    </div>
                    <div class="row">
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
                                    <strong class="text-black" id="subtotal"></strong>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black" id="totalprice"></strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <form id="checkoutForm" method="POST" action="{{ route('checkout') }}">
                                        @csrf <!-- CSRF protection -->
                                        <input type="hidden" name="subtotal" id="subtotal1">
                                        <button type="submit" class="btn btn-black btn-lg py-3 btn-block">Proceed To Checkout</button>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

<<script>
    window.onload = function() {
        var totalPrice = 0;
        // Start a for loop
        for (var i = 0; i < {{ count($cartItems) }}; i++) {
            var priceText = document.getElementById("price" + i).innerText;
            var price = parseFloat(priceText.replace('$', ''));
            totalPrice += price;
        }

        // Set subtotal value for an input field with id "subtotal1"
        document.getElementById("subtotal1").value = totalPrice.toFixed(2);
        // Set subtotal value for an element with id "subtotal"
        document.getElementById("subtotal").innerText = "$" + totalPrice.toFixed(2);
        // Assuming there's an element with id "totalprice" for showing total price
        document.getElementById("totalprice").innerText = "$" + totalPrice.toFixed(2);
    }
</script>

