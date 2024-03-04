@if(session()->has('success_message'))

@extends('layouts.clientside-layout.app')

@section('content')

<!-- Start Hero Section -->
<!-- Add the 'text-center' class to the parent div of the content you want to center -->
<div class="untree_co-section text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span class="display-3 thankyou-icon text-primary">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-check mb-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M11.354 5.646a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                        <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                    </svg>
                </span>
                <h2 class="display-3 text-black">Thank you!</h2>
                <p class="lead mb-5">Thank you for purchasing from BookStore</p>
                <p class="lead mb-3" style="color: red;">Do not refresh the page without downloading your purchase, otherwise you will lose your books, and payment is not refundable.</p>
            </div>
        </div>
        <div class="row justify-content-center"> <!-- Add 'justify-content-center' class to center-align the row -->
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Image</th>
                            <th scope="col">Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through your products and display each one -->
                        @foreach($cartItems as $product)
                            <tr>
                                <td style="font-weight: bold; font-size: 16px;">{{ $product['item_name'] }}</td>
                                <td>
                                    <img src="{{ asset('book_images/'.$product['item_image']) }}" alt="{{ $product['item_name'] }}" class="img-thumbnail" style="width: 40px;">
                                </td>
                                <td>
                                    <a href="#" onclick="downloadFile('{{asset('book_files/'.$product['item_file'])}}')" class="btn btn-primary">Download</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p><a href="{{ route('shop') }}" class="btn btn-sm btn-outline-black">Back to shop</a></p>
            </div>
        </div>
    </div>
</div>

@stop


@else
<?php
	// If there's no success message, redirect to the cart page
	header("Location: /cart");
	exit();
?>
@endif

<script>
  function downloadFile(url) {
    var link = document.createElement('a');
    link.href = url;
    link.setAttribute('download', '');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  }
</script>
		