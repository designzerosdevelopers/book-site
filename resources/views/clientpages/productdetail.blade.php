@extends('layouts.clientside-layout.app')

@section('content')



    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7">
                    <div class="intro-excerpt">
                        <h1>Product</h1>
                        <p class="mb-4">This is the peragraph</p>


                        <p><a href="" class="btn btn-secondary me-2">Shop now</a><a href=""
                                class="btn btn-white-outline">Explore</a></p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero-img-wrap">
                        <img src="" class="img-fluid" width="90%">
                    </div>
                </div>
            </div>
        </div>
    </div>
   

       
    <!-- Start Product Details Section -->
    <section class="product-details">
        <div class="container">
            <div class="row">
                <div class="col-md-6 product-detail-main-img img-wrap">
                    <img src="{{asset('book_images/'.$item->image) }}" alt="Product Image" class="product-image">
                </div>

                <div class="col-md-6">
                    <h1 class="product-title">{{ $item->name }}</h1>
                    <p class="product-description">
                        {{ $item->description }}
                    </p>

                    <p class="product-price">{{ $item->price }}</p>
                    <a href="{{ route('add.product', ['id' => encrypt($item->id)]) }}">
                        <button class="add-to-cart-btn">
                            Add to Cart
                        </button>
                    </a>
                    
                    
                    
                </div>
            </div>
        </div>
    </section>


@stop
