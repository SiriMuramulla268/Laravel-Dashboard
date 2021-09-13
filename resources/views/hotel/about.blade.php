@extends('layouts.hotelmaster')
@section('title', config('app.name'))

    @section('content')
    <main>
        
        <section class="hero_in general">
            <div class="wrapper">
                <div class="container">
                    <h1 class="fadeInUp"><span></span>About Panagea</h1>
                </div>
            </div>
        </section>
        <!--/hero_in-->

        <div class="container margin_80_55">
            <div class="main_title_2">
                <span><em></em></span>
                <h2>Why Choose Panagea</h2>
                <p> An Enthusiastic Traveller.. Are You The One ?</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <a class="box_feat" href="#0">
                        <i class="pe-7s-medal"></i>
                        <h3>+ 1000 Customers</h3>
                        <p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris,
                            cum no alii option, cu sit mazim libris.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a class="box_feat" href="#0">
                        <i class="pe-7s-help2"></i>
                        <h3>H24 Support</h3>
                        <p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris,
                            cum no alii option, cu sit mazim libris. </p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a class="box_feat" href="#0">
                        <i class="pe-7s-culture"></i>
                        <h3>+ 575 Locations</h3>
                        <p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris,
                            cum no alii option, cu sit mazim libris.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a class="box_feat" href="#0">
                        <i class="pe-7s-headphones"></i>
                        <h3>Help Direct Line</h3>
                        <p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris,
                            cum no alii option, cu sit mazim libris. </p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a class="box_feat" href="#0">
                        <i class="pe-7s-credit"></i>
                        <h3>Secure Payments</h3>
                        <p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris,
                            cum no alii option, cu sit mazim libris.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a class="box_feat" href="#0">
                        <i class="pe-7s-chat"></i>
                        <h3>Support via Chat</h3>
                        <p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris,
                            cum no alii option, cu sit mazim libris. </p>
                    </a>
                </div>
            </div>
            <!--/row-->
        </div>
        <!-- /container -->

        <div class="bg_color_1">
            <div class="container margin_80_55">
                <div class="main_title_2">
                    <span><em></em></span>
                    <h2>Our Origins and Story</h2>
                    <p>Panagea The World's Best Hotel Booking Platform.</p>
                </div>
                <div class="row justify-content-between">
                    <div class="col-lg-6 wow" data-wow-offset="150">
                        <figure class="block-reveal">
                            <div class="block-horizzontal"></div>
                            <img src="{{asset('img/about_1.jpg')}}" class="img-fluid" alt="">
                        </figure>
                    </div>
                    <div class="col-lg-5">
                        <p>The World's Best Hotel Booking Platform
                            <strong>PANAGEA</strong>. Panagea makes travellers life easy.
                            One can book any favourite hotels all over the world.
                        </p>
                        <p>Make a multiple room booking with availed coupons. <strong> Book</strong>
                            and make a quick Payment and get the confirmation.</p>
                        <p><em> The Panagea Team</em></p>
                    </div>
                </div>
                <!--/row-->
            </div>
            <!--/container-->
        </div>
        <!--/bg_color_1-->

    </main>
    <!--/main-->
    @endsection
