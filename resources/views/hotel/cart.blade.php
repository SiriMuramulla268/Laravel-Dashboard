@extends('layouts.hotelmaster')
@section('title', config('app.name'))

    @section('content')
    <main>
		<div class="hero_in cart_section">
			<div class="wrapper">
				<div class="container">
					<div class="bs-wizard clearfix">
						<div class="bs-wizard-step active">
							<div class="text-center bs-wizard-stepnum">Your cart</div>
							<div class="progress">
								<div class="progress-bar"></div>
							</div>
							<a href="#0" class="bs-wizard-dot"></a>
						</div>

						<div class="bs-wizard-step disabled">
							<div class="text-center bs-wizard-stepnum">Payment</div>
							<div class="progress">
								<div class="progress-bar"></div>
							</div>
							<a href="#0" class="bs-wizard-dot"></a>
						</div>

						<div class="bs-wizard-step disabled">
							<div class="text-center bs-wizard-stepnum">Finish!</div>
							<div class="progress">
								<div class="progress-bar"></div>
							</div>
							<a href="#0" class="bs-wizard-dot"></a>
						</div>
					</div>
					<!-- End bs-wizard -->
				</div>
			</div>
		</div>
		<!--/hero_in-->

		@if(session('room_details'))
		<div class="bg_color_1">
			<div class="container margin_60_35">
				<div class="row">
					<div class="col-lg-8">
						<div class="box_cart">
						<table class="table table-striped cart-list">
							<thead>
								<tr>
									<th>
										Room
									</th>
									<th>
										Quantity
									</th>
									<th>
										Price
									</th>
								</tr>
							</thead>
							<tbody>
								@foreach(session('room_details') as $key=>$room)
								<tr>
									<td>
										<div class="thumb_cart">
											<img src="http://via.placeholder.com/150x150/ccc/fff/thumb_cart_1.jpg" alt="Image">
										</div>
										<span class="item_cart">{{$room['type']}}</span>
									</td>
									<td>1</td>
									<td>
										<strong>{{session('currency')}}{{ number_format($room['price'], 2) }}</strong>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<div class="cart-options clearfix">
							<div class="float-left">
								<div class="apply-coupon">
									<div class="form-group">
										<input type="text" name="coupon-code" id="coupon_code" placeholder="Your Coupon Code" class="form-control">
										<span class="text-danger" id="coupon_msg" value=""></span>
									</div>
									<div class="form-group">
										<button type="button" class="btn_1 outline" onclick="coupon()">Apply Coupon</button>
									</div>
								</div>
							</div>
							<div class="float-right fix_mobile">
								<a href="{{ session('cart_url') }}" type="button" class="btn_1 outline">Update Cart</a>
							</div>
						</div>
						<!-- /cart-options -->
					</div>
					</div>
					<!-- /col -->
					
					<aside class="col-lg-4" id="sidebar">
						<div class="box_detail">
							<div class="text-center">
							<h5 class="p-3 mb-2 bg-info text-white">{{session('room_details')[0]['hotels']['name']}}</h5>
							</div>
							<br>
							<div id="total_cart" >
								Total <span class="float-right">{{session('currency')}}{{ number_format(session('total'),2) }}</span>
							</div>
							<ul class="cart_details">
								<li>From <span>{{session('check_in')}}</span></li>
								<li>To <span>{{session('check_out')}}</span></li>
								<li>Adults <span>{{session('adult')}}</span></li>
							</ul>
							<a href="/checkout/{{session('_token')}}" class="btn_1 full-width purchase">Checkout</a>
							<div class="text-center"><small>No money charged in this step</small></div>
						</div>
					</aside>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		@else
		<div class="bg_color_1">
                <div class="container margin_60_35">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                        No Rooms Added To Cart. Click <a href="/hotels">Hotels</a>
                        </div>
                    </div>
                </div>
            </div>
		@endif
		<!-- /bg_color_1 -->
	</main>
	<!--/main-->
    @endsection

	<script>
		function coupon(){
			$("#coupon_msg").show();
			$('#coupon_msg').html('Invalid Coupon');
			$("#coupon_msg").fadeOut(200);
			$('#coupon_code').val('');
		}
	</script>

