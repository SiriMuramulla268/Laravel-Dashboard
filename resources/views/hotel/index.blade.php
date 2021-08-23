@extends('layouts.hotelmaster')
@section('title', config('app.name'))
@section('content')

	<main>
		<section class="hero_single version_2">
			<div class="wrapper">
				<div class="container">
					<h3>Book unique experiences</h3>
					<p>Expolore top rated hotels around the world</p>
					<form action="{{route('hotel-list')}}" id="search_hotels" method="GET" autocomplete="off" >
						<div class="row no-gutters custom-search-input-2">
							<div class="col-lg-4">
								<div class="form-group">
									<select class="form-select" name="city[]"  >
										@if($city_details)
											<option value=""> Choose Location </option>
											@foreach ($city_details as $city)
												<option value="{{$city['id']}}">{{$city['name']}}</option>
											@endforeach
										@else
											<option value=""> No Cities </option>
										@endif
									</select>
									<i class="icon_pin_alt"></i>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<input class="form-control" type="text" name="dates" placeholder="When..">
									<i class="icon_calendar"></i>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="panel-dropdown">
									<a href="#">Guests <span class="qtyTotal">1</span></a>
									<div class="panel-dropdown-content">
										<!-- Quantity Buttons -->
										<div class="qtyButtons">
											<label>Adults</label>
											<input type="text" name="qtyInput" value="1">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<input type="submit" class="btn_search" value="Search">
							</div>
						</div>
						<!-- /row -->
					</form>
				</div>
			</div>
		</section>
		<!-- /hero_single -->

		<div class="container container-custom margin_80_0">
			@if($hotel_details)
			<div class="main_title_2">
				<span><em></em></span>
				<h2>Popular Hotels and Accommodations</h2>
				<p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
			</div>
			<div id="reccomended" class="owl-carousel owl-theme">
				@foreach($hotel_details as $hotel)
				<div class="item">
					<div class="box_grid">
						<figure>
							<a href="#0" class="wish_bt"></a>
							<a href="hotel/{{$hotel['slug']}}"><img src="{{asset('img/hotel_1.jpg')}}" class="img-fluid" alt="" alt="" >
							<div class="read_more"><span>Read more</span></div></a>
							<small class="score"><strong>8.9</strong></small>
						</figure>
						<div class="wrapper">
							<div class="cat_star">
								<i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
							</div>
							
							<h3>{{$hotel['name']}}</h3>
							<p>{{$hotel['description']}}</p>
							<span class="price">From <strong>$54</strong> /per person</span>
						</div>
					</div>
				</div>
				@endforeach
				<!-- /item -->
				
			</div>
			<!-- /carousel -->
			<p class="btn_home_align"><a href="/hotels" class="btn_1 rounded">View all Hotels</a></p>
			@else
			<div class="main_title_2">
				<span><em></em></span>
				<h2>No Hotels Found :(</h2>
			</div>
			@endif
			<hr class="large">
		</div>
		<!-- /container -->
		

		<div class="call_section">
			<div class="container clearfix">
				<div class="col-lg-5 col-md-6 float-right wow" data-wow-offset="250">
					<div class="block-reveal">
						<div class="block-vertical"></div>
						<div class="box_1">
							<h3>Enjoy a GREAT travel with us</h3>
							<p>Ius cu tamquam persequeris, eu veniam apeirian platonem qui, id aliquip voluptatibus pri. Ei mea primis ornatus disputationi. Menandri erroribus cu per, duo solet congue ut. </p>
							<a href="#0" class="btn_1 rounded">Read more</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/call_section-->
	</main>
	<!-- /main -->
@endsection

@push('index.blade-scripts')
<!-- DATEPICKER  -->
<script>
	$(function() {
	  'use strict';
	  $('input[name="dates"]').daterangepicker({
		  autoUpdateInput: false,
		  minDate:new Date(),
		  locale: {
			  cancelLabel: 'Clear'
		  }
	  });
	  $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
		  $(this).val(picker.startDate.format('MM-DD-YYYY') + ' > ' + picker.endDate.format('MM-DD-YYYY'));
	  });
	  $('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
		  $(this).val('');
	  });
	});

	$("#search_hotels").validate({
		rules: {
			'city[]': "allRequired",
			dates: "required",
		},
		messages: {
			'city[]': "Choose City",
			dates: "Choose Dates",
		}
	}); 
	</script>
@endpush




