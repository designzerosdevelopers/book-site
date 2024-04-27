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
                <div class="col-md-12 mb-3 my-5">
                    <ul class="nav justify-content-center">
                        @foreach($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link category-link" href="#" data-category="{{ $category->category_name }}">{{ $category->category_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div id="items-container" class="row">

                </div>
            </div>

                {{-- @foreach($allitems as $item)
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        <div class="product-item">
                            <a style="text-decoration: none;" href="{{ route('product.details', ['id' => $item->id]) }}">
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
                <!-- End Column 1 --> --}}
        

            {{-- <!-- Pagination Links -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item  {{ $allitems->previousPageUrl() ? '' : 'disabled' }}">
                                <a class="page-link previous-page" href="" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            @foreach($allitems->getUrlRange(1, $allitems->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $allitems->currentPage() ? 'active' : '' }}">
                                    <a class="page-link page-numbers" href="">{{ $page }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ $allitems->nextPageUrl() ? '' : 'disabled' }}">
                                <a class="page-link next-page" href="">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- End Pagination Links --> --}}
            

        </div>
    </div>

@stop

<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // request to load all items
    $(document).ready(function (){
        if (!window.location.search) {
            $.ajax({
                url: "{{ route('shop') }}",
                type: "GET",
                data: { 'all': true },
                success: function(response) {
                    $('#items-container').html(response);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
        

        // request for categories
        $('.category-link').on('click', function(e) {
            e.preventDefault();
            var category = $(this).attr('data-category');
            $.ajax({
                url: "{{ route('shop') }}",
                type: "GET",
                data: { category: category },
                success: function(response) {
                    $('#items-container').html(response).show();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
 
        //  pagination request of category
        $(document).on('click', '.page-link',function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            console.log(page);
            if (page.includes('?category')) {
                $.ajax({
                    url: '/shop',
                    type: 'GET',
                    data: { page: page },
                    success: function(response) {
                        $('#items-container').html(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors here
                        console.error(error);
                    }
                });

            }else if(page.includes('?search')) {
                console.log('search hitted');
                $.ajax({
                    url: '/shop', 
                    type: 'GET',
                    data: { search: page },
                    success: function(response) {
                        $('#items-container').html(response)
                    
                    },
                    error: function(xhr, status, error) {
                        // Handle errors here
                        console.error(error);
                    }
                });
                // pagination request for all search results.
            }else {
                $.ajax({
                    url: '/shop', 
                    type: 'GET',
                    data: { page: page },
                    success: function(response) {
                        $('#items-container').html(response)
                    },
                    error: function(xhr, status, error) {
                        // Handle errors here
                        console.error(error);
                    }
                });
            }
        });
    });


    // request for searched item, out of shop page 
    if (window.location.search) {
        $(document).ready(function() {
            const urlParams = new URLSearchParams(window.location.search);
            const searchQuery = urlParams.get('search'); 
            $.ajax({
                url: '/shop', 
                method: 'GET',
                data: {query: searchQuery},
                success: function(response) {
                    $('#items-container').html(response);  
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(error);
                }
            });
        });
    }


    


</script>
