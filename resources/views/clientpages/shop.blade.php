@extends('layouts.clientside-layout.app')
@section('content')

    {!! App\Helpers\SiteviewHelper::page('shop')->herohtml !!}




    {{-- <!-- Start Hero Section -->
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
    <!-- End Hero Section --> --}}

    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3 my-5">
                    <ul class="nav justify-content-center">
                        @foreach ($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link category-link" href="#"
                                    data-category="{{ $category }}">{{ $category }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div id="items-container" class="row">
                    <!-- Items will be displayed here -->
                </div>
            </div>
        </div>


        {{-- @foreach (App\Helpers\SiteviewHelper::item() as $item)
             
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        <div class="product-item">
                            <a style="text-decoration: none;" href="">
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

        {!! App\Helpers\SiteviewHelper::page('footer')->allhtml !!}


    @stop

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // request to load all items
        $(document).ready(function() {
            if (!window.location.search) {
                console.log();
                $.ajax({
                    url: "{{ route('books') }}",
                    type: "GET",
                    data: {
                        'all': true
                    },
                    success: function(response) {
                        $('#items-container').html(response);

                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });

            }



            $(document).ready(function() {
                function getCategoryFromURL() {
                    var queryParams = new URLSearchParams(window.location.search);
                    var category = queryParams.get('category');
                    if (category) {
                        $.ajax({
                            url: "{{ route('books') }}",
                            type: "GET",
                            data: {
                                'category': category
                            },
                            success: function(response) {
                                $('#items-container').html(response);
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    } else {
                        // Handle the case where the category parameter is not present or doesn't have a value
                        console.log('No category specified in the URL');
                    }
                }
                // Call the function to fetch category from URL when the document is ready
                getCategoryFromURL();
            });




            // request for categories
            $('.category-link').on('click', function(e) {
                e.preventDefault();
                var category = $(this).attr('data-category');
                console.log(category);
                $.ajax({
                    url: "{{ route('books') }}",
                    type: "GET",
                    data: {
                        category: category
                    },
                    success: function(response) {
                        $('#items-container').html(response).show();
                        console.log('response for category selection' + response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            //  pagination request of category
            $(document).on('click', '.page-link', function(event) {
                event.preventDefault();
                var href = $(this).attr('href'); // Get the value of the href attribute
                var page = href.split('page=')[1].split('&')[0]; // Extract the page number
                var category = href.split('category=')[1]; // Extract the category
                
                if (page.includes('?category')) {
                    $.ajax({
                        url: '/books',
                        type: 'GET',
                        data: {
                            page: page
                        },
                        success: function(response) {
                            // $('#items-container').html(response);
                            console.log('response for page changing' + response);

                        },
                        error: function(xhr, status, error) {
                            // Handle errors here
                            console.error(error);
                        }
                    });

                } else if (page.includes('?search')) {
                    console.log('search hitted');
                    $.ajax({
                        url: '/books',
                        type: 'GET',
                        data: {
                            search: page
                        },
                        success: function(response) {
                            $('#items-container').html(response)
                            console.log('response for search' + response);

                        },
                        error: function(xhr, status, error) {
                            // Handle errors here
                            console.error(error);
                        }
                    });
                    // pagination request for all search results.
                } else {
                    $.ajax({
                        url: '/books',
                        type: 'GET',
                        data: {
                            page: page,
                            category: category
                        },
                        success: function(response) {
                            $('#items-container').html(response)
                            console.log('response for page changing for ' +
                                response);
                        },
                        error: function(xhr, status, error) {
                            // Handle errors here
                            console.error(error);
                        }
                    });
                }
            });
        });


        if (window.location.search) {
            $(document).ready(function() {
                const urlParams = new URLSearchParams(window.location.search);
                const searchQuery = urlParams.get('search');
                $.ajax({
                    url: '/books',
                    method: 'GET',
                    data: {
                        query: searchQuery
                    },
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

    <script>
        $(document).ready(function() {
            // Function to execute when a category is clicked
            $('.category-link').click(function(e) {
                e.preventDefault(); // Prevent the default action of the link

                // Remove the active class from all category links
                $('.category-link').removeClass('active');

                // Add the active class to the clicked category link
                $(this).addClass('active');

                // Get the category name from the data attribute
                var category = $(this).data('category');

                // Update the URL with the selected category
                var currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set('category', category);
                history.pushState({}, '', currentUrl);
            });

            // // Check if category parameter is not present in the URL
            // if (!window.location.search.includes('category')) {
            //     // If not present, set it to "All"
            //     var currentUrl = new URL(window.location.href);
            //     currentUrl.searchParams.set('category', 'All');
            //     history.pushState({}, '', currentUrl);
            // }
        });
    </script>
