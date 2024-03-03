<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('admin/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/css/vendor.bundle.base.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('admin/images/favicon.ico')}}" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
        @include('include.admin.navbar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
         @include('include.admin.sidebar')
        <!-- partial -->
        <div class="main-panel">
         @yield('content')
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
           @include('include.admin.footer')
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    
    <script src="{{ asset('admin/ckeditor5/ckeditor.js') }}"></script>
    <script src="{{asset('admin/js/ck.js')}}"></script>
    <!-- plugins:js -->
    <script src="{{asset('admin/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('admin/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admin/js/jquery.cookie.js')}}" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('admin/js/off-canvas.js')}}"></script>
    <script src="{{asset('admin/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('admin/js/misc.js')}}"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="{{asset('admin/js/dashboard.js')}}"></script>
    <script src="{{asset('admin/js/todolist.js')}}"></script>
    <!-- End custom js for this page -->

    
  </body>
</html>