@extends('layouts.hotelmaster')
@section('title', config('app.name'))

    @section('content')
    <main>
		<section class="hero_in hotels_detail">
			<div class="wrapper">
				<div class="container">
					@if($hotel_detail)
					<h1 class="fadeInUp"><span></span>{{ $hotel_detail->name }}</h1>
					@else
					<h1 class="fadeInUp"><span></span>Hotel Not Found :(</h1>
					@endif
				</div>
			</div>
		</section>
		<!--/hero_in-->

		@if($hotel_detail)
		<div class="bg_color_1">
			<nav class="secondary_nav sticky_horizontal">
				<div class="container">
					<ul class="clearfix">
						<li><a href="#description" class="active">Description</a></li>
						<li><a href="#reviews">Reviews</a></li>
						<li><a href="#sidebar">Booking</a></li>
					</ul>
				</div>
			</nav>
			
			<div class="container margin_60_35">
				<div class="row">
					<div class="col-lg-8">
						<section id="description">
							<h2>Description</h2>
							<p>{{ $hotel_detail->description }}</p>
							<!-- /row -->
							<hr>
							
							@foreach($room_detail->sortBy('price') as $room)
							<div class="room_type first">
								<div class="row">
									<div class="col-md-4">
										<img src="{{asset('img/gallery/hotel_list_1.jpg')}}" class="img-fluid" alt="">
									</div>
									<div class="col-md-8">
										<h4>{{$room['type']}} </h4> <span><strong>{{$room['price']}}{{$hotel_detail->country->currency_symbol}} </strong></span>
										<p>Sit an meis aliquam, cetero inermis vel ut. An sit illum euismod facilisis, tamquam vulputate pertinacia eum at.</p>

										<ul class="hotel_facilities">
										@foreach($room->amenities as $room_amenity)
											<li><img src="{{asset('img/hotel_facilites_icon_2.svg')}}" alt="">{{$room_amenity['name']}}</li>
										@endforeach	
										</ul>
									</div>
								</div>
								<!-- /row -->
							</div>
							@endforeach
							<!-- End Map -->
						</section>
						<!-- /section -->
					</div>
					<!-- /col -->
					
					<aside class="col-lg-4" id="sidebar">
						<div class="box_detail booking">
							<form id="purchase" action="{{route('cart-1')}}" method="get" autocomplete="off">
							@csrf
								<div class="price">
									<span id="price">1578</span>
									<input type="hidden" id="room_price" name="room_price"/>
									<span>{{$hotel_detail->country->currency_symbol}} </span> <small>per room</small>
									<div class="score"><span>Good<em>350 Reviews</em></span><strong>7.0</strong></div>
								</div>

								<div class="form-group input-dates">
									<input class="form-control" type="text" name="dates" autocomplete="off" placeholder="When..">
									<i class="icon_calendar"></i>
								</div>

								<div class="panel-dropdown">
									<a href="#">Guests <span class="qtyTotal">1</span></a>
									<div class="panel-dropdown-content right">
										<div class="qtyButtons">
											<label>Adults</label>
											<input type="text" name="qtyInput[]" value="1">
										</div>
										<div class="qtyButtons">
											<label>Childrens</label>
											<input type="text" name="qtyInput[]" value="0">
										</div>
									</div>
								</div>

								<div class="form-group clearfix">
									<div class="custom-select-form">
										<select class="wide" id="room" name="room" onchange="roomChange()">
											<option>Select Room Type</option>	
											@foreach($room_detail as $room)
											<option value="{{$room['id']}}">{{$room['type']}}</option>	
											@endforeach
										</select>
									</div>
								</div>
								<!-- <a href="/cart1" class=" add_top_30 btn_1 full-width purchase">Purchase</a> -->
								<button type="submit" class=" add_top_30 btn_1 full-width purchase">Purchase</button>
								<a href="wishlist.html" class="btn_1 full-width outline wishlist"><i class="icon_heart"></i> Add to wishlist</a>
								<div class="text-center"><small>No money charged in this step</small></div>
							</form>
						</div>
						<ul class="share-buttons">
							<li><a class="fb-share" href="#0"><i class="social_facebook"></i> Share</a></li>
							<li><a class="twitter-share" href="#0"><i class="social_twitter"></i> Tweet</a></li>
							<li><a class="gplus-share" href="#0"><i class="social_googleplus"></i> Share</a></li>
						</ul>
					</aside>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		@endif
		<!-- /bg_color_1 -->
	</main>
	<!--/main-->
    @endsection

@push('detail.blade-scripts')
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
		  $(this).val(picker.startDate.format('YYYY-MM-DD') + ' > ' + picker.endDate.format('YYYY-MM-DD'));
	  });
	  $('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
		  $(this).val('');
	  });
	});

	function roomChange() {
		$.ajax({
            url: "{!! route('get-price') !!}",
            type: 'get',
            data: { room: document.getElementById("room").value },
            dataType: 'json',
            success: function(res) {
				$("#price").text(res);
				document.getElementById('room_price').value = res;
            }
        });
	}

</script>
@endpush

