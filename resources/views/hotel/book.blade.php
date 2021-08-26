@extends('layouts.hotelmaster')
@section('title', config('app.name'))

    @section('content')
    <main>
		<div class="hero_in cart_section last">
			<div class="wrapper">
				<div class="container">
					<div class="bs-wizard clearfix">
						<div class="bs-wizard-step">
							<div class="text-center bs-wizard-stepnum">Your cart</div>
							<div class="progress">
								<div class="progress-bar"></div>
							</div>
							<a href="cart-1.html" class="bs-wizard-dot"></a>
						</div>

						<div class="bs-wizard-step">
							<div class="text-center bs-wizard-stepnum">Payment</div>
							<div class="progress">
								<div class="progress-bar"></div>
							</div>
							<a href="cart-2.html" class="bs-wizard-dot"></a>
						</div>

						<div class="bs-wizard-step active">
							<div class="text-center bs-wizard-stepnum">Finish!</div>
							<div class="progress">
								<div class="progress-bar"></div>
							</div>
							<a href="#0" class="bs-wizard-dot"></a>
						</div>
					</div>
					<!-- End bs-wizard -->
					@if(session('room_details'))
						@if($response['status'] == 'succeeded')
						<div id="confirm">
							<h4>Booking Done Sucessfully!</h4>
							<p>You'll receive a confirmation email at {{ $email }}</p>
						</div>
						@endif
					@endif
				</div>
			</div>
		</div>
		<!--/hero_in-->
	</main>
	<!--/main-->
    @endsection