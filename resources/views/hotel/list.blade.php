@extends('layouts.hotelmaster')
@section('title', config('app.name'))

    @section('content')
    <main>
		<section class="hero_in hotels">
			<div class="wrapper">
				<div class="container">
					@if($hotels)
						<h1 class="fadeInUp"><span></span>Hotels</h1>
					@else
						<h1 class="fadeInUp"><span></span>No Hotels Found :(</h1>
					@endif
				</div>
			</div>
		</section>
		<!--/hero_in-->
		
		<!-- If Hotels are present -->
		@if($hotels)
			<div class="filters_listing sticky_horizontal">
				<div class="container">
					<ul class="clearfix">
						<li>
							<div class="switch-field">
								<input type="radio" id="all" name="listing_filter" value="all" checked data-filter="*" class="selected">
								<label for="all">All</label>
								<input type="radio" id="popular" name="listing_filter" value="popular" data-filter=".popular">
								<label for="popular">Popular</label>
								<input type="radio" id="latest" name="listing_filter" value="latest" data-filter=".latest">
								<label for="latest">Latest</label>
							</div>
						</li>
					</ul>
				</div>
				<!-- /container -->
			</div>
			
			<!-- /filters -->
			
			<div class="collapse" id="collapseMap">
				<div id="map" class="map"></div>
			</div>
			<!-- End Map -->

			<div class="container margin_60_35">
				<div class="row">
					<aside class="col-lg-3" id="sidebar">
						<div id="filters_col">
							<a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters </a>
							<div class="collapse show" id="collapseFilters">
								
								<form action="{{route('hotel-list')}}" id="filter_hotels" method="GET" autocomplete="off" >
									<div class="filter_type" id="cities">
										<h6><strong>Cities</strong></h6>
										<ul>
											@foreach($cities as $city)
												@php
													$checked = '';
												@endphp
												
												@if(isset($city_id))
													@for($i=0;$i< sizeof($city_id);$i++)
														@if($city_id[$i] == $city['id'])
															@php
																$checked = 'checked';
															@endphp
														@endif	
													@endfor
												@endif

												<li>
													<label class="container_check" >{{$city['name']}} <small>({{$city['no_of_hotels']}})</small>
														<input type="checkbox" name="city[]" value="{{$city['id']}}" {{$checked}} >
														<span class="checkmark"></span>
													</label>
												</li>
											@endforeach
										</ul>
									</div>
									<div class="filter_type">
										<div>
											<h6><strong>Dates</strong></h6>
											@if(isset($dates))
												<input class="form-control" type="text" name="dates" id="dates" placeholder="When.." value="{{$dates}}">
											@else
												<input class="form-control" type="text" name="dates" id="dates" placeholder="When.." value="">
											@endif
										</div>
											
									</div>
									<div class="filter_type">
										<div>
											<h6><strong>Guests </strong><span class="qtyTotal">1</span></h6>
											<!-- <div class="panel-dropdown-content"> -->
												<!-- Quantity Buttons -->
												<div class="qtyButtons">
													<label>Adults</label>
													@if(isset($adult))
														<input type="text" name="qtyInput[]" value="{{$adult}}">
													@else
														<input type="text" name="qtyInput[]" value="1">
													@endif
												</div>
											<!-- </div> -->
										</div>
									</div>
									<input type="submit" class="btn_search" value="Apply Filter"><br>  
								</form>
							</div>
							<!--/collapse -->
						</div>
						<!--/filters col-->
					</aside>
					<!-- /aside -->

					<div class="col-lg-9">
						<div class="isotope-wrapper">
							<div class="row">
								@foreach($hotels as $hotel)
									<div class="col-md-6 isotope-item popular">
										<div class="box_grid">
											<figure>
												<a href="#0" class="wish_bt"></a>
												<a href="hotel/{{$hotel['slug']}}/{{ Request::input('dates')}}"><img src="{{asset('img/hotel_1.jpg')}}" class="img-fluid" alt="" width="800" height="533"><div class="read_more"><span>Read more</span></div></a>
												<small>{{$hotel->city->name}}</small>
											</figure>
											<div class="wrapper">
												<div class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></div>
												<h3><a href="hotel-detail.html">{{$hotel['name']}}</a></h3>
												<p>{{$hotel['description']}}</p>
												<span class="price">Price <strong>{{$hotel->country->currency_symbol}} 88</strong></span>
											</div>
										</div>
									</div>
								@endforeach
							</div>
							<div class="row">
								<div class="col-8"></div>
								<div class="col-4">
									@if($data)
										<span >{{ $hotels->appends($data)->links() }}</span>
									@else
										<span >{{ $hotels->links() }}</span>
									@endif
								</div>
                			</div>
						</div>
					</div>
					<!-- /isotope-wrapper -->
					</div>
					<!-- /col -->
				</div>		
			</div>
			<!-- /container -->
			
			<div class="bg_color_1">
				<div class="container margin_60_35">
					<div class="row">
						<div class="col-md-4">
							<a href="#0" class="boxed_list">
								<i class="pe-7s-help2"></i>
								<h4>Need Help? Contact us</h4>
								<p>Cum appareat maiestatis interpretaris et, et sit.</p>
							</a>
						</div>
						<div class="col-md-4">
							<a href="#0" class="boxed_list">
								<i class="pe-7s-wallet"></i>
								<h4>Payments</h4>
								<p>Qui ea nemore eruditi, magna prima possit eu mei.</p>
							</a>
						</div>
						<div class="col-md-4">
							<a href="#0" class="boxed_list">
								<i class="pe-7s-note2"></i>
								<h4>Cancel Policy</h4>
								<p>Hinc vituperata sed ut, pro laudem nonumes ex.</p>
							</a>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bg_color_1 -->
		@endif
	</main>
	<!--/main-->
    @endsection

	@push('list.blade-scripts')
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
		  $(this).val(picker.startDate.format('MM-DD-YY') + ' > ' + picker.endDate.format('MM-DD-YY'));
	  });
	  $('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
		  $(this).val('');
	  });

	  $("#filter_hotels").validate({
		rules: {
			"city[]": {
                required: true
            },
			dates: "required",
		},
		messages: {
			'city[]': "Choose City",
			dates: "Choose Dates",
		}
	}); 

	});
	</script>
	@endpush






