@extends('layouts.clientside-layout.app')
@section('content')
    {!! App\Helpers\SiteviewHelper::page('home')->herohtml !!}
    @php $style = App\Helpers\SiteviewHelper::style('homesetting'); @endphp
    <!-- Start Product Section -->
    <div class="product-section">
        <div class="container">
            <div class="row">
                <!-- Start Column 1 -->
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                    <h2 class="mb-4 section-title">{{ $style['data']['product_section_title'] }}</h2>
                    <p class="mb-4 ">{{ $style['data']['product_section_description'] }}</p>
                    <p><a class="btn"
                            href="{{ $style['data']['product_section_button_url'] }}">{{ $style['data']['product_section_button'] }}</a>
                    </p>
                </div>
                @foreach (App\Helpers\SiteviewHelper::item() as $item)
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        <div class="product-item">
                            <a style="text-decoration: none;" href="{{ $item->slug }}">
                                <img src="{{App\Helpers\SiteviewHelper::generates3url($item->image)}}" class="img-fluid product-thumbnail">
                                <h3 class="product-title item-title">{{ $item->name }}</h3>
                            </a>
                            <a class="product-item" href="{{ route('add.product', ['id' => encrypt($item->id)]) }}"><strong
                                    class="item-price">${{ $item->price }}</strong> <span class="icon-cross"> <img
                                        class="img-fluid" src="{{App\Helpers\SiteviewHelper::generates3url('clientside/images/cross.svg')}}"> </span>
                            </a>
                        </div>
                    </div>
                @endforeach
                <!-- Column 1 -->
            </div>
        </div>
    </div>
    <!-- End Product Section -->
    {!! App\Helpers\SiteviewHelper::page('home')->lowerhtml !!}
@stop
























<!-- Start Hero Section -->
{{-- <div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-7">
                <div class="intro-excerpt">
                    @if (!empty(App\Helpers\SiteviewHelper::homepage()))
                    {{ App\Helpers\SiteviewHelper::homepage()->html }}
                    @if (!empty(App\Helpers\SiteviewHelper::homepage()))
                    {{ App\Helpers\SiteviewHelper::homepage()->html }}
                    @else
                        No  Data
                        No  Data
                    @endif
                   
                    <p><a href="{{ $data['button_1_url'] }}" class="btn btn-secondary me-2">{{ $data['button_1_name'] }}</a><a href="{{ $data['button_2_url'] }}" class="btn btn-white-outline">{{ $data['button_2_name'] }}</a></p>
                    <p><a href="{{ $data['button_1_url'] }}" class="btn btn-secondary me-2">{{ $data['button_1_name'] }}</a><a href="{{ $data['button_2_url'] }}" class="btn btn-white-outline">{{ $data['button_2_name'] }}</a></p>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="hero-img-wrap">
                    @if (!empty(App\Helpers\SiteviewHelper::homepage()))
                    <img src="{{ asset('clientside/images/'.App\Helpers\SiteviewHelper::homepage()->hero_image) }}" class="img-fluid" width="70%">
                    @if (!empty(App\Helpers\SiteviewHelper::homepage()))
                    <img src="{{ asset('clientside/images/'.App\Helpers\SiteviewHelper::homepage()->hero_image) }}" class="img-fluid" width="70%">
                    @else
                        No  Image
                    @endif
        
        
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->


    <!-- Start Product Section -->
    <div class="product-section">
        <div class="container">
            <div class="row">

                <!-- Start Column 1 -->
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                    <h2 class="mb-4 section-title">{{ $data['ps_title'] }}</h2>
                    <p class="mb-4">{{ $data['ps_description'] }} </p>
                    <p><a href="" class="btn">Explore</a></p>
                    <h2 class="mb-4 section-title">{{ $data['ps_title'] }}</h2>
                    <p class="mb-4">{{ $data['ps_description'] }} </p>
                    <p><a href="" class="btn">Explore</a></p>
                </div>
                <!-- End Column 1 -->

                <!-- Start Column 2 -->
                @foreach ($items as $item)
                @foreach ($items as $item)
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <div class="product-item">
                        <a  style="text-decoration: none;" href="{{ route('product.details', ['id' => $item->id]) }}">
                        <img src="{{asset('book_images/'.$item->image)}}" class="img-fluid product-thumbnail">
                        <img src="{{asset('book_images/'.$item->image)}}" class="img-fluid product-thumbnail">
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
                <!-- End Column 2 -->
            </div>
        </div>
    </div>
    <!-- End Product Section -->

    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <h2 class="section-title">{{ $data['wcu_title'] }}</h2>
                    <p>{{ $data['wcu_description'] }}</p>
                    <h2 class="section-title">{{ $data['wcu_title'] }}</h2>
                    <p>{{ $data['wcu_description'] }}</p>

                    <div class="row my-5">
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{asset('clientside/images/truck.svg')}}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>{{ $data['wcu_feature_1_title'] }}</h3>
                                <p>{{ $data['wcu_feature_1_description'] }}</p>
                                <h3>{{ $data['wcu_feature_1_title'] }}</h3>
                                <p>{{ $data['wcu_feature_1_description'] }}</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{asset('clientside/images/bag.svg')}}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>{{ $data['wcu_feature_2_title'] }}</h3>
                                <p>{{ $data['wcu_feature_2_description'] }}</p>
                                <h3>{{ $data['wcu_feature_2_title'] }}</h3>
                                <p>{{ $data['wcu_feature_2_description'] }}</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{asset('clientside/images/support.svg')}}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>{{ $data['wcu_feature_3_title'] }}</h3>
                                <p>{{ $data['wcu_feature_3_description'] }}</p>
                                <h3>{{ $data['wcu_feature_3_title'] }}</h3>
                                <p>{{ $data['wcu_feature_3_description'] }}</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{asset('clientside/images/return.svg')}}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>{{ $data['wcu_feature_4_title'] }}</h3>
                                <p>{{ $data['wcu_feature_4_description'] }}</p>
                                <h3>{{ $data['wcu_feature_4_title'] }}</h3>
                                <p>{{ $data['wcu_feature_4_description'] }}</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="img-wrap">
                        <img src="{{asset('clientside/images/'.$data['home_wcu_image'])}}" alt="Image" class="img-fluid">
                        <img src="{{asset('clientside/images/'.$data['home_wcu_image'])}}" alt="Image" class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Why Choose Us Section -->

    <!-- Start We Help Section -->
    <div class="we-help-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="imgs-grid">
                        <div class="grid grid-1"><img src="{{ asset('clientside/images/down1.png')}}" alt="Untree.co"></div>
                        <div class="grid grid-2"><img src="{{ asset('clientside/images/down3.png')}}" alt="Untree.co"></div>
                        <div class="grid grid-3"><img src="{{ asset('clientside/images/down4.jpg')}}" alt="Untree.co"></div>
                    </div>
                </div>
                <div class="col-lg-5 ps-lg-5">
                    <h2 class="section-title mb-4">{{ $data['wh_title'] }}</h2>
                    <p>{{ $data['wh_description'] }}</p>
                    <h2 class="section-title mb-4">{{ $data['wh_title'] }}</h2>
                    <p>{{ $data['wh_description'] }}</p>
                
                    <ul class="list-unstyled custom-list my-4">
                        <li>{{ $data['wh_feature_1'] }}</li>
                        <li>{{ $data['wh_feature_2'] }}</li>
                        <li>{{ $data['wh_feature_3'] }}</li>
                        <li>{{ $data['wh_feature_4'] }}</li>
                        <li>{{ $data['wh_feature_1'] }}</li>
                        <li>{{ $data['wh_feature_2'] }}</li>
                        <li>{{ $data['wh_feature_3'] }}</li>
                        <li>{{ $data['wh_feature_4'] }}</li>
                    </ul>
                    <p><a href="#" class="btn">Explore</a></p>
                </div>
                
                
            </div>
        </div>
    </div> --}}
