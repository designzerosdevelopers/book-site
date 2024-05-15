@extends('layouts.clientside-layout.app')

@section('content')

{!! $product  !!}

@stop

{{-- 
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
    <!-- End Hero Section -->
    <style>
        .product-details {
            padding: 50px 0;
            margin-top: 100px;
            margin-bottom: 200px;
        }

        .product-image {
            max-width: 100%;
            height: auto;
        }

        .product-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .product-description {
            margin-bottom: 30px;
        }

        .product-price {
            font-size: 18px;
            font-weight: bold;
            color: #ff6347;
            /* Adjust color as needed */
            margin-bottom: 20px;
        }

        .add-to-cart-btn {
            background-color: #14A44D;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .product-detail-main-img img {
            height: 600px;
        }

        .product-detail-main-img {
            text-align: center;
        }

        .img-wrap img:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease-in-out;
        }
    </style>
    <!-- Start Product Details Section -->
    <section class="product-details">
        <div class="container">
            <div class="row">
                <div class="col-md-6 product-detail-main-img img-wrap">
                    <img src="clientside/book_images/alchiment.jpg" alt="Product Image" class="product-image">
                </div>
                <div class="col-md-6">
                    <h1 class="product-title">Art of war</h1>
                    <p class="product-description">
						This is wrote a war commander of china around 500bc.
                    </p>

                    <p class="product-price">$100.00</p>
                    <a href="">
                        <button class="add-to-cart-btn">
                            Add to Cart
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section> --}}