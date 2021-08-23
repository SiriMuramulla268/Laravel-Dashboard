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
									<div class="col-md-8 container">
										<h4>{{$room['type']}} <input type="checkbox" name="book[]" id="{{$room['id']}}" hidden class="cb-btn" onclick="book('{{$room['id']}}')" value="{{$room['type']}}"><label class="btn-sm btn-primary btn-1" for="{{$room['id']}}"><small>Book</small></label></h4>
										
										<!-- <input type="button" id="book" class="btn-xs btn-info btn-1" value="Book"> -->
										<span><strong>{{$hotel_detail->country->currency_symbol}}{{ number_format($room['price']) }}</strong></span>
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
							<form id="purchase" action="{{route('cart')}}" method="post" autocomplete="off">
								@csrf
								<div class="price">
									<span>{{$hotel_detail->country->currency_symbol}}</span> 
									<span id="price">{{ number_format($hotel_detail->min_price) }} </span><small>per room</small>
									<input type="hidden" id="room_price" name="room_price" value="{{$hotel_detail->min_price}}"/>
									<input type="hidden" id="url" name="url" value="{{url()->full()}}" />
									<div class="score"><strong>7.0</strong></div>
								</div>
								
								<div class="form-group input-dates">
									<input class="form-control" type="text" name="dates" id="dates" autocomplete="off" placeholder="When.." value="{{$dates}}">
									<i class="icon_calendar"></i>
								</div>
								
								<div class="form-group panel-dropdown">
									<a href="#">Guests <span class="qtyTotal" name="guest">1</span></a>
									 <div class="panel-dropdown-content right">
										<div class="qtyButtons"> 
											<label>Adults</label>
											<input class="form-control" type="text" name="qtyInput" value="1" min="1" >
										 </div>	
									</div>
								</div>

								<div class="form-group clearfix">
									<div class="custom-select-form">
										<input type="text" class="form-control" id="rooms" name="rooms" value="" Placeholder="Pick Rooms to Book">
										<input type="hidden" class="form-control" name="roomid" id="roomid" value="">
									</div>
								</div>

								<div class="form-group clearfix">
									<input type="hidden" class="form-control" id="room_qty" name="room_qty">
								</div>

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
		var date = $('#dates').val();
		var date_arr = date.split('>');
		var start_date, end_date;
		if(date_arr == ''){
			start_date = new Date();
			end_date = new Date();
		}else{
			start_date = new Date (date_arr[0]);
			end_date = new Date (date_arr[1]);
		}

	  'use strict';
	  $('input[name="dates"]').daterangepicker({
		  autoUpdateInput: false,
		  minDate:new Date(),
		  startDate: start_date ,
		  endDate: end_date,
		  select: 'range',
		  startInput: '#dates',
		  display: 'inline',
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

	  $("#purchase").validate({
		rules: {
			dates: "required",
			rooms: "required",
		},
		messages: {
			dates: "Choose Dates",
			rooms: "Pick Rooms",
		}
		});
		$('input[type=checkbox]').prop("checked", false);
	});

	//booked rooms
	function book(val){
		document.getElementById('rooms').value = '';
		document.getElementById('roomid').value = '';
		document.getElementById('room_qty').value = '';
		$("input[name='book[]']:checked").each( function (i, val) {
			if(i>0){
				document.getElementById('rooms').value += ', ';
				document.getElementById('roomid').value += ',';
				document.getElementById('room_qty').value += ',';

			}
			document.getElementById('rooms').value += val.value;
			document.getElementById('roomid').value += val.id;	
			document.getElementById('room_qty').value += 1;	
		});
	}
	
</script>
@endpush

