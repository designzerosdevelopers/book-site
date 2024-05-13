@extends('layouts.clientside-layout.app')
@section('content')


		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Shop</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<div class="untree_co-section product-section before-footer-section">
		    <div class="container">
		      	<div class="row">

					@foreach($allitems as $item)
					<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
						<div class="product-item">
							<a  style="text-decoration: none;" href="{{ route('product.details', ['id' => $item->id]) }}">
							<img src="{{ asset($item->image)}}" class="img-fluid product-thumbnail">
							<h3 class="product-title">{{$item->name}}</h3>
							<div>
							<strong class="product-price">${{$item->price}}</strong>
							</div>
							</a>
							<a href="{{ route('cart', ['id' => $item->id]) }}">
							<button class="btn btn-primary" style="font-size: 12px; padding: 5px 10px;">
								<p style="margin: 0;">Add to Cart</p>
							</button>
						</a>
						</div>
					</div> 
					@endforeach
					<!-- End Column 1 -->
		      	</div>
		    </div>
		</div>

@stop