<!-- End We Help Section -->
    </div> --}}
<!-- End We Help Section -->

{{-- <!-- Start Popular Product -->
{{-- <!-- Start Popular Product -->
    <div class="popular-product">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="product-item-sm d-flex">
                        <div class="thumbnail">
                            <img src="images/product-1.png" alt="Image" class="img-fluid">
                        </div>
                        <div class="pt-3">
                            <h3>Nordic Chair</h3>
                            <p>Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio </p>
                            <p><a href="#">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="product-item-sm d-flex">
                        <div class="thumbnail">
                            <img src="images/product-2.png" alt="Image" class="img-fluid">
                        </div>
                        <div class="pt-3">
                            <h3>Kruzo Aero Chair</h3>
                            <p>Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio </p>
                            <p><a href="#">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="product-item-sm d-flex">
                        <div class="thumbnail">
                            <img src="images/product-3.png" alt="Image" class="img-fluid">
                        </div>
                        <div class="pt-3">
                            <h3>Ergonomic Chair</h3>
                            <p>Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio </p>
                            <p><a href="#">Read More</a></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Popular Product --> --}}




{{-- <!-- Start Blog Section -->
{{-- <!-- Start Blog Section -->
    <div class="blog-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-6">
                    <h2 class="section-title">Recent Blog</h2>
                </div>
                <div class="col-md-6 text-start text-md-end">
                    <a href="#" class="more">View All Posts</a>
                </div>
            </div>

            <div class="row">

                <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                    <div class="post-entry">
                        <a href="#" class="post-thumbnail"><img src="images/post-1.jpg" alt="Image" class="img-fluid"></a>
                        <div class="post-content-entry">
                            <h3><a href="#">First Time Home Owner Ideas</a></h3>
                            <div class="meta">
                                <span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 19, 2021</a></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                    <div class="post-entry">
                        <a href="#" class="post-thumbnail"><img src="images/post-2.jpg" alt="Image" class="img-fluid"></a>
                        <div class="post-content-entry">
                            <h3><a href="#">How To Keep Your Furniture Clean</a></h3>
                            <div class="meta">
                                <span>by <a href="#">Robert Fox</a></span> <span>on <a href="#">Dec 15, 2021</a></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                    <div class="post-entry">
                        <a href="#" class="post-thumbnail"><img src="images/post-3.jpg" alt="Image" class="img-fluid"></a>
                        <div class="post-content-entry">
                            <h3><a href="#">Small Space Furniture Apartment Ideas</a></h3>
                            <div class="meta">
                                <span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 12, 2021</a></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Blog Section -->	 --}}

