<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Panagea - Premium site template for travel agencies, hotels and restaurant listing.">
    <meta name="author" content="Ansonika">
    <title>@yield('title')</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{asset('img/apple-touch-icon-57x57-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{asset('img/apple-touch-icon-72x72-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{asset('img/apple-touch-icon-114x114-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{asset('img/apple-touch-icon-144x144-precomposed.png')}}">

    <!-- BASE CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
	<link href="{{asset('css/vendors.css')}}" rel="stylesheet">

    <!-- ALTERNATIVE COLORS CSS -->
    <link href="#" id="colors" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">

</head>
<style>
   label.error {
        color: #dc3545;
        font-size: 12px;
    }
    /* to remove extra pagination style  */
    .w-5{display:none} 
    .cb-btn:checked + label {
        background-color: Green !important;
    }
</style>
<body class="datepicker_mobile_full"><!-- Remove this class to disable datepicker full on mobile -->
    <div id="page" class="theia-exception">
        
        <!-- header -->
        <header class="header menu_fixed">
            <div id="preloader"><div data-loader="circle-side"></div></div><!-- /Page Preload -->
            <div id="logo">
                <a href="index.html">
                    <img src="{{asset('img/logo.svg')}}" width="150" height="36" alt="" class="logo_normal">
                    <img src="{{asset('img/logo_sticky.svg')}}" width="150" height="36" alt="" class="logo_sticky">
                </a>
            </div>
            <ul id="top_menu">
                <li><a href="cart-1.html" class="cart-menu-btn" title="Cart"><strong>4</strong></a></li>
                <li><a href="#sign-in-dialog" id="sign-in" class="login" title="Sign In">Sign In</a></li>
                <li><a href="wishlist.html" class="wishlist_bt_top" title="Your wishlist">Your wishlist</a></li>
            </ul>
            <!-- /top_menu -->
            <a href="#menu" class="btn_mobile">
                <div class="hamburger hamburger--spin" id="hamburger">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </a>
            <nav id="menu" class="main-menu">
                <ul>
                    <li><span><a href="/">Home</a></span>
                    </li>
                    <li><span><a href="/hotels">Hotels</a></span>
                    </li>
                    
                </ul>
            </nav>
        </header>
        <!-- /header -->
        
        @yield('content')

        <!--footer-->
        <footer>
            <div class="container margin_60_35">
                <div class="row">
                    <div class="col-lg-5 col-md-12 p-r-5">
                        <p><img src="{{asset('img/logo.svg')}}" width="150" height="36" alt=""></p>
                        <p>Mea nibh meis philosophia eu. Duis legimus efficiantur ea sea. Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu. Nihil facilisi indoctum an vix, ut delectus expetendis vis.</p>
                        <div class="follow_us">
                            <ul>
                                <li>Follow us</li>
                                <li><a href="#0"><i class="ti-facebook"></i></a></li>
                                <li><a href="#0"><i class="ti-twitter-alt"></i></a></li>
                                <li><a href="#0"><i class="ti-google"></i></a></li>
                                <li><a href="#0"><i class="ti-pinterest"></i></a></li>
                                <li><a href="#0"><i class="ti-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 ml-lg-auto">
                        <h5>Useful links</h5>
                        <ul class="links">
                            <li><a href="/about">About</a></li>
                            <li><a href="/admin">Login</a></li>
                            <li><a href="/register">Register</a></li>
                            <li><a href="blog.html">News &amp; Events</a></li>
                            <li><a href="/contacts">Contacts</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5>Contact with Us</h5>
                        <ul class="contacts">
                            <li><a href="tel://61280932400"><i class="ti-mobile"></i> + 61 23 8093 3400</a></li>
                            <li><a href="mailto:info@Panagea.com"><i class="ti-email"></i> info@Panagea.com</a></li>
                        </ul>
                        <div id="newsletter">
                        <h6>Newsletter</h6>
                        <div id="message-newsletter"></div>
                        <form method="post" action="assets/newsletter.php" name="newsletter_form" id="newsletter_form">
                            <div class="form-group">
                                <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
                                <input type="submit" value="Submit" id="submit-newsletter">
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <!--/row-->
                <hr>
                <div class="row">
                    <div class="col-lg-6">
                        <ul id="footer-selector">
                            <li>
                                <div class="styled-select" id="lang-selector">
                                    <select>
                                        <option value="English" selected>English</option>
                                        <option value="French">French</option>
                                        <option value="Spanish">Spanish</option>
                                        <option value="Russian">Russian</option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="styled-select" id="currency-selector">
                                    <select>
                                        <option value="US Dollars" selected>US Dollars</option>
                                        <option value="Euro">Euro</option>
                                    </select>
                                </div>
                            </li>
                            <li><img src="{{asset('img/cards_all.svg')}}" alt=""></li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul id="additional_links">
                            <li><a href="#0">Terms and conditions</a></li>
                            <li><a href="#0">Privacy</a></li>
                            <li><span>© 2019 Panagea</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
	    <!--/footer-->
       
    </div>

    <!-- Sign In Popup -->
    <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
        <div class="small-dialog-header">
            <h3>Sign In</h3>
        </div>
        <form method="POST" action="{{ route('logins') }}" onsubmit="signin()">
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
                <div class="text-center"><input type="submit" value="Log In" class="btn_1 full-width"></div>
                <div class="text-center">
                    Don’t have an account? <a href="register.html">Sign up</a>
                </div>
            </div>
        </form>
        <!--form -->
    </div>
    <!-- /Sign In Popup -->

    <div id="toTop"></div><!-- Back to top button -->
	
	<!-- COMMON SCRIPTS -->
    <script src="{{asset('js/common_scripts.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    
    <!-- COLOR SWITCHER  -->
    <script src="{{asset('js/switcher.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

    <!-- SPECIFIC SCRIPTS -->
	<!-- <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB6Vck_vRXDPR8ILH8ZLOeGSEz_n4YR0mU"></script> -->

	<script src="{{asset('js/mapmarker.jquery.js')}}"></script>
	<script src="{{asset('js/mapmarker_func.jquery.js')}}"></script>
    <!-- Map -->
    <!-- <script src="{{asset('js/map_single_hotel.js')}}"></script>
	<script src="{{asset('js/infobox.js')}}"></script>
     -->
   
    <!-- Datepicker -->
    <script src="{{asset('assets/validate.js')}}"></script>
    <script type="text/javascript" src="jquery.validate.js"></script>

    @stack('index.blade-scripts')
    @stack('list.blade-scripts')
    @stack('detail.blade-scripts')
   
    <!-- INPUT QUANTITY  -->
	<script src="{{asset('js/input_qty.js')}}"></script>
</body>

</html>
