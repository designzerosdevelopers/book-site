<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->TEXT('allhtml');
            $table->TEXT('herohtml');
            $table->TEXT('middlehtml');
            $table->TEXT('lowerhtml');
            $table->TEXT('css');
            $table->TEXT('data');
            $table->timestamps();
        });



                    // Insert records directly after table creation
                    DB::table('components')->insert([
                        [
                            'name' => 'home',
                            'allhtml' => '',
                            'herohtml' => '<!-- Start Hero Section --> <div class="hero"> <div class="container"> <div class="row justify-content-between"> <div class="col-lg-5"> <div class="intro-excerpt"> <h1>Modern Interior Design Studio</h1> <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p> <p><a class="btn btn-secondary me-2">Shop Now</a><a class="btn btn-white-outline" href="#">Explore</a></p> </div> </div> <div class="col-lg-7"> <div class="hero-img-wrap"><img class="img-fluid" style="display: block; margin-left: auto; margin-right: auto;" src="clientside/images/hero-image.png" width="321" height="377"></div> </div> </div> </div> </div> <!-- End Hero Section -->',
                            'middlehtml' => '<div class="middle">Middle Section</div>',
                            'lowerhtml' => '
                            <!-- Start Why Choose Us Section -->
                            <div class="why-choose-section">
                                <div class="container">
                                    <div class="row justify-content-between">
                                        <div class="col-lg-6">
                                            <h2 class="section-title">Why Choose Us</h2>
                                            <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit
                                                imperdiet dolor tempor tristique.</p>
                                            <div class="row my-5">
                                                <div class="col-6 col-md-6">
                                                    <div class="feature">
                                                        <div class="icon"><img class="imf-fluid" src="clientside/images/truck.svg" alt="Image"></div>
                                                        <h3>Fast &amp; Free Shipping</h3>
                                                        <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <div class="feature">
                                                        <div class="icon"><img class="imf-fluid" src="clientside/images/bag.svg" alt="Image"></div>
                                                        <h3>Easy to Shop</h3>
                                                        <p>we offer easy to ship.</p>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <div class="feature">
                                                        <div class="icon"><img class="imf-fluid" src="clientside/images/support.svg" alt="Image"></div>
                                                        <h3>24/7 Support</h3>
                                                        <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <div class="feature">
                                                        <div class="icon"><img class="imf-fluid" src="clientside/images/return.svg" alt="Image"></div>
                                                        <h3>Hassle Free Returns</h3>
                                                        <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="img-wrap"><img class="img-fluid" src="clientside/images/why-choose-us-img.jpg" alt="Image"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End Why Choose Us Section -->
                            <p>&nbsp;</p> <!-- Start We Help Section -->
                            <div class="we-help-section">
                                <div class="container">
                                    <div class="row justify-content-between">
                                        <div class="col-lg-7 mb-5 mb-lg-0">
                                            <div class="imgs-grid">
                                                <div class="grid grid-1"><img src="clientside/images/img-grid-1.jpg" alt="Untree.co"></div>
                                                <div class="grid grid-2"><img src="clientside/images/img-grid-2.jpg" alt="Untree.co"></div>
                                                <div class="grid grid-3"><img src="clientside/images/img-grid-3.jpg" alt="Untree.co"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 ps-lg-5">
                                            <h2 class="section-title mb-4">We Help You Make Modern Interior Design</h2>
                                            <p>Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam
                                                ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant
                                                morbi tristique senectus et netus et malesuada</p>
                                            <ul class="list-unstyled custom-list my-4">
                                                <li>Donec vitae odio quis nisl dapibus malesuada</li>
                                                <li>Donec vitae odio quis nisl dapibus malesuada</li>
                                                <li>Donec vitae odio quis nisl dapibus malesuada</li>
                                                <li>Donec vitae odio quis nisl dapibus malesuada</li>
                                            </ul>
                                            <p><a class="btn">Explore</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End We Help Section -->
                            ',
                            'css' => '',
                            'data' => '{"display_product":"3","product_section_title":"Crafted with excellent material.","product_section_description":"Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.","product_section_button":"Explore","product_section_button_url":"https:\/\/book.codezeroes.com\/shop"}',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'name' => 'about',
                            'allhtml' => '<!-- Start Hero Section -->
                            <div class="hero">
                                <div class="container">
                                    <div class="row justify-content-between">
                                        <div class="col-lg-5">
                                            <div class="intro-excerpt">
                                                <h1>About Us</h1>
                                                <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                                                    vulputate velit imperdiet dolor tempor tristique.</p>
                                                <p><a class="btn btn-secondary me-2">Shop Now</a><a class="btn btn-white-outline"
                                                        href="#">Explore</a></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="hero-img-wrap"><img class="img-fluid"
                                                    style="display: block; margin-left: auto; margin-right: auto;"
                                                    src="clientside/images/hero-image.png" width="308" height="362"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End Hero Section -->
                            <p>&nbsp;</p> <!-- Start Why Choose Us Section -->
                            <!-- Start Why Choose Us Section -->
                            <div class="why-choose-section">
                                <div class="container">
                                    <div class="row justify-content-between">
                                        <div class="col-lg-6">
                                            <h2 class="section-title">Why Choose Us</h2>
                                            <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit
                                                imperdiet dolor tempor tristique.</p>
                                            <div class="row my-5">
                                                <div class="col-6 col-md-6">
                                                    <div class="feature">
                                                        <div class="icon"><img class="imf-fluid" src="clientside/images/truck.svg" alt="Image">
                                                        </div>
                                                        <h3>Fast &amp; Free Shipping</h3>
                                                        <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <div class="feature">
                                                        <div class="icon"><img class="imf-fluid" src="clientside/images/bag.svg" alt="Image">
                                                        </div>
                                                        <h3>Easy to Shop</h3>
                                                        <p>we offer easy to ship.</p>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <div class="feature">
                                                        <div class="icon"><img class="imf-fluid" src="clientside/images/support.svg"
                                                                alt="Image"></div>
                                                        <h3>24/7 Support</h3>
                                                        <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <div class="feature">
                                                        <div class="icon"><img class="imf-fluid" src="clientside/images/return.svg"
                                                                alt="Image"></div>
                                                        <h3>Hassle Free Returns</h3>
                                                        <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="img-wrap"><img class="img-fluid" src="clientside/images/why-choose-us-img.jpg"
                                                    alt="Image"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End Why Choose Us Section -->
                            ',
                            'herohtml' => '',
                            'middlehtml' => '',
                            'lowerhtml' => '',
                            'css' => '',
                            'data' => '',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'name' => 'contact',
                            'allhtml' => '',
                            'herohtml' => '<!-- Start Hero Section --> <div class="hero"> <div class="container"> <div class="row justify-content-between"> <div class="col-lg-5"> <div class="intro-excerpt"> <h1>Contact</h1> <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p> <p><a class="btn btn-secondary me-2">Shop Now</a><a class="btn btn-white-outline" href="#">Explore</a></p> </div> </div> <div class="col-lg-7"> <div class="hero-img-wrap"><img class="img-fluid" src="images/couch.png"></div> </div> </div> </div> </div> <!-- End Hero Section -->',
                            'middlehtml' => '<div class="row mb-5">                             <div class="col-lg-4">                                 <div class="service no-shadow align-items-center link horizontal d-flex active"                                     data-aos="fade-left" data-aos-delay="0">                                     <div class="service-icon color-1 mb-4">                                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"                                             fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">                                             <path                                                 d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />                                         </svg>                                     </div> <!-- /.icon -->                                     <div class="service-contents">                                         <p>43 Raymouth Rd. Baltemoer, London 3910</p>                                     </div> <!-- /.service-contents-->                                 </div> <!-- /.service -->                             </div>                              <div class="col-lg-4">                                 <div class="service no-shadow align-items-center link horizontal d-flex active"                                     data-aos="fade-left" data-aos-delay="0">                                     <div class="service-icon color-1 mb-4">                                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"                                             fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">                                             <path                                                 d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z" />                                         </svg>                                     </div> <!-- /.icon -->                                     <div class="service-contents">                                         <p>info@yourdomain.com</p>                                     </div> <!-- /.service-contents-->                                 </div> <!-- /.service -->                             </div>                              <div class="col-lg-4">                                 <div class="service no-shadow align-items-center link horizontal d-flex active"                                     data-aos="fade-left" data-aos-delay="0">                                     <div class="service-icon color-1 mb-4">                                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"                                             fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">                                             <path fill-rule="evenodd"                                                 d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />                                         </svg>                                     </div> <!-- /.icon -->                                     <div class="service-contents">                                         <p>+1 294 3925 3939</p>                                     </div> <!-- /.service-contents-->                                 </div> <!-- /.service -->                             </div>                         </div>',
                            'lowerhtml' => '',
                            'css' => '',
                            'data' => '{"address":"43 Raymouth Rd. Baltemoer, London 39","phone":"+1 294 3925 3939","email":"info@yourdomain.com"}',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],                     [
                            'name' => 'shop',
                            'allhtml' => '',
                            'herohtml' => '<!-- Start Hero Section -->     <div class="hero">         <div class="container">             <div class="row justify-content-between">                 <div class="col-lg-5">                     <div class="intro-excerpt">                         <h1>Shop</h1>                     </div>                 </div>                 <div class="col-lg-7">                 </div>             </div>         </div>     </div>     <!-- End Hero Section -->',
                            'middlehtml' => '',
                            'lowerhtml' => '',
                            'css' => '',
                            'data' => '{"display_product":"10"}',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],                     [
                            'name' => 'productdetail',
                            'allhtml' => '',
                            'herohtml' => '
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
                            </div>',
                            'middlehtml' => '',
                            'lowerhtml' => '',
                            'css' => '',
                            'data' => '{"product_button_name":"Add to Cart"}',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],                     [
                            'name' => 'navbar',
                            'allhtml' => '
                            <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
                                <div class="container"><a class="navbar-brand" href="index"><img src="clientside/images/logo.png" alt="asf"
                                            width="50" height="45">DigitalStore.
                                        </a>
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                                        aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                            
                                    <div id="navbarsFurni" class="collapse navbar-collapse">
                                        <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                                            <li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8000/">Home</a></li>
                                            <li class="nav-item "><a class="nav-link" href="shop">Shop</a></li>
                                            <li class="nav-item"><a class="nav-link" href="about">About us</a></li>
                                            <li class="nav-item"><a class="nav-link" href="contact">Contact us</a></li>
                                        </ul>
                                        <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                                            <li class="search-item"><a id="searchIcon" class="nav-link" href="#"> <img
                                                        src="clientside/images/search.svg" alt="Search"> </a></li>
                                            <li><a class="nav-link" href="login"><img src="clientside/images/user.svg"></a></li>
                                            <li class="cart-item"><a class="nav-link" href="cart"> <img src="clientside/images/cart.svg"
                                                        alt="Cart"> <span class="cart-count-container" style="opacity: 0;"> <span
                                                            id="cartItemCount" class="cart-count">0</span> </span> </a></li>
                                        </ul>
                                        <div id="searchModal" class="modal">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Search</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="searchForm">
                                                            <div class="mb-3"><input id="searchInput" class="form-control" type="text"
                                                                    placeholder="Search..."></div> <button class="btn btn-primary"
                                                                type="submit">Search</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                            ',
                            'herohtml' => '',
                            'middlehtml' => '',
                            'lowerhtml' => '',
                            'css' => '',
                            'data' => '',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],                     [
                            'name' => 'footer',
                            'allhtml' => '
                            <footer class="footer-section"><!--?php echo "helo world"; ?-->
                                <div class="container relative">
                                    <div class="sofa-img mt-5 "><img class="img-fluid" src="clientside/images/download.png" alt="Image"></div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="subscription-form">
                                                <h3 class="d-flex align-items-center"><span class="me-1"><img class="img-fluid"
                                                            src="clientside/images/envelope-outline.svg" alt="Image"></span>Subscribe to
                                                    Newsletter</h3>
                                                <form class="row g-3" action="#">
                                                    <div class="col-auto"><input class="form-control" type="text" placeholder="Enter your name">
                                                    </div>
                                                    <div class="col-auto"><input class="form-control" type="email" placeholder="Enter your email">
                                                    </div>
                                                    <div class="col-auto"><button class="btn btn-primary">Subscribe</button></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-lg-4">
                                            <div class="mb-4 footer-logo-wrap"><a class="footer-logo" href="#">BookWeb.</a></div>
                                            <p class="mb-4">Explore the vast realms of literature with BookWeb. Dive into worlds unknown, uncover
                                                mysteries untold. Let the written word ignite your imagination, guide your journey. Embrace the
                                                magic of storytelling. Welcome to BookWeb.</p>
                                            <ul class="list-unstyled custom-social">
                                                <li>&nbsp;</li>
                                                <li>&nbsp;</li>
                                                <li>&nbsp;</li>
                                                <li>&nbsp;</li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="row links-wrap">
                                                <div class="col-6 col-sm-6 col-md-3">
                                                    <ul class="list-unstyled">
                                                        <li><a href="#">About us</a></li>
                                                        <li><a href="#">Services</a></li>
                                                        <li><a href="#">Blog</a></li>
                                                        <li><a href="#">Contact us</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-6 col-sm-6 col-md-3">
                                                    <ul class="list-unstyled">
                                                        <li><a href="#">Support</a></li>
                                                        <li><a href="#">Knowledge base</a></li>
                                                        <li><a href="#">Live chat</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-6 col-sm-6 col-md-3">
                                                    <ul class="list-unstyled">
                                                        <li><a href="#">Jobs</a></li>
                                                        <li><a href="#">Our team</a></li>
                                                        <li><a href="#">Leadership</a></li>
                                                        <li><a href="#">Privacy Policy</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-6 col-sm-6 col-md-3">
                                                    <ul class="list-unstyled">
                                                        <li><a href="#">Nordic Chair</a></li>
                                                        <li><a href="#">Kruzo Aero</a></li>
                                                        <li><a href="#">Ergonomic Chair</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top copyright">
                                        <div class="row pt-4">
                                            <div class="col-lg-6">
                                                <p class="mb-2 text-center text-lg-start">Copyright &copy;. All Rights Reserved.</p>
                                            </div>
                                            <div class="col-lg-6 text-center text-lg-end">
                                                <ul class="list-unstyled d-inline-flex ms-auto">
                                                    <li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
                                                    <li><a href="#">Privacy Policy</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </footer>

                            
                            ',
                            'herohtml' => '',
                            'middlehtml' => '',
                            'lowerhtml' => '',
                            'css' => '',
                            'data' => '',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],                     [
                            'name' => 'site',
                            'allhtml' => '',
                            'herohtml' => '',
                            'middlehtml' => '',
                            'lowerhtml' => '',
                            'css' => '

                            /*
                            * Template Name: UntreeStore
                            * Template Author: Untree.co
                            * Author URI: https://untree.co/
                            * License: https://creativecommons.org/licenses/by/3.0/
                            */
                            @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap");
                            
                            body {
                              overflow-x: hidden;
                              position: relative;
                            }
                            
                            body {
                              font-family: "Inter", sans-serif;
                              font-weight: 400;
                              line-height: 28px;
                              color: #6a6a6a;
                              font-size: 14px;
                              background-color: #eff2f1;
                            }
                            
                            a {
                              text-decoration: none;
                              -webkit-transition: .3s all ease;
                              -o-transition: .3s all ease;
                              transition: .3s all ease;
                              color: #2f2f2f;
                              text-decoration: underline;
                            }
                            
                            a:hover {
                              color: #2f2f2f;
                              text-decoration: none;
                            }
                            
                            a.more {
                              font-weight: 600;
                            }
                            
                            .custom-navbar {
                              background: #3b5d50 !important;
                              padding-top: 20px;
                              padding-bottom: 20px;
                            }
                            
                            .custom-navbar .navbar-brand {
                              font-size: 30px;
                              font-weight: 600;
                            }
                            
                            
                            
                            /* Medium devices (tablets, 768px and up) */
                            @media (max-width: 768px) {
                                .custom-navbar .navbar-brand {
                                    font-size: 28px;
                                }
                            }
                            
                            /* Small devices (landscape phones, 576px and up) */
                            @media (max-width: 576px) {
                                .custom-navbar .navbar-brand {
                                    font-size: 24px;
                                }
                            }
                            
                            /* Extra small devices (phones, less than 576px) */
                            @media (max-width: 375px) {
                                .custom-navbar .navbar-brand {
                                    font-size: 20px;
                                }
                            }
                            
                            
                            .custom-navbar .navbar-brand>span {
                              opacity: .4;
                            }
                            
                            .custom-navbar .navbar-toggler {
                              border-color: transparent;
                            }
                            
                            .custom-navbar .navbar-toggler:active,
                            .custom-navbar .navbar-toggler:focus {
                              -webkit-box-shadow: none;
                              box-shadow: none;
                              outline: none;
                            }
                            
                            @media (min-width: 992px) {
                              .custom-navbar .custom-navbar-nav li {
                                margin-left: 15px;
                                margin-right: 15px;
                              }
                            }
                            
                            .custom-navbar .custom-navbar-nav li a {
                              font-weight: 500;
                              color: #ffffff !important;
                              opacity: .5;
                              -webkit-transition: .3s all ease;
                              -o-transition: .3s all ease;
                              transition: .3s all ease;
                              position: relative;
                            }
                            
                            @media (min-width: 768px) {
                              .custom-navbar .custom-navbar-nav li a:before {
                                content: "";
                                position: absolute;
                                bottom: 0;
                                left: 8px;
                                right: 8px;
                                background: #f9bf29;
                                height: 5px;
                                opacity: 1;
                                visibility: visible;
                                width: 0;
                                -webkit-transition: .15s all ease-out;
                                -o-transition: .15s all ease-out;
                                transition: .15s all ease-out;
                              }
                            }
                            
                            .custom-navbar .custom-navbar-nav li a:hover {
                              opacity: 1;
                            }
                            
                            .custom-navbar .custom-navbar-nav li a:hover:before {
                              width: calc(100% - 16px);
                            }
                            
                            .custom-navbar .custom-navbar-nav li.active a {
                              opacity: 1;
                            }
                            
                            .custom-navbar .custom-navbar-nav li.active a:before {
                              width: calc(100% - 16px);
                            }
                            
                            .custom-navbar .custom-navbar-cta {
                              margin-left: 0 !important;
                              -webkit-box-orient: horizontal;
                              -webkit-box-direction: normal;
                              -ms-flex-direction: row;
                              flex-direction: row;
                            }
                            
                            @media (min-width: 768px) {
                              .custom-navbar .custom-navbar-cta {
                                margin-left: 40px !important;
                              }
                            }
                            
                            .custom-navbar .custom-navbar-cta li {
                              margin-left: 0px;
                              margin-right: 0px;
                            }
                            
                            .custom-navbar .custom-navbar-cta li:first-child {
                              margin-right: 20px;
                            }
                            
                            .hero {
                              background: #3b5d50;
                              padding: calc(4rem - 30px) 0 0rem 0;
                            }
                            
                            @media (min-width: 768px) {
                              .hero {
                                padding: calc(4rem - 30px) 0 4rem 0;
                              }
                            }
                            
                            @media (min-width: 992px) {
                              .hero {
                                padding: calc(8rem - 30px) 0 8rem 0;
                              }
                            }
                            
                            .hero .intro-excerpt {
                              position: relative;
                              z-index: 4;
                            }
                            
                            @media (min-width: 992px) {
                              .hero .intro-excerpt {
                                max-width: 450px;
                              }
                            }
                            
                            .hero h1 {
                              font-weight: 700;
                              color: #ffffff;
                              margin-bottom: 30px;
                              font-size: 28px;
                            }
                            
                            @media (min-width: 1400px) {
                              .hero h1 {
                                font-size: 30px;
                              }
                            }
                            
                            .hero p {
                              color: rgba(255, 255, 255, 0.5);
                              margin-botom: 30px;
                            }
                            
                            .hero .hero-img-wrap {
                              position: relative;
                            }
                            
                            .hero .hero-img-wrap img {
                              position: relative;
                              top: 0px;
                              right: 0px;
                              z-index: 2;
                            
                            }
                            
                            @media (min-width: 768px) {
                              .hero .hero-img-wrap img {
                                right: 0px;
                                left: -100px;
                              }
                            }
                            
                            @media (min-width: 992px) {
                              .hero .hero-img-wrap img {
                                left: 0px;
                                top: -80px;
                                position: absolute;
                                right: -50px;
                              }
                            }
                            
                            @media (min-width: 1200px) {
                              .hero .hero-img-wrap img {
                                left: 0px;
                                top: -80px;
                                right: -100px;
                              }
                            }
                            
                            .hero .hero-img-wrap:after {
                              content: "";
                              position: absolute;
                              width: 255px;
                              height: 217px;
                              background-image: url("../clientside/images/dots-light.svg");
                              background-size: contain;
                              background-repeat: no-repeat;
                              right: 0px;
                              top: -0px;
                            }
                            
                            @media (min-width: 1200px) {
                              .hero .hero-img-wrap:after {
                                top: -40px;
                              }
                            }
                            
                            .btn {
                              font-weight: 600;
                              padding: 12px 30px;
                              border-radius: 30px;
                              color: #ffffff;
                              background: #2f2f2f;
                              border-color: #2f2f2f;
                            }
                            
                            .btn:hover {
                              color: #ffffff;
                              background: #222222;
                              border-color: #222222;
                            }
                            
                            .btn:active,
                            .btn:focus {
                              outline: none !important;
                              -webkit-box-shadow: none;
                              box-shadow: none;
                            }
                            
                            .btn.btn-primary {
                              background: #3b5d50;
                              border-color: #3b5d50;
                            }
                            
                            .btn.btn-primary:hover {
                              background: #314d43;
                              border-color: #314d43;
                            }
                            
                            .btn.btn-secondary {
                              color: #2f2f2f;
                              background: #f9bf29;
                              border-color: #f9bf29;
                            }
                            
                            .btn.btn-secondary:hover {
                              background: #f8b810;
                              border-color: #f8b810;
                            }
                            
                            .btn.btn-white-outline {
                              background: transparent;
                              border-width: 2px;
                              border-color: rgba(255, 255, 255, 0.3);
                            }
                            
                            .btn.btn-white-outline:hover {
                              border-color: white;
                              color: #ffffff;
                            }
                            
                            .section-title {
                              color: #2f2f2f;
                            }
                            
                            .product-section {
                              padding: 7rem 0;
                            }
                            
                            .product-section .product-item {
                              text-align: center;
                              text-decoration: none;
                              display: block;
                              position: relative;
                              padding-bottom: 50px;
                              cursor: pointer;
                            }
                            
                            .product-section .product-item .product-thumbnail {
                              margin-bottom: 30px;
                              position: relative;
                              top: 0;
                              -webkit-transition: .3s all ease;
                              -o-transition: .3s all ease;
                              transition: .3s all ease;
                            }
                            
                            .product-section .product-item h3 {
                              font-weight: 600;
                              font-size: 16px;
                            }
                            
                            .product-section .product-item strong {
                              font-weight: 800 !important;
                              font-size: 18px;
                            }
                            
                            .product-section .product-item h3,
                            .product-section .product-item strong {
                              color: #2f2f2f;
                              text-decoration: none;
                            }
                            
                            .product-section .product-item .icon-cross {
                              position: absolute;
                              width: 35px;
                              height: 35px;
                              display: inline-block;
                              background: #2f2f2f;
                              bottom: 15px;
                              left: 50%;
                              -webkit-transform: translateX(-50%);
                              -ms-transform: translateX(-50%);
                              transform: translateX(-50%);
                              margin-bottom: -17.5px;
                              border-radius: 50%;
                              opacity: 0;
                              visibility: hidden;
                              -webkit-transition: .3s all ease;
                              -o-transition: .3s all ease;
                              transition: .3s all ease;
                            }
                            
                            .product-section .product-item .icon-cross img {
                              position: absolute;
                              left: 50%;
                              top: 50%;
                              -webkit-transform: translate(-50%, -50%);
                              -ms-transform: translate(-50%, -50%);
                              transform: translate(-50%, -50%);
                            }
                            
                            .product-section .product-item:before {
                              bottom: 0;
                              left: 0;
                              right: 0;
                              position: absolute;
                              content: "";
                              background: #dce5e4;
                              height: 0%;
                              z-index: -1;
                              border-radius: 10px;
                              -webkit-transition: .3s all ease;
                              -o-transition: .3s all ease;
                              transition: .3s all ease;
                            }
                            
                            .product-section .product-item:hover .product-thumbnail {
                              top: -25px;
                            }
                            
                            .product-section .product-item:hover .icon-cross {
                              bottom: 0;
                              opacity: 1;
                              visibility: visible;
                            }
                            
                            .product-section .product-item:hover:before {
                              height: 70%;
                            }
                            
                            .why-choose-section {
                              padding: 7rem 0;
                            }
                            
                            .why-choose-section .img-wrap {
                              position: relative;
                            }
                            
                            .why-choose-section .img-wrap:before {
                              position: absolute;
                              content: "";
                              width: 255px;
                              height: 217px;
                              background-image: url("../images/dots-yellow.svg");
                              background-repeat: no-repeat;
                              background-size: contain;
                              -webkit-transform: translate(-40%, -40%);
                              -ms-transform: translate(-40%, -40%);
                              transform: translate(-40%, -40%);
                              z-index: -1;
                            }
                            
                            .why-choose-section .img-wrap img {
                              border-radius: 20px;
                            }
                            
                            .feature {
                              margin-bottom: 30px;
                            }
                            
                            .feature .icon {
                              display: inline-block;
                              position: relative;
                              margin-bottom: 20px;
                            }
                            
                            .feature .icon:before {
                              content: "";
                              width: 33px;
                              height: 33px;
                              position: absolute;
                              background: rgba(59, 93, 80, 0.2);
                              border-radius: 50%;
                              right: -8px;
                              bottom: 0;
                            }
                            
                            .feature h3 {
                              font-size: 14px;
                              color: #2f2f2f;
                            }
                            
                            .feature p {
                              font-size: 14px;
                              line-height: 22px;
                              color: #6a6a6a;
                            }
                            
                            .we-help-section {
                              padding: 7rem 0;
                            }
                            
                            .we-help-section .imgs-grid {
                              display: -ms-grid;
                              display: grid;
                              -ms-grid-columns: (1fr)[27];
                              grid-template-columns: repeat(27, 1fr);
                              position: relative;
                            }
                            
                            .we-help-section .imgs-grid:before {
                              position: absolute;
                              content: "";
                              width: 255px;
                              height: 217px;
                              background-image: url("../images/dots-green.svg");
                              background-size: contain;
                              background-repeat: no-repeat;
                              -webkit-transform: translate(-40%, -40%);
                              -ms-transform: translate(-40%, -40%);
                              transform: translate(-40%, -40%);
                              z-index: -1;
                            }
                            
                            .we-help-section .imgs-grid .grid {
                              position: relative;
                            }
                            
                            .we-help-section .imgs-grid .grid img {
                              border-radius: 20px;
                              max-width: 100%;
                            }
                            
                            .we-help-section .imgs-grid .grid.grid-1 {
                              -ms-grid-column: 1;
                              -ms-grid-column-span: 18;
                              grid-column: 1 / span 18;
                              -ms-grid-row: 1;
                              -ms-grid-row-span: 27;
                              grid-row: 1 / span 27;
                            }
                            
                            .we-help-section .imgs-grid .grid.grid-2 {
                              -ms-grid-column: 19;
                              -ms-grid-column-span: 27;
                              grid-column: 19 / span 27;
                              -ms-grid-row: 1;
                              -ms-grid-row-span: 5;
                              grid-row: 1 / span 5;
                              padding-left: 20px;
                            }
                            
                            .we-help-section .imgs-grid .grid.grid-3 {
                              -ms-grid-column: 14;
                              -ms-grid-column-span: 16;
                              grid-column: 14 / span 16;
                              -ms-grid-row: 6;
                              -ms-grid-row-span: 27;
                              grid-row: 6 / span 27;
                              padding-top: 20px;
                            }
                            
                            .custom-list {
                              width: 100%;
                            }
                            
                            .custom-list li {
                              display: inline-block;
                              width: calc(50% - 20px);
                              margin-bottom: 12px;
                              line-height: 1.5;
                              position: relative;
                              padding-left: 20px;
                            }
                            
                            .custom-list li:before {
                              content: "";
                              width: 8px;
                              height: 8px;
                              border-radius: 50%;
                              border: 2px solid #3b5d50;
                              position: absolute;
                              left: 0;
                              top: 8px;
                            }
                            
                            .popular-product {
                              padding: 0 0 7rem 0;
                            }
                            
                            .popular-product .product-item-sm h3 {
                              font-size: 14px;
                              font-weight: 700;
                              color: #2f2f2f;
                            }
                            
                            .popular-product .product-item-sm a {
                              text-decoration: none;
                              color: #2f2f2f;
                              -webkit-transition: .3s all ease;
                              -o-transition: .3s all ease;
                              transition: .3s all ease;
                            }
                            
                            .popular-product .product-item-sm a:hover {
                              color: rgba(47, 47, 47, 0.5);
                            }
                            
                            .popular-product .product-item-sm p {
                              line-height: 1.4;
                              margin-bottom: 10px;
                              font-size: 14px;
                            }
                            
                            .popular-product .product-item-sm .thumbnail {
                              margin-right: 10px;
                              -webkit-box-flex: 0;
                              -ms-flex: 0 0 120px;
                              flex: 0 0 120px;
                              position: relative;
                            }
                            
                            .popular-product .product-item-sm .thumbnail:before {
                              content: "";
                              position: absolute;
                              border-radius: 20px;
                              background: #dce5e4;
                              width: 98px;
                              height: 98px;
                              top: 50%;
                              left: 50%;
                              -webkit-transform: translate(-50%, -50%);
                              -ms-transform: translate(-50%, -50%);
                              transform: translate(-50%, -50%);
                              z-index: -1;
                            }
                            
                            .testimonial-section {
                              padding: 3rem 0 7rem 0;
                            }
                            
                            .testimonial-slider-wrap {
                              position: relative;
                            }
                            
                            .testimonial-slider-wrap .tns-inner {
                              padding-top: 30px;
                            }
                            
                            .testimonial-slider-wrap .item .testimonial-block blockquote {
                              font-size: 16px;
                            }
                            
                            @media (min-width: 768px) {
                              .testimonial-slider-wrap .item .testimonial-block blockquote {
                                line-height: 32px;
                                font-size: 18px;
                              }
                            }
                            
                            .testimonial-slider-wrap .item .testimonial-block .author-info .author-pic {
                              margin-bottom: 20px;
                            }
                            
                            .testimonial-slider-wrap .item .testimonial-block .author-info .author-pic img {
                              max-width: 80px;
                              border-radius: 50%;
                            }
                            
                            .testimonial-slider-wrap .item .testimonial-block .author-info h3 {
                              font-size: 14px;
                              font-weight: 700;
                              color: #2f2f2f;
                              margin-bottom: 0;
                            }
                            
                            .testimonial-slider-wrap #testimonial-nav {
                              position: absolute;
                              top: 50%;
                              z-index: 99;
                              width: 100%;
                              display: none;
                            }
                            
                            @media (min-width: 768px) {
                              .testimonial-slider-wrap #testimonial-nav {
                                display: block;
                              }
                            }
                            
                            .testimonial-slider-wrap #testimonial-nav>span {
                              cursor: pointer;
                              position: absolute;
                              width: 58px;
                              height: 58px;
                              line-height: 58px;
                              border-radius: 50%;
                              background: rgba(59, 93, 80, 0.1);
                              color: #2f2f2f;
                              -webkit-transition: .3s all ease;
                              -o-transition: .3s all ease;
                              transition: .3s all ease;
                            }
                            
                            .testimonial-slider-wrap #testimonial-nav>span:hover {
                              background: #3b5d50;
                              color: #ffffff;
                            }
                            
                            .testimonial-slider-wrap #testimonial-nav .prev {
                              left: -10px;
                            }
                            
                            .testimonial-slider-wrap #testimonial-nav .next {
                              right: 0;
                            }
                            
                            .testimonial-slider-wrap .tns-nav {
                              position: absolute;
                              bottom: -50px;
                              left: 50%;
                              -webkit-transform: translateX(-50%);
                              -ms-transform: translateX(-50%);
                              transform: translateX(-50%);
                            }
                            
                            .testimonial-slider-wrap .tns-nav button {
                              background: none;
                              border: none;
                              display: inline-block;
                              position: relative;
                              width: 0 !important;
                              height: 7px !important;
                              margin: 2px;
                            }
                            
                            .testimonial-slider-wrap .tns-nav button:active,
                            .testimonial-slider-wrap .tns-nav button:focus,
                            .testimonial-slider-wrap .tns-nav button:hover {
                              outline: none;
                              -webkit-box-shadow: none;
                              box-shadow: none;
                              background: none;
                            }
                            
                            .testimonial-slider-wrap .tns-nav button:before {
                              display: block;
                              width: 7px;
                              height: 7px;
                              left: 0;
                              top: 0;
                              position: absolute;
                              content: "";
                              border-radius: 50%;
                              -webkit-transition: .3s all ease;
                              -o-transition: .3s all ease;
                              transition: .3s all ease;
                              background-color: #d6d6d6;
                            }
                            
                            .testimonial-slider-wrap .tns-nav button:hover:before,
                            .testimonial-slider-wrap .tns-nav button.tns-nav-active:before {
                              background-color: #3b5d50;
                            }
                            
                            .before-footer-section {
                              padding: 0rem 0 12rem 0 !important;
                            }
                            
                            .blog-section {
                              padding: 7rem 0 12rem 0;
                            }
                            
                            .blog-section .post-entry a {
                              text-decoration: none;
                            }
                            
                            .blog-section .post-entry .post-thumbnail {
                              display: block;
                              margin-bottom: 20px;
                            }
                            
                            .blog-section .post-entry .post-thumbnail img {
                              border-radius: 20px;
                              -webkit-transition: .3s all ease;
                              -o-transition: .3s all ease;
                              transition: .3s all ease;
                            }
                            
                            .blog-section .post-entry .post-content-entry {
                              padding-left: 15px;
                              padding-right: 15px;
                            }
                            
                            .blog-section .post-entry .post-content-entry h3 {
                              font-size: 16px;
                              margin-bottom: 0;
                              font-weight: 600;
                              margin-bottom: 7px;
                            }
                            
                            .blog-section .post-entry .post-content-entry .meta {
                              font-size: 14px;
                            }
                            
                            .blog-section .post-entry .post-content-entry .meta a {
                              font-weight: 600;
                            }
                            
                            .blog-section .post-entry:hover .post-thumbnail img,
                            .blog-section .post-entry:focus .post-thumbnail img {
                              opacity: .7;
                            }
                            
                            .footer-section {
                              padding: 80px 0;
                              background: #ffffff;
                            }
                            
                            .footer-section .relative {
                              position: relative;
                            }
                            
                            .footer-section a {
                              text-decoration: none;
                              color: #2f2f2f;
                              -webkit-transition: .3s all ease;
                              -o-transition: .3s all ease;
                              transition: .3s all ease;
                            }
                            
                            .footer-section a:hover {
                              color: rgba(47, 47, 47, 0.5);
                            }
                            
                            .footer-section .subscription-form {
                              margin-bottom: 40px;
                              position: relative;
                              z-index: 2;
                              margin-top: 100px;
                            }
                            
                            @media (min-width: 992px) {
                              .footer-section .subscription-form {
                                margin-top: 0px;
                                margin-bottom: 80px;
                              }
                            }
                            
                            .footer-section .subscription-form h3 {
                              font-size: 18px;
                              font-weight: 500;
                              color: #3b5d50;
                            }
                            
                            .footer-section .subscription-form .form-control {
                              height: 50px;
                              border-radius: 10px;
                              font-family: "Inter", sans-serif;
                            }
                            
                            .footer-section .subscription-form .form-control:active,
                            .footer-section .subscription-form .form-control:focus {
                              outline: none;
                              -webkit-box-shadow: none;
                              box-shadow: none;
                              border-color: #3b5d50;
                              -webkit-box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.2);
                              box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.2);
                            }
                            
                            .footer-section .subscription-form .form-control::-webkit-input-placeholder {
                              font-size: 14px;
                            }
                            
                            .footer-section .subscription-form .form-control::-moz-placeholder {
                              font-size: 14px;
                            }
                            
                            .footer-section .subscription-form .form-control:-ms-input-placeholder {
                              font-size: 14px;
                            }
                            
                            .footer-section .subscription-form .form-control:-moz-placeholder {
                              font-size: 14px;
                            }
                            
                            .footer-section .subscription-form .btn {
                              border-radius: 10px !important;
                            }
                            
                            .footer-section .sofa-img {
                              position: absolute;
                              top: -200px;
                              z-index: 1;
                              right: 0;
                            }
                            
                            .footer-section .sofa-img img {
                              max-width: 190px;
                              margin-top: 17px;
                            }
                            
                            .footer-section .links-wrap {
                              margin-top: 0px;
                            }
                            
                            @media (min-width: 992px) {
                              .footer-section .links-wrap {
                                margin-top: 54px;
                              }
                            }
                            
                            .footer-section .links-wrap ul li {
                              margin-bottom: 10px;
                            }
                            
                            .footer-section .footer-logo-wrap .footer-logo {
                              font-size: 32px;
                              font-weight: 500;
                              text-decoration: none;
                              color: #3b5d50;
                            }
                            
                            .footer-section .custom-social li {
                              margin: 2px;
                              display: inline-block;
                            }
                            
                            .footer-section .custom-social li a {
                              width: 40px;
                              height: 40px;
                              text-align: center;
                              line-height: 40px;
                              display: inline-block;
                              background: #dce5e4;
                              color: #3b5d50;
                              border-radius: 50%;
                            }
                            
                            .footer-section .custom-social li a:hover {
                              background: #3b5d50;
                              color: #ffffff;
                            }
                            
                            .footer-section .border-top {
                              border-color: #dce5e4;
                            }
                            
                            .footer-section .border-top.copyright {
                              font-size: 14px !important;
                            }
                            
                            .untree_co-section {
                              padding: 7rem 0;
                            }
                            
                            .form-control {
                              height: 50px;
                              border-radius: 10px;
                              font-family: "Inter", sans-serif;
                            }
                            
                            .form-control:active,
                            .form-control:focus {
                              outline: none;
                              -webkit-box-shadow: none;
                              box-shadow: none;
                              border-color: #3b5d50;
                              -webkit-box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.2);
                              box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.2);
                            }
                            
                            .form-control::-webkit-input-placeholder {
                              font-size: 14px;
                            }
                            
                            .form-control::-moz-placeholder {
                              font-size: 14px;
                            }
                            
                            .form-control:-ms-input-placeholder {
                              font-size: 14px;
                            }
                            
                            .form-control:-moz-placeholder {
                              font-size: 14px;
                            }
                            
                            .service {
                              line-height: 1.5;
                            }
                            
                            .service .service-icon {
                              border-radius: 10px;
                              -webkit-box-flex: 0;
                              -ms-flex: 0 0 50px;
                              flex: 0 0 50px;
                              height: 50px;
                              line-height: 50px;
                              text-align: center;
                              background: #3b5d50;
                              margin-right: 20px;
                              color: #ffffff;
                            }
                            
                            textarea {
                              height: auto !important;
                            }
                            
                            .site-blocks-table {
                              overflow: auto;
                            }
                            
                            .site-blocks-table .product-thumbnail {
                              width: 200px;
                            }
                            
                            .site-blocks-table .btn {
                              padding: 2px 10px;
                            }
                            
                            .site-blocks-table thead th {
                              padding: 30px;
                              text-align: center;
                              border-width: 0px !important;
                              vertical-align: middle;
                              color: rgba(0, 0, 0, 0.8);
                              font-size: 18px;
                            }
                            
                            .site-blocks-table td {
                              padding: 20px;
                              text-align: center;
                              vertical-align: middle;
                              color: rgba(0, 0, 0, 0.8);
                            }
                            
                            .site-blocks-table tbody tr:first-child td {
                              border-top: 1px solid #3b5d50 !important;
                            }
                            
                            .site-blocks-table .btn {
                              background: none !important;
                              color: #000000;
                              border: none;
                              height: auto !important;
                            }
                            
                            .site-block-order-table th {
                              border-top: none !important;
                              border-bottom-width: 1px !important;
                            }
                            
                            .site-block-order-table td,
                            .site-block-order-table th {
                              color: #000000;
                            }
                            
                            .couponcode-wrap input {
                              border-radius: 10px !important;
                            }
                            
                            .text-primary {
                              color: #3b5d50 !important;
                            }
                            
                            .thankyou-icon {
                              position: relative;
                              color: #3b5d50;
                            }
                            
                            .thankyou-icon:before {
                              position: absolute;
                              content: "";
                              width: 50px;
                              height: 50px;
                              border-radius: 50%;
                              background: rgba(59, 93, 80, 0.2);
                            }
                            
                            .item-thumbnail-size {
                              height: 317px;
                              width: 210px;
                            }
                            
                            .item-title {
                              font-size: 24px !important;
                              color: #ff9494 !important;
                            }
                            
                            .item-price {
                              font-size: 18px !important;
                              color: #77cadf !important;
                            }
                            
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
                              color: #ff3838;
                              margin-bottom: 20px;
                            }
                            
                            .product-description {
                              margin-bottom: 30px;
                            }
                            
                            .product-price {
                              font-size: 16px;
                              font-weight: bold;
                              color: #4d82ff;
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
                              width: auto;
                              height: 600px;
                            }
                            
                            .product-detail-main-img {
                              text-align: center;
                            }
                            
                            .img-wrap img:hover {
                              transform: scale(1.1);
                              transition: transform 0.3s ease-in-out;
                            }',
                            'data' => '',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                    ]);
                }

    



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }

};