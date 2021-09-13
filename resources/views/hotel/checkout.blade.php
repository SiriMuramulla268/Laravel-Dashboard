@extends('layouts.hotelmaster')
@section('title', config('app.name'))

    @section('content')
    <main>
        <div class="hero_in cart_section">
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

                        <div class="bs-wizard-step active">
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

        @if(session('_token') == $token)

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            <div class="bg_color_1">
                <div class="container margin_60_35">
                    <form id="booking" method="post" action="{{ route('booking') }}"  class="require-validation"
                        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="box_cart">
                             
                            @if( !session('user') )
                                <div class="message">
                                    <p>Exisitng Customer? <a href="#sign-in-dialog" id="sign-in" class="login"
                                        title="Sign In">Click here to login</a></p>
                                </div>
                            @endif

                            <div class="form_title">
                                <h3><strong>1</strong>Your Details</h3>
                            </div>
                            <div class="step">
                                <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" id="name_booking"
                                        name="name_booking"
                                        value="{{ Session::has('user')? Session::get('user')['name'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" id="email_booking"
                                        name="email_booking" class="form-control"
                                        value="{{ Session::has('user')? Session::get('user')['email'] : '' }}">
                                    </div>
                                </div>
                                <input type="hidden" name="type" value="user">
                            </div>
                            @if(session()->has('user'))
                            @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" id="password_booking" name="password_booking"
                                        class="form-control" value=""
                                        placeholder="Password is required for new user">
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="text" id="telephone_booking"
                                            name="telephone_booking" class="form-control"
                                            value="{{ Session::has('user')? Session::get('user')['mobile'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" id="address_booking"
                                            name="address_booking" class="form-control"
                                            value="{{ Session::has('user')? Session::get('user')['address'] : '' }}">
                                    </div>
                                </div>
                            </div>
                            </div>
                            <hr>
                            <!--End step -->
                            
                            <div class="form_title">
                                <h3><strong>2</strong>Payment Information</h3>
                            </div>
                            <div class="step">
                                <div class="form-group">
                                <label>Name on card</label>
                                <input type="text" class="form-control" id="name_card_booking"
                                    name="name_card_booking">
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Card number</label>
                                        <input type="text" id="card_number" name="card_number"
                                            class="form-control card-number" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <img src="{{asset('img/cards_all.svg')}}" alt="Cards" class="cards-payment">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Expiration date</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="expire_month" name="expire_month"
                                                    class="form-control card-expiry-month" placeholder="MM">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="expire_year" name="expire_year"
                                                    class="form-control card-expiry-year" placeholder="Year">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Security code</label>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <input type="text" id="cvv" name="cvv"
                                                    class="form-control card-cvc" placeholder="CVV">
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <img src="{{asset('img/icon_ccv.gif')}}" width="50" height="29"
                                                alt="ccv">
                                                <small>Last 3 digits</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-row row hide'>
                                    <div class='col-md-12 error form-group hide'>
                                        <div id="error" class=''></div>
                                    </div>
                                </div>
                            </div>
                            <!--End row -->

                            </div>
                            <hr>
                            <!--End step -->

                            <div class="form_title">
                                <h3><strong>3</strong>Billing Address</h3>
                            </div>
                            <div class="step">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <div class="custom-select-form">
                                            <select class="wide add_bottom_15" name="country" id="country">
                                                <option value="" selected>Select your country</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country['iso2']}}">{{ $country['name'] }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Street line 1</label>
                                            <input type="text" id="street_1" name="street_1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Street line 2</label>
                                            <input type="text" id="street_2" name="street_2" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" id="city_booking" name="city_booking"
                                            class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" id="state_booking" name="state_booking"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-group">
                                            <label>Postal code</label>
                                            <input type="text" id="postal_code" name="postal_code"
                                            class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!--End row -->
                            </div>
                           
                            </div>
                        </div>
                        <!-- /col -->
                        
                        <aside class="col-lg-4" id="sidebar">
                            <div class="box_detail">
                                <div class="text-center">
                                <h5 class="p-3 mb-2 bg-info text-white">
                                    {{session('room_details')[0]['hotels']['name']}}
                                </h5>
                                </div>
                                <br>
                                <div id="total_cart">
                                    Total
                                    <span class="float-right">
                                        {{session('currency')}}{{ number_format(session('total'),2) }}
                                    </span>
                                </div>
                                <ul class="cart_details">
                                    <li>From <span>{{session('check_in')}}</span></li>
                                    <li>To <span>{{session('check_out')}}</span></li>
                                    <li>Adults <span>{{session('adult')}}</span></li>
                                </ul>
                                <button type="submit" id="purchase" class="add_top_30 btn_1 full-width purchase">
                                Proceed To Book</button>
                            </div>
                        </aside>
                    </div>
                </form>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
        @else
            <div class="bg_color_1">
                <div class="container margin_60_35">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                        Session Expired
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- /bg_color_1 -->
    </main>
        <!--/main-->
    @endsection
    
@push('checkout.blade-scripts')
    <script>
        $(function() {
            $("#booking").validate({
            rules: {
                name_booking: "required",
                email_booking: "required",
                password_booking: "required",
                telephone_booking: "required",
                address_booking: "required",
                name_card_booking: "required",
                card_number: "required",
                expire_month: "required",
                expire_year: "required",
                cvv: "required",
                country: "required",
                street_1: "required",
                street_2: "required",
                city_booking: "required",
                state_booking: "required",
                postal_code: "required",
            },
            messages: {
                name_booking: "required",
                email_booking: "required",
                password_booking: "required",
                telephone_booking: "required",
                address_booking: "required",
                name_card_booking: "required",
                card_number: "required",
                expire_month: "required",
                expire_year: "required",
                cvv: "required",
                country: "required",
                street_1: "required",
                street_2: "required",
                city_booking: "required",
                state_booking: "required",
                postal_code: "required",
            }
            });
                
            var $form         = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form         = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                                    'input[type=text]', 'input[type=file]',
                                    'textarea'].join(', '),
                $inputs       = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid         = true;
                $errorMessage.addClass('hide');
            
                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                    }
                });
            
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });
        
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    document.getElementById('error').className = 'alert-danger alert';
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                $('#purchase').html('<span class="spinner-border spinner-border-sm"></span>  Booking Processing...');
                    /* token contains id, last4, and card type */
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
        });
    </script>
@endpush
