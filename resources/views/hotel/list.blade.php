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
								
								<form action="{{route('get-hotels')}}" id="search_hotels" method="GET" autocomplete="off" >
									@csrf
									<div class="filter_type" id="cities">
										<h6>Cities</h6>
										<ul>
											@foreach($cities as $city)
												@if($city['no_of_hotels'] > 0)
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
															<input type="checkbox" name="city[]" id="city" value="{{$city['id']}}" {{$checked}} >
															<span class="checkmark"></span>
														</label>
													</li>
												@endif
											@endforeach
										</ul>
									</div>
									<div class="filter_type">
										<h6>Distance</h6>
										<input type="text" id="range" name="range" value="">
									</div>
									<div class="filter_type">
										<h6>Star Category</h6>
										<ul>
											<li>
												<label class="container_check"><span class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></span> <small>(25)</small>
													<input type="checkbox" name="star">
													<span class="checkmark"></span>
												</label>
											</li>
											<li>
												<label class="container_check"><span class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></span> <small>(26)</small>
													<input type="checkbox" name="star">
													<span class="checkmark"></span>
												</label>
											</li>
											<li>
												<label class="container_check"><span class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></span> <small>(25)</small>
													<input type="checkbox" name="star">
													<span class="checkmark"></span>
												</label>
											</li>
										</ul>
									</div>
									<div class="filter_type">
										<h6>Rating</h6>
										<ul>
											<li>
												<label class="container_check">Superb 9+ <small>(25)</small>
													<input type="checkbox" name="rate">
													<span class="checkmark"></span>
												</label>
											</li>
											<li>
												<label class="container_check">Very Good 8+ <small>(26)</small>
													<input type="checkbox" name="rate">
													<span class="checkmark"></span>
												</label>
											</li>
											<li>
												<label class="container_check">Good 7+ <small>(25)</small>
													<input type="checkbox" name="rate">
													<span class="checkmark"></span>
												</label>
											</li>
											<li>
												<label class="container_check">Pleasant 6+ <small>(12)</small>
													<input type="checkbox">
													<span class="checkmark"></span>
												</label>
											</li>
										</ul>
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
												<a href="hotel/{{$hotel['slug']}}"><img src="{{asset('img/hotel_1.jpg')}}" class="img-fluid" alt="" width="800" height="533"><div class="read_more"><span>Read more</span></div></a>
												<small>{{$hotel->city->name}}</small>
											</figure>
											<div class="wrapper">
												<div class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></div>
												<h3><a href="hotel-detail.html">{{$hotel['name']}}</a></h3>
												<p>{{$hotel['description']}}</p>
												<span class="price">From <strong>$54</strong> /per person</span>
											</div>
										</div>
									</div>
								@endforeach
								<!-- /box_grid -->
								
								<!-- /box_grid -->
							</div>
							<!-- /row -->
					</div>
					<!-- /isotope-wrapper -->
				
					<p class="text-center"><a href="#0" class="btn_1 rounded add_top_30">Load more</a></p>
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






