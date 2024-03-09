@extends('layouts.clientside-layout.app')

@section('content')
			<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-7">
							<div class="intro-excerpt">
								@if (!empty(App\Helpers\SiteviewHelper::homepage()))
								<h1>{{ App\Helpers\SiteviewHelper::homepage()->hero_heading }}</h1>
								<p class="mb-4">{!! App\Helpers\SiteviewHelper::homepage()->hero_paragraph !!}</p>
								@else
									No  Data
								@endif
								
								<p><a href="" class="btn btn-secondary me-2">Shop now</a><a href="" class="btn btn-white-outline">Explore</a></p>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="hero-img-wrap">
								@if (!empty(App\Helpers\SiteviewHelper::homepage() ))
								<img src="{{ asset('clientside/images/'.App\Helpers\SiteviewHelper::homepage()->hero_image) }}" class="img-fluid" width="90%">
								@else
									No  Image
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Hero Section -->

			   <!-- Start Product Details Section -->
			   <section class="product-details">
				<div class="container">
					<div class="row">
						<div class="col-md-5 d-flex justify-content-end">
							<img src="{{ asset('book_images/'.$product->image ) }}" alt="Product Image" class="product-image" height= "600px">
						</div>
						<div class="col-md-7">
							<h1 class="product-title">{{ $product->name }}</h1>
							<p class="product-description">
			
                            {{ $product->description }}
							</p>

							<p class="product-price text-success">Price: ${{ $product->price }}</p>
							 <div class="d-flex justify-content-center align-items-center">
                                <a href="{{ route('cart', ['id' => $product->id]) }}">
                                <button class="btn btn-primary btn-sm ml-2">
                                    ADD TO CART
                                </button>
                                </a>
                            </div>
							
						</div>
					</div>
				</div>
			</section>
@stop
