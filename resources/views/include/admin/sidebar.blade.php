<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      {{-- <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="nav-profile-image">
            <img src="{{asset('admin/js/todolist.js')}}images/faces/face1.jpg" alt="profile">
            <span class="login-status online"></span>
          </div>
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">David Grey. H</span>
            <span class="text-secondary text-small">Project Manager</span>
          </div>
          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" href="dashboard">
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
            {{-- <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Shop</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">About</a></li> --}}
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('indexitem') }}">
          <span class="menu-title">Items</span>
          <i class="mdi mdi-format-list-numbered menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('indexcategories') }}">
          <span class="menu-title">Categories</span>
          <i class="fa-light "></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('csv.import') }}">
          <span class="menu-title">Import & Export CSV </span>
          <i class="fa-light"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">
          <span class="menu-title">Uploads</span>
          <i class="fa-light"></i>
        </a>
      </li>
    </ul>
  </nav>