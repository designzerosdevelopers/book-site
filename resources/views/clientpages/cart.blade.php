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
                          <th class="product-quantity">Quantity</th>
                          <th class="product-total">Total</th>
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
                            <td id="price">${{ $item['item_price'] }}</td>
                            <td>
                                <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-black decrease" type="button" onclick="decreaseValue()">&minus;</button>
                                    </div>
                                    <input type="text" class="form-control text-center quantity-amount" value="{{ $item['item_quantity'] }}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" id="quantity" onchange="updateTotal()">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-black increase" type="button" onclick="increaseValue()">&plus;</button>
                                    </div>
                                </div>
                            </td>
                            <td id="totalprice">${{ $item['item_price'] * $item['item_quantity'] }}</td>
                            <td><a href="#" class="btn btn-black btn-sm">X</a></td>
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
                      <button class="btn btn-outline-black btn-sm btn-block">Continue Shopping</button>
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
                          <strong class="text-black" id="total"></strong>
                        </div>
                      </div>
        
                      <div class="row">
                        <div class="col-md-12">
                          <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='{{ route('checkout') }}'">Proceed To Checkout</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> 
@stop




