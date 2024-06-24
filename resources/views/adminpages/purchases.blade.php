@extends('layouts.admin-layout.app')
@section('content')


<div class="content-wrapper">
    <div class="card">
    @if(session()->has('email_sent'))
        <div class="alert alert-success" role="alert" id="success-alert">
            Your account has been created. Please check your email to reset your password.
        </div>
    @elseif(session()->has('error'))
        <div class="alert alert-success" role="alert" id="success-alert">
            <strong>Account Creation Successful:</strong> Your account has been created, but unfortunately, we were unable to send your password via email.
        </div>
    @elseif(session()->has('repurchases'))
        <div class="alert alert-success" role="alert" id="success-alert">
            {{ session('repurchases') }}
        </div>
    @endif

    

    @if(count($cartItems) > 0)
    <table class="table">
        <!-- Table header -->
        <thead>
            <tr>
                <th class="product-thumbnail">Image</th>
                <th class="product-name">Product</th>
                <th class="product-price">Price</th>
                <th class="product-remove">Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table body -->
            @foreach($cartItems as $item)
            <tr>
                <td class="product-thumbnail">
                    <img src="{{App\Helpers\SiteviewHelper::generates3url($item['image'])}}" alt="Image" class="img-fluid" width="30%">
                </td>
                <td class="product-name">
                    <h2 class="h5 text-black">{{ $item['name'] }}</h2>
                </td>
                <td id="price{{ $loop->index }}">${{ $item['price'] }}</td>
                <td>
                    <a href="javascript:void(0)" onclick="downloadFile('{{App\Helpers\SiteviewHelper::generates3url($item['file'])}}')" class="btn btn-success">Download</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <!-- Display message if cart is empty -->
    <div class="empty-cart-message text-center mt-2">
        <p class="empty-cart-text display-6">Nothing Purchased.</p>
    </div>
    @endif
</div>
</div>
@stop

<script>
    function downloadFile(url) {
      var link = document.createElement('a');
      console.log(link);
      link.href = url;
      link.setAttribute('download', '');
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }


</script>
