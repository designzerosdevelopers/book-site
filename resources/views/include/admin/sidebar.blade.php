

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
   @if(Auth::user()->role == 1)
      <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard')}}">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">Page Edits</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('indexhome') }}">Home</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('about.edit') }}">About Us</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('contact.edit') }}">Contact</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('edit.manu') }}">Manu</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('footer') }}">Footer</a></li>
            {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('product.index') }}">Product</a></li> --}}
            <li class="nav-item"> <a class="nav-link" href="{{ route('shop.index') }}">Shop</a></li> 
            <li class="nav-item"> <a class="nav-link" href="{{ route('update.page') }}">Navbar</a></li> 
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('indexitem') }}">
          <span class="menu-title">Items</span>
          <i class="mdi mdi-package-variant menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('indexcategories') }}">
          <span class="menu-title">Categories</span>
          <i class="mdi mdi-view-module  menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('csv.import') }}">
          <span class="menu-title">Import & Export CSV </span>
          <i class="mdi mdi-package  menu-icon"></i>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('uploads.index') }}">
          <span class="menu-title">Uploads</span>
          <i class="mdi mdi-upload  menu-icon"></i>
        </a>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" href="{{ route('settings.index') }}">
          <span class="menu-title">Settings</span>
          <i class="mdi mdi-settings menu-icon"></i>
        </a>
      </li>
    @else
    <li class="nav-item">
      <a class="nav-link" href="{{ route('purchases.index') }}">
        <span class="menu-title">Purchase</span>
        <i class="mdi mdi-download menu-icon"></i>
      </a>
    </li>
    @endif

    </ul>
  </nav>


  