@extends('layouts.clientside-layout.app')

@section('content')
<div class="container my-5 py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-center align-items-center">{{ $product->name }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('book_images/'.$product->image ) }}" alt="Product Image" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <p>{{ $product->description }}</p>
                            <div class="d-flex justify-content-center align-items-center">
                                <h2>${{ $product->price }}</h2>
                            </div>
                        
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
            </div>
            
        </div>
    </div>
</div>
@stop
