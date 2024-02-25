@extends('layouts.clientside-layout.app')

@section('content')

		<!-- bStart Hero Section  -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Checkout</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->
		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	
		<div class="untree_co-section">
		    <div class="container">
					{{-- <div class="row mb-5">
						<div class="col-md-12">
						<div class="border p-4 rounded" role="alert">
							Returning customer? <a href="#">Click here</a> to login
						</div>
						</div>
					</div> --}}
					<form method="post" action="{{route('charge',['cartItems' => $cartItems ])}}">
						@csrf
		      <div class="row">
		        <div class="col-md-6 mb-5 mb-md-0">
		          <h2 class="h3 mb-3 text-black">Billing Details</h2>
		          <div class="p-3 p-lg-5 border bg-white">
		            <div class="form-group row">
		              <div class="col-md-6">
		                <label for="fname" class="text-black">First Name <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="fname" name="f_name" required>
		              </div>
		              <div class="col-md-6">
		                <label for="lname" class="text-black">Last Name <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="lname" name="l_name" required>
		              </div>
		            </div>

		            <div class="form-group row">
		              <div class="col-md-12">
		                <label for="address" class="text-black">Address <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="address" name="address1" placeholder="Street address" required>
		              </div>
		            </div>

		            <div class="form-group mt-3">
		              <input type="text" class="form-control" name="address2" placeholder="Apartment, suite, unit etc. (optional)">
		            </div>

		            <div class="form-group row">
		              <div class="col-md-6">
		                <label for="state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="state_country" name="state_country" required>
		              </div>
		              <div class="col-md-6">
		                <label for="postal_zip" class="text-black">Postal / Zip <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="postal_zip" name="postal_zip" required>
		              </div>
		            </div>

		            <div class="form-group row mb-5">
		              <div class="col-md-6">
		                <label for="email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="email_address" name="email_address" required>
		              </div>
		              <div class="col-md-6">
		                <label for="phone" class="text-black">Phone</label>
		                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
		              </div>
		            </div>

		            {{-- <div class="form-group">
		               <label for="c_create_account" class="text-black" data-bs-toggle="collapse" href="#create_an_account" role="button" aria-expanded="false" aria-controls="create_an_account"><input type="checkbox" value="1" id="c_create_account"> Create an account?</label> 
		              <div class="collapse" id="create_an_account">
		                <div class="py-2 mb-4">
		                  <p class="mb-3">Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
		                  <div class="form-group">
		                    <label for="c_account_password" class="text-black">Account Password</label>
		                    <input type="email" class="form-control" id="c_account_password" name="c_account_password" placeholder="">
		                  </div>
		                </div>
		              </div>
		            </div> --}}

		            {{-- <div class="form-group">
		              <label for="c_ship_different_address" class="text-black" data-bs-toggle="collapse" href="#ship_different_address" role="button" aria-expanded="false" aria-controls="ship_different_address"><input type="checkbox" value="1" id="c_ship_different_address"> Ship To A Different Address?</label>
		              <div class="collapse" id="ship_different_address">
		                <div class="py-2">

		                   <div class="form-group">
		                    <label for="c_diff_country" class="text-black">Country <span class="text-danger">*</span></label>
		                    <select id="c_diff_country" class="form-control">
		                      <option value="1">Select a country</option>    
		                      <option value="2">bangladesh</option>    
		                      <option value="3">Algeria</option>    
		                      <option value="4">Afghanistan</option>    
		                      <option value="5">Ghana</option>    
		                      <option value="6">Albania</option>    
		                      <option value="7">Bahrain</option>    
		                      <option value="8">Colombia</option>    
		                      <option value="9">Dominican Republic</option>    
		                    </select>
		                  </div> 


		                  <div class="form-group row">
		                    <div class="col-md-6">
		                      <label for="f_name" class="text-black">First Name <span class="text-danger">*</span></label>
		                      <input type="text" class="form-control" id="f_name" name="f_name" required>
		                    </div>
		                    <div class="col-md-6">
		                      <label for="l_name" class="text-black">Last Name <span class="text-danger">*</span></label>
		                      <input type="text" class="form-control" id="l_name" name="l_name" required>
		                    </div>
		                  </div>

		                  <div class="form-group row  mb-3">
		                    <div class="col-md-12">
		                      <label for="c_diff_address" class="text-black">Address <span class="text-danger">*</span></label>
		                      <input type="text" class="form-control" id="c_diff_address" name="address1" placeholder="Street address" required>
		                    </div>
		                  </div>

		                  <div class="form-group">
		                    <input type="text" class="form-control" name="address2" placeholder="Apartment, suite, unit etc. (optional)">
		                  </div>

		                  <div class="form-group row">
		                    <div class="col-md-6">
		                      <label for="state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
		                      <input type="text" class="form-control" id="state_country" name="state_country" required>
		                    </div>
		                    <div class="col-md-6">
		                      <label for="postal_zip" class="text-black">Postal / Zip <span class="text-danger">*</span></label>
		                      <input type="text" class="form-control" id="postal_zip" name="postal_zip" required>
		                    </div>
		                  </div>

		                  <div class="form-group row mb-5">
		                    <div class="col-md-6">
		                      <label for="email" class="text-black">Email Address <span class="text-danger">*</span></label>
		                      <input type="text" class="form-control" id="email" name="email" required>
		                    </div>
		                    <div class="col-md-6">
		                      <label for="phone" class="text-black">Phone</label>
		                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
		                    </div>
		                  </div>

		                </div>

		              </div>
		            </div> --}}

		            {{-- <div class="form-group">
		              <label for="c_order_notes" class="text-black">Order Notes</label>
		              <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
		            </div> --}}

		          </div>
		        </div>
		        <div class="col-md-6">

		          <div class="row mb-5">
		            <div class="col-md-12">
		              <h2 class="h3 mb-3 text-black">Coupon Code</h2>
		              <div class="p-3 p-lg-5 border bg-white">

		                <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
		                <div class="input-group w-75 couponcode-wrap">
		                  <input type="text" class="form-control me-2" id="c_code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2">
		                  <div class="input-group-append">
		                    <button class="btn btn-black btn-sm" type="button" id="button-addon2">Apply</button>
		                  </div>
		                </div>

		              </div>
		            </div>
		          </div>

		          <div class="row mb-5">
		            <div class="col-md-12">
		              <h2 class="h3 mb-3 text-black">Your Order</h2>
		              <div class="p-3 p-lg-5 border bg-white">
		                <table class="table site-block-order-table mb-5">
		                  <thead>
		                    <th>Product</th>
		                    <th>Total</th>
		                  </thead>
		                  <tbody>
							@foreach($cartItems as $item)
								<tr>
									<td>{{ $item['item_name'] }} <strong class="mx-2"></strong> </td>
									<td>${{ number_format($item['item_price'], 2) }}</td>
								</tr>
							@endforeach
							<tr>
								<td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
								<td class="text-black">${{ $subtotal }}</td>
							</tr>
							<tr>
								<td class="text-black font-weight-bold"><strong>Order Total</strong></td>
								<td class="text-black font-weight-bold"><strong>${{ $subtotal }}</strong></td>
								<input type="hidden" name="amount" value="{{ $subtotal }}">
							</tr>
						</tbody>
						
		                </table>

		                {{-- <div class="border p-3 mb-3">
		                  <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Credit Card</a></h3>
		                  <div class="collapse" id="collapsebank">
		                    <form class="py-2">
								<div class="form-group row">
									<div class="col-md-12">
									  <label for="card_number" class="text-black">Card Number<span class="text-danger">*</span></label>
									  <input type="text" class="form-control" id="card_number" name="card_number">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
									  <label for="expiretion_date" class="text-black">Expire Date <span class="text-danger">*</span></label>
									  <input type="text" class="form-control" id="expiretion_date" name="f_name">
									</div>
									<div class="col-md-6">
									  <label for="cvv" class="text-black">CVV <span class="text-danger">*</span></label>
									  <input type="text" class="form-control" id="cvv" name="cvv">
									</div>
								</div>
		                    </form>
		                  </div>
		                </div> --}}

		                <div class="form-group">
		                  <input  type="submit" class="btn btn-black btn-lg py-3 btn-block" value="Pay Now">
		                </div>

		              </div>
		            </div>
		          </div>

		        </div>
		      </div>
			</form>
		      <!-- </form> -->
		    </div>
		  </div>
@stop
