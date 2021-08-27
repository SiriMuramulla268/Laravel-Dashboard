@extends('layouts.hotelmaster')
@section('title', config('app.name'))

    @section('content')
    <main>
		<section class="hero_in general">
			<div class="wrapper">
				<div class="container">
					@if(session('user'))
					<h1 class="fadeInUp"><span></span>{{ $user->name }}</h1>
					@endif
				</div> 
			</div>
		</section>
		<!--/hero_in-->

		<div class="container margin_60_35">
        @if(session('user'))
			<div class="row">
                @foreach($bookings as $data)
                <div class="col-lg-6">
					<article class="blog wow fadeIn">
						<div class="row no-gutters">
							<div class="col-lg-5">
								<figure>
									<a href="hotel/{{$data->hotel->slug}}/0"><img src="{{asset('img/blog-1.jpg')}}" alt="">
										<div class="preview"><span>Read more</span></div>
									</a>
								</figure>
							</div>
							<div class="col-lg-7">
								<div class="post_info">
									<span><small>{{ $data->bookingDetail[0]->check_in }} to {{ $data->bookingDetail[0]->check_in }}</small></span>
									<h3><a href="blog-post.html">{{ $data->hotel->name }}</a></h3>
                                    <p>Adults - {{ $data->bookingDetail[0]->adult }}</p>
                                    <p>Total - {{ $data->total }}</p>
									<ul>
										<li>
											<div class="thumb"><img src="{{asset('img/thumb_blog.jpg')}}" alt=""></div> {{ $data->user->name }}
										</li>
										<li></li>
									</ul>
								</div>
							</div>
						</div>
					</article>
					<!-- /article -->
				</div>
                @endforeach
                
			</div>
            <div class="row">
                <div class="col-8"></div>
                <div class="col-4">
                    {{ $bookings->links() }}
                </div>
            </div>
			<!-- /row -->
        @else
            <div class="row"> 
                <div class="col-lg-12 text-center">
                No Bookings Found
                </div>
            </div>
        @endif
		</div>
		<!-- /container -->
	</main>
	<!--/main-->
    @endsection

