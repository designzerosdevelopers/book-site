@extends('layouts.admin-layout.app')
@section('content')
<div class="content-wrapper">
    @if(count($cartItems) > 0)
    <table class="table">
        <thead>
            <tr>
                <th class="product-thumbnail">Image</th>
                <th class="product-name">Product</th>
                <th class="product-price">Price</th>
                <th class="product-remove">Action</th>
            </tr>
        </thead>
        <tbody>
        @php
                $totalprice = 0;
        @endphp
        
        
            @foreach($cartItems as $item)

                <tr>
                    <td class="product-thumbnail">
                        <img src="{{ asset('book_images/' . $item['image']) }}" alt="Image" class="img-fluid" width="30%">
                    </td>
                    <td class="product-name">
                        <h2 class="h5 text-black">{{ $item['name'] }}</h2>
                    </td>
                    <td id="price{{ $loop->index }}">${{ $item['price'] }}</td>
                    <td>
                        <a href="" onclick="downloadFile('{{asset('book_files/'.$item['file'])}}')" class="btn btn-primary">Download</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <div class="empty-cart-message text-center mt-2">
            <p class="empty-cart-text display-6">Nothing Purchased.</p>
        </div>
    @endif
</div>
 

@stop

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