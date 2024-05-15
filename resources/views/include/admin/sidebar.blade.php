

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
        <a class="nav-link" data-bs-toggle="collapse" href="#general-settings" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">General Settings</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="general-settings">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('edit.navbar') }}">NavBar</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('edit.footer') }}">Footer</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('edit.item.design') }}">Item Design</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('edit.theme') }}">Theme settings</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#pages-settings" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">Pages</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="pages-settings">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('edit.home') }}">Home</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('edit.about') }}">About Us</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('edit.contact') }}">Contact</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('edit.shop') }}">Shop</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('edit.product.detail') }}">Product detail</a></li>
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


  