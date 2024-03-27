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
	
	
		<div class="untree_co-section">
		    <div class="container">
					<form id="paymentForm"  method="post" action="">
						@csrf
		      <div class="row">
		        <div class="col-md-6 mb-5 mb-md-0">
		          <h2 class="h3 mb-3 text-black">Billing Details</h2>
		          <div class="p-3 p-lg-5 border bg-white">
		            <div class="form-group row">
						<div class="col-md-6">
							<label for="fname" class="text-black">First Name <span class="text-danger">*</span></label>
							<input type="text" class="form-control @error('f_name') is-invalid @enderror" id="fname" name="f_name" required>
							@error('f_name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						
						<div class="col-md-6">
							<label for="lname" class="text-black">Last Name <span class="text-danger">*</span></label>
							<input type="text" class="form-control @error('l_name') is-invalid @enderror" id="lname" name="l_name" required>
							@error('l_name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						
						<!-- Repeat this pattern for other fields -->
						<div class="form-group row">
							<div class="col-md-12">
								<label for="address" class="text-black">Address <span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('address1') is-invalid @enderror" id="address" name="address1" placeholder="Street address" required>
								@error('address1')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						
						<!-- Address 2 -->
						<div class="form-group mt-3">
							<input type="text" class="form-control" name="address2" placeholder="Apartment, suite, unit etc. (optional)">
						</div>
						
						<!-- State / Country -->
						<div class="form-group row">
							<div class="col-md-6">
								<label for="state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('state_country') is-invalid @enderror" id="state_country" name="state_country" required>
								@error('state_country')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						
							<!-- Postal / Zip -->
							<div class="col-md-6">
								<label for="postal_zip" class="text-black">Postal / Zip <span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('postal_zip') is-invalid @enderror" id="postal_zip" name="postal_zip" required>
								@error('postal_zip')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						
						<!-- Email Address -->
						<div class="form-group row mb-5">
							<div class="col-md-6">
								<label for="email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('email_address') is-invalid @enderror" id="email_address" name="email_address" required>
								@error('email_address')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						
						
		              <div class="col-md-6">
		                <label for="phone" class="text-black">Phone</label>
		                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number (optional)">
		              </div>
						</div>
		            </div>
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
		                    <th>Price</th>
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
								<td class="text-black">${{ $subtotal}}.00</td>
							</tr>
							<tr>
								<td class="text-black font-weight-bold"><strong>Order Total</strong></td>
								<td class="text-black font-weight-bold"><strong>${{ $subtotal }}.00</strong></td>
								<input type="hidden" name="amount" value="{{ $subtotal }}.00">
							</tr>
						</tbody>
		                </table>
		                <div class="form-group">
		                  <!-- Stripe Payment Button -->
							<input type="submit" id="stripeButton" class="btn btn-black btn-lg py-3 btn-block" value="Pay with Stripe">
							
							<!-- Paypal Payment Button -->
							<input type="submit" id="paypalButton" class="btn btn-black btn-lg py-3 btn-block" value="Pay with Paypal">
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#stripeButton').click(function() {
      if ($('#paymentForm')[0].checkValidity()) { // Check form validity before submission
        $('#paymentForm').attr('action', '{{ route("stripecharge", ["cartItems" => $cartItems ]) }}');
        $('#paymentForm').submit();
      } else {
        // Let HTML5 form validation handle the error message
        $('#paymentForm')[0].reportValidity();
      }
    });

    $('#paypalButton').click(function() {
      if ($('#paymentForm')[0].checkValidity()) { // Check form validity before submission
        $('#paymentForm').attr('action', '{{ route("paypalcharge", ["cartItems" => $cartItems ]) }}');
        $('#paymentForm').submit();
      } else {
        // Let HTML5 form validation handle the error message
        $('#paymentForm')[0].reportValidity();
      }
    });
  });
</script>