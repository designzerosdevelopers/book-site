@extends('layouts.clientside-layout.app')

@section('content')
  <!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-7">
                <div class="intro-excerpt">
                    @if (!empty($heroData->hero_heading))
                    <h1>{{ $heroData->hero_heading }}</h1>
                    @else
                        No  heading
                    @endif
                   
                    @if (!empty($heroData->hero_paragraph ))
                    <p class="mb-4">{{ $heroData->hero_paragraph }}</p>
                    @else
                        No  paragraph
                    @endif
                    
                    <p><a href="" class="btn btn-secondary me-2">Shop now</a><a href="" class="btn btn-white-outline">Explore</a></p>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="hero-img-wrap">
                    @if (!empty($heroData->hero_image ))
                    <img src="{{ asset('clientside/images/'.$heroData->hero_image) }}" class="img-fluid" width="90%">
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
                    <h2 class="mb-4 section-title">Embark on literary journeys crafted with excellent narratives.</h2>
                    <p class="mb-4">Lost in the library's embrace, she found solace among the books. Each spine a doorway to a new world, each page a whispered invitation to adventure. In that quiet sanctuary, she discovered the timeless magic of stories. </p>
                    <p><a href="{{ route('shop') }}" class="btn">Explore</a></p>
                </div>
                <!-- End Column 1 -->

                <!-- Start Column 2 -->
                @foreach($items as $item)
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="{{ route('cart', ['id' => $item->id]) }}">
                        <img src="{{ asset('book_images/'.$item->image)}}" class="img-fluid product-thumbnail">
                        <h3 class="product-title">{{$item->name}}</h3>
                        <strong class="product-price">${{$item->price}}</strong>
                        <span class="icon-cross">
                            <img src="{{ asset('clientside/images/cross.svg')}}" class="img-fluid">
                        </span>
                    </a>
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
                    <h2 class="section-title">Why Choose Us</h2>
                    <p>Choose us for your literary journey because we believe in the power of stories to inspire, to transform, and to connect. Our curated collection offers a diverse tapestry of narratives, inviting you to explore new worlds, encounter fascinating characters, and experience the thrill of discovery with every turn of the page. With our passion for books and commitment to quality, we strive to enrich your reading experience and accompany you on your literary adventures.</p>

                    <div class="row my-5">
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{asset('clientside/images/truck.svg')}}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Fast &amp; Free Shipping</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{asset('clientside/images/bag.svg')}}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Easy to Shop</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{asset('clientside/images/support.svg')}}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>24/7 Support</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{asset('clientside/images/return.svg')}}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Hassle Free Returns</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="img-wrap">
                        <img src="{{asset('clientside/images/down1.png')}}" alt="Image" class="img-fluid">
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
                    <h2 class="section-title mb-4">Echoes of Enchantment: Journeys Await</h2>
                    <p>Welcome to BookWeb, where every page holds a new adventure and every story whispers secrets waiting to be discovered. Immerse yourself in a world of literary wonders, where the written word becomes a gateway to endless possibilities. From classics to contemporary masterpieces, our curated collection invites you to explore, escape, and embrace storytelling's magic. Let our books be your companions on the journey of imagination, enlightenment, and discovery. Embark on a reading experience like no other. Welcome to a world where stories come alive. Welcome to BookWeb.</p>
                
                    <ul class="list-unstyled custom-list my-4">
                        <li>Discover masterpieces old and new</li>
                        <li>Escape to new worlds with us</li>
                        <li>Immerse in storytelling's magic</li>
                        <li>Experience discovery with every page</li>
                    </ul>
                    <p><a href="#" class="btn">Explore</a></p>
                </div>
                
                
            </div>
        </div>
    </div>
    <!-- End We Help Section -->

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
    @stop