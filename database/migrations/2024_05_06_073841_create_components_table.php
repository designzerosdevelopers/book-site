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
                                            <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
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