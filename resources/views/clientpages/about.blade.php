@extends('layouts.clientside-layout.app')

@section('content')
	{!! App\Helpers\SiteviewHelper::page('about')->allhtml !!}
@stop
{{-- @extends('layouts.clientside-layout.app')
@section('content')

<!-- Start Hero Section -->
<div class="hero">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-5">
				<div class="intro-excerpt">
					<h1>{{ $data['about_hs_title'] }}</h1>
					<p class="mb-4">{{ $data['about_hs_description'] }}</p>
					<p><a href="{{ $data['button_1_url'] }}" class="btn btn-secondary me-2">{{ $data['button_1_name'] }}</a><a href="{{ $data['button_2_url'] }}" class="btn btn-white-outline">{{ $data['button_2_name'] }}</a></p>
				</div>
			</div>
			<div class="col-lg-7">
				<div class="hero-img-wrap">
					<img src="{{asset('clientside/images/'.$data['about_hs_image'])}}" class="img-fluid" width="50%">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Hero Section -->


<!-- Start Why Choose Us Section -->
<div class="why-choose-section">
	<div class="container">
		<div class="row justify-content-between align-items-center">
			<div class="col-lg-6">
				<h2 class="section-title">{{ $data['wcu_title'] }}</h2>
				<p>{{ $data['wcu_description'] }}</p>
				<div class="row my-5">
					<div class="col-6 col-md-6">
						<div class="feature">
							<div class="icon">
								<img src="{{asset('clientside/images/truck.svg')}}" alt="Image" class="imf-fluid">
							</div>
							<h3>{{ $pages['wcu_feature_1_title'] }}</h3>
							<p>{{ $pages['wcu_feature_1_description'] }}</p>
						</div>
					</div>

					<div class="col-6 col-md-6">
						<div class="feature">
							<div class="icon">
								<img src="{{asset('clientside/images/bag.svg')}}" alt="Image" class="imf-fluid">
							</div>
							<h3>{{ $pages['wcu_feature_2_title'] }}</h3>
							<p>{{ $pages['wcu_feature_2_description'] }}</p>
						</div>
					</div>

					<div class="col-6 col-md-6">
						<div class="feature">
							<div class="icon">
								<img src="{{asset('clientside/images/support.svg')}}" alt="Image" class="imf-fluid">
							</div>
							<h3>{{ $pages['wcu_feature_3_title'] }}</h3>
							<p>{{ $pages['wcu_feature_3_description'] }}</p>
						</div>
					</div>

					<div class="col-6 col-md-6">
						<div class="feature">
							<div class="icon">
								<img src="{{asset('clientside/images/return.svg')}}" alt="Image" class="imf-fluid">
							</div>
							<h3>{{ $pages['wcu_feature_4_title'] }}</h3>
							<p>{{ $pages['wcu_feature_4_description'] }}</p>
						</div>
					</div>

				</div>
			</div>
			<div class="col-lg-5">
				<div class="img-wrap">
					<img src="{{asset('clientside/images/'.$pages['home_wcu_image'])}}" alt="Image" class="img-fluid">
				</div>
			</div>

		</div>
	</div>
</div>
<!-- End Why Choose Us Section --> --}}

		{{-- <!-- Start Team Section -->
		<div class="untree_co-section">
			<div class="container">

				<div class="row mb-5">
					<div class="col-lg-5 mx-auto text-center">
						<h2 class="section-title">Our Team</h2>
					</div>
				</div>

				<div class="row">

					<!-- Start Column 1 -->
					<div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
						<img src="images/person_1.jpg" class="img-fluid mb-5">
						<h3 clas><a href="#"><span class="">Lawson</span> Arnold</a></h3>
            <span class="d-block position mb-4">CEO, Founder, Atty.</span>
            <p>Separated they live in.
            Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            <p class="mb-0"><a href="#" class="more dark">Learn More <span class="icon-arrow_forward"></span></a></p>
					</div> 
					<!-- End Column 1 -->

					<!-- Start Column 2 -->
					<div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
						<img src="images/person_2.jpg" class="img-fluid mb-5">

						<h3 clas><a href="#"><span class="">Jeremy</span> Walker</a></h3>
            <span class="d-block position mb-4">CEO, Founder, Atty.</span>
            <p>Separated they live in.
            Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            <p class="mb-0"><a href="#" class="more dark">Learn More <span class="icon-arrow_forward"></span></a></p>

					</div> 
					<!-- End Column 2 -->

					<!-- Start Column 3 -->
					<div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
						<img src="images/person_3.jpg" class="img-fluid mb-5">
						<h3 clas><a href="#"><span class="">Patrik</span> White</a></h3>
            <span class="d-block position mb-4">CEO, Founder, Atty.</span>
            <p>Separated they live in.
            Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            <p class="mb-0"><a href="#" class="more dark">Learn More <span class="icon-arrow_forward"></span></a></p>
					</div> 
					<!-- End Column 3 -->

					<!-- Start Column 4 -->
					<div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
						<img src="images/person_4.jpg" class="img-fluid mb-5">

						<h3 clas><a href="#"><span class="">Kathryn</span> Ryan</a></h3>
            <span class="d-block position mb-4">CEO, Founder, Atty.</span>
            <p>Separated they live in.
            Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            <p class="mb-0"><a href="#" class="more dark">Learn More <span class="icon-arrow_forward"></span></a></p>

          
					</div> 
					<!-- End Column 4 -->

					

				</div>
			</div>
		</div>
		<!-- End Team Section --> --}}

		
	

