@extends('layouts.clientside-layout.app')

@section('content')


{!! App\Helpers\SiteviewHelper::page('productdetail')->herohtml !!}
   

       
    <!-- Start Product Details Sectio -->
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

                    <p class="product-price">${{ $item->price }}</p>
                    <a href="{{ route('add.product', ['id' => encrypt($item->id)]) }}">
                        <button class="add-to-cart-btn">
                            {{App\Helpers\SiteviewHelper::style('productdetailsettings')['data']['product_button_name']}}
                        </button>
                    </a>
                    
                    
                    
                </div>
            </div>
        </div>
    </section>


@stop
