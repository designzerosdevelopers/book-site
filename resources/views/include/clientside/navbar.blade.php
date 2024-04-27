<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">Digital store<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

      

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
               {!! App\Helpers\SiteviewHelper::navbar() !!}
                {{-- <li class="nav-item {{ request()->routeIs('index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('index') }}">Home</a>
                </li> --}}
                {{-- <li class="nav-item {{ request()->routeIs('shop') ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('shop') }}">Shop</a>
                </li>
                <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('about') }}">About us</a>
                </li>
                <li class="nav-item {{ request()->routeIs('blog') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('blog') }}">Blog</a>
                </li>
                <li class="nav-item {{ request()->routeIs('conteact') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('contact') }}">Contact us</a>
                </li> --}}
            </ul>
            
            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
 
                
                <li class="search-item">
                    <a class="nav-link" href="#" id="searchIcon">
                        <img src="clientside/images/search.svg" alt="Search">
                    </a>
                </li>
               


                <li><a class="nav-link" href="{{ route('login') }}"><img src="clientside/images/user.svg"></a></li>
                <li class="cart-item">
                    <a class="nav-link" href="{{ route('cart') }}">
                        <img src="{{ asset('clientside/images/cart.svg')}}" alt="Cart">
                        <span class="cart-count-container" style="opacity:0;">
                            <span class="cart-count" id="cartItemCount">0</span>
                        </span>
                    </a>
                </li>
                
            </ul>
           
            <div class="modal" id="searchModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title">Search</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <form id="searchForm">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                                </div>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
         
        

            
        </div>
    </div>
</nav>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the modal
        var modal = document.getElementById('searchModal');

        // Get the search icon
        var searchIcon = document.getElementById("searchIcon");

        // Get the close button
        var closeButton = document.querySelector("#searchModal .btn-close");

        // Get the search form
        var searchForm = document.getElementById("searchForm");

        // When the user clicks on the search icon, open the modal
        searchIcon.onclick = function() {
            modal.style.display = "block";
        }

        // When the user submits the search form, handle the search
        searchForm.onsubmit = function(event) {
            event.preventDefault(); // Prevent form submission
            
            // Get the search input value
            var searchQuery = document.getElementById("searchInput").value;

           // Check if the current URL is not '/shop' redirect to shop for search query
            if (window.location.pathname !== '/shop') {
                window.location.href = '/shop?search=' + searchQuery;
            }
             // Check if the current URL is '/shop' redirect to shop for search query
            if (window.location.pathname == '/shop') {
                window.location.href = '/shop?search=' + searchQuery;
            }

            // Close the modal
            modal.style.display = "none";
        }

        // When the user clicks the close button, close the modal
        closeButton.onclick = function() {
            modal.style.display = "none";
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });

   




</script>
