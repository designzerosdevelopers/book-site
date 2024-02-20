<!-- /*
* Bootstrap 5
* Template Name: Furni
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
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


		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
