<!doctype html>
<html lang="en">
@include('include.clientside.head')
	<body>

		<!-- Start Header/Navigation -->
		@include('include.clientside.navbar')
		<!-- End Header/Navigation -->

		@yield('content')

		<!-- Start Footer Section -->
		@include('include.clientside.footer')
		<!-- End Footer Section -->	


		<script src="{{asset('clientside/js/bootstrap.bundle.min.js')}}"></script>
		<script src="{{asset('clientside/js/tiny-slider.js')}}"></script>
		<script src="{{asset('clientside/js/custom.js')}}"></script>
		<script src="{{asset('clientside/js/checkout.js')}}"></script>
	</body>

</html>
