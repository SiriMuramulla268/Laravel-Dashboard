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

		<div class="bg_color_1">
			<div class="container margin_60_35">
				<div class="row">
					<div class="col-lg-8">
						<div class="box_cart">
						<table class="table table-striped cart-list">
							<thead>
								<tr>
									<th>
										Hotel
									</th>
									<th>
										Room
									</th>
									<th>
										Adult
									</th>
									<th>
										Child
									</th>
									<th>
										Price
									</th>
									<th>
										Actions
									</th>
								</tr>
							</thead>
							<tbody>
								@foreach($room_details as $room)
								<tr>
									<td>
										<div class="thumb_cart">
											<img src="http://via.placeholder.com/150x150/ccc/fff/thumb_cart_1.jpg" alt="Image">
										</div>
										<span class="item_cart">{{$room->hotels->name}}</span>
									</td>
									<td>
										{{$room['type']}}$
									</td>
									<td>
										{{$room['per_adult_price']}}$
									</td>
									<td>
										{{$room['per_child_price']}}$
									</td>
									<td>
										<strong>{{$room['price']}}$</strong>
									</td>
									<td class="options" style="width:5%; text-align:center;">
										<a href="#"><i class="icon-trash"></i></a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<div class="cart-options clearfix">
							<div class="float-left">
								<div class="apply-coupon">
									<div class="form-group">
										<input type="text" name="coupon-code" value="" placeholder="Your Coupon Code" class="form-control">
									</div>
									<div class="form-group">
										<button type="button" class="btn_1 outline">Apply Coupon</button>
									</div>
								</div>
							</div>
							<div class="float-right fix_mobile">
								<button type="button" class="btn_1 outline">Update Cart</button>
							</div>
						</div>
						<!-- /cart-options -->
					</div>
					</div>
					<!-- /col -->
					
					<aside class="col-lg-4" id="sidebar">
						<div class="box_detail">
							<div id="total_cart">
								Total <span class="float-right">{{$total}}.00$</span>
							</div>
							<ul class="cart_details">
								<li>From <span>{{$check_in}}</span></li>
								<li>To <span>{{$check_out}}</span></li>
								<li>Adults <span>{{$adult}}</span></li>
								<li>Childs <span>{{$child}}</span></li>
							</ul>
							<a href="/cart2" class="btn_1 full-width purchase">Checkout</a>
							<div class="text-center"><small>No money charged in this step</small></div>
						</div>
					</aside>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /bg_color_1 -->
	</main>
	<!--/main-->
    @endsection