@extends('layouts.clientside-layout.app')

@section('content')
			   <!-- Start Product Details Section -->
			   <section class="product-details">
				<div class="container">
					<div class="row">
						<div class="col-md-6 product-detail-main-img img-wrap">
							<img src="{{ asset('book_images/'.$product->image ) }}" alt="Product Image" class="product-image">
						</div>
						<div class="col-md-6">
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
