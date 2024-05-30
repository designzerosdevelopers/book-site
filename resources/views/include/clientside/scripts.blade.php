
<!-- plugins:js -->
<script src="{{asset('admin/vendors/js-css-other/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{asset('admin/vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('admin/js-css-other/jquery.cookie.js')}}" type="text/javascript"></script>
<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="{{asset('admin/js-css-other/off-canvas.js')}}"></script>
<script src="{{asset('admin/js-css-other/hoverable-collapse.js')}}"></script>
<script src="{{asset('admin/js-css-other/misc.js')}}"></script>
<!-- endinject -->

<!-- Custom js for this page -->
<script src="{{asset('admin/js-css-other/dashboard.js')}}"></script>
<script src="{{asset('admin/js-css-other/todolist.js')}}"></script>

{{-- @foreach(\App\Helpers\SiteviewHelper::customCode('Stylesheet','For Footer Section') as $links)
<link href="{{asset($links->link)}}" rel="stylesheet">
@endforeach
@foreach(\App\Helpers\SiteviewHelper::customCode('JavaScript','For Footer Section') as $links)
<link href="{{asset($links->link)}}" rel="stylesheet">
@endforeach --}}