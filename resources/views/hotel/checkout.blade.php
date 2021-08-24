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
            <div class="bg_color_1">
                <div class="container margin_60_35">
                    <form id="booking" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="box_cart">
                            <div class="message">
                                <p>Exisitng Customer? <a href="#sign-in-dialog" id="sign-in" class="login" title="Sign In">Click here to login</a></p>
                            </div>
                            <div class="form_title">
                                <h3><strong>1</strong>Your Details</h3>
                            </div>
                            <div class="step">
                                <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" id="name_booking" name="name_booking">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" id="email_booking" name="email_booking" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="text" id="telephone_booking" name="telephone_booking" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" id="address_booking" name="address_booking" class="form-control">
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
                                <input type="text" class="form-control" id="name_card_bookign" name="name_card_bookign">
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Card number</label>
                                        <input type="text" id="card_number" name="card_number" class="form-control">
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
                                                <input type="text" id="expire_month" name="expire_month" class="form-control" placeholder="MM">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="expire_year" name="expire_year" class="form-control" placeholder="Year">
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
                                                    <input type="text" id="ccv" name="ccv" class="form-control" placeholder="CCV">
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <img src="{{asset('img/icon_ccv.gif')}}" width="50" height="29" alt="ccv"><small>Last 3 digits</small>
                                            </div>
                                        </div>
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
                                                <option value="Europe">Europe</option>
                                                <option value="United states">United states</option>
                                                <option value="South America">South America</option>
                                                <option value="Oceania">Oceania</option>
                                                <option value="Asia">Asia</option>
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
                                            <input type="text" id="city_booking" name="city_booking" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" id="state_booking" name="state_booking" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-group">
                                            <label>Postal code</label>
                                            <input type="text" id="postal_code" name="postal_code" class="form-control">
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
                                <h5 class="p-3 mb-2 bg-info text-white">{{session('room_details')[0]['hotels']['name']}}</h5>
                                </div>
                                <br>
                                <div id="total_cart">
                                    Total <span class="float-right">{{session('currency')}}{{ number_format(session('total'),2) }}</span>
                                </div>
                                <ul class="cart_details">
                                    <li>From <span>{{session('check_in')}}</span></li>
                                    <li>To <span>{{session('check_out')}}</span></li>
                                    <li>Adults <span>{{session('adult')}}</span></li>
                                </ul>
                                <!-- <a href="/cart3" class="btn_1 full-width purchase">Purchase</a> -->
                                <button type="submit" class=" add_top_30 btn_1 full-width purchase">Purchase</button>
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

    <!-- Sign In Popup -->
    <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide" >
        <div class="small-dialog-header">
            <h3>Sign In</h3>
        </div>
        <form id="exist_user" name="exist_user" method="post">
        @csrf
            <div class="sign-in-wrapper">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                    <i class="icon_mail_alt"></i>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" id="password" value="">
                    <i class="icon_lock_alt"></i>
                </div>
                <input type="hidden" name="user_type" value="user">
                <div class="text-center"><input type="button" value="Log In" class="btn_1 full-width" onclick="signin()"></div>
                <div class="text-center">
                    Don’t have an account? <a href="register.html">Sign up</a>
                </div>
            </div>
        </form>
        <!--form -->
    </div>
    <!-- /Sign In Popup -->

    <script>
    

    function signin(){
        $.ajax({
        url: "http://127.0.0.1:8000/exist_user",
        type: 'post',
        data: $('#exist_user').serialize(),
        dataType: 'json',
        success: function(res) {
            $('#sign-in-dialog').hide();
            document.getElementById('name_booking').value = res.name;
            document.getElementById('email_booking').value = res.email;
            document.getElementById('telephone_booking').value = res.mobile;
            document.getElementById('address_booking').value = res.address;
        }
        });
    }
    </script>

   