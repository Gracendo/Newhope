<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from demo.awaikenthemes.com/html-preview/lenity/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Feb 2025 03:32:32 GMT -->
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<!-- Page Title -->
    <title>Newhope</title>
	<!-- Favicon Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/frontend/images/favicon.png')}}">
	<!-- Google Fonts Css-->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&amp;family=Onest:wght@100..900&amp;display=swap" rel="stylesheet">
	<!-- Bootstrap Css -->
	<link href="{{asset('assets/frontend/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
	<!-- SlickNav Css -->
	<link href="{{asset('assets/frontend/css/slicknav.min.css')}}" rel="stylesheet">
	<!-- Swiper Css -->
	<link rel="stylesheet" href="{{asset('assets/frontend/css/swiper-bundle.min.css')}}">
	<!-- Font Awesome Icon Css-->
	<link href="{{asset('assets/frontend/css/all.min.css')}}" rel="stylesheet" media="screen">
	<!-- Animated Css -->
	<link href="{{asset('assets/frontend/css/animate.css')}}" rel="stylesheet">
    <!-- Magnific Popup Core Css File -->
	<link rel="stylesheet" href="{{asset('assets/frontend/css/magnific-popup.css')}}">
	<!-- Mouse Cursor Css File -->
	<link rel="stylesheet" href="{{asset('assets/frontend/css/mousecursor.css')}}">
	<!-- Main Custom Css -->
	<link href="{{asset('assets/frontend/css/custom.css')}}" rel="stylesheet" media="screen">
    <!--links to enhance maps and country,region and city selection-->
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Leaflet Geosearch CSS/JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css"/>
    <script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>
    <!-- jQuery (optional, but simplifies AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>

    <!-- Preloader Start -->
	<div class="preloader">
		<div class="loading-container">
			<div class="loading"></div>
			<div id="loading-icon"><img src="{{asset('assets/frontend/images/loader.svg')}}" alt=""></div>
		</div>
	</div>
	<!-- Preloader End -->

    <!-- Header Start -->
	<header class="main-header">
		<div class="header-sticky">
			<nav class="navbar navbar-expand-lg">
				<div class="container">
					<!-- Logo Start -->
					<a class="navbar-brand" href="{{route('home')}}">
                         <img src="{{asset('assets/frontend/images/loader.svg')}}" alt="Logo" ><span  style="margin-left:10px;color :white;"> Newhope </span>
					</a>
					<!-- Logo End -->

					<!-- Main Menu Start -->
					<div class="collapse navbar-collapse main-menu">
                        <div class="nav-menu-wrapper">
                            <ul class="navbar-nav mr-auto" id="menu">
                                <li class="nav-item "><a class="nav-link" href="{{route('home')}}">Home</a></li>                                
                                <li class="nav-item"><a class="nav-link" href="{{route('about')}}">About Us</a>
                                <li class="nav-item"><a class="nav-link" href="{{route('campaign')}}">Campaigns</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('orphanage')}}">Orphanages</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('blog')}}">Blog</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('contact')}}">Contact Us</a></li>                         
                            </ul>
                        </div>
                        <!-- Contact Now Box Start -->
                        <div class="contact-now-box">
                            <div class="icon-box">
                                <!-- <img src="{{asset('assets/frontend/images/icon-about-support.svg')}}"  alt=""> -->
                                 <img 
                                     src="{{asset('assets/frontend/images/icon-about-support.svg')}}" 
                                     alt="Support Icon"
                                     style="filter: brightness(0) invert(1);"
                                    >
                            </div>
                            
                            <div class="contact-now-box-content">
                                @php
                                    $user = auth('admin')->check() ? auth('admin')->user() : (auth()->check() ? auth()->user() : null);
                                @endphp

                                @if ($user)
                                    <h3>
                                    <a href="{{ auth('admin')->check() ? route('admin.home') : route('user.home') }}">
                                        MY PROFILE
                                    </a>
                                    </h3>
                                @else
                                    <p>Join us !</p>
                                    <h3>
                                    <a href="{{ route('user.login') }}">LOG IN</a>
                                    </h3>
                                @endif
                            </div>

                        </div>
                        <!-- Contact Now Box End -->
					</div>
					<!-- Main Menu End -->
					<div class="navbar-toggle"></div>
				</div>
			</nav>
			<div class="responsive-menu"></div>
		</div>
	</header>
	<!-- Header End -->
		@yield('home')

		@include('layouts.frontend.footer')

	<!-- Jquery Library File -->
    <script src="{{asset('assets/frontend/js/jquery-3.7.1.min.js')}}"></script>
    <!-- Bootstrap js file -->
    <script src="{{asset('assets/frontend/js/bootstrap.min.js')}}"></script>
    <!-- Validator js file -->
    <script src="{{asset('assets/frontend/js/validator.min.js')}}"></script>
    <!-- SlickNav js file -->
    <script src="{{asset('assets/frontend/js/jquery.slicknav.js')}}"></script>
    <!-- Swiper js file -->
    <script src="{{asset('assets/frontend/js/swiper-bundle.min.js')}}"></script>
    <!-- Counter js file -->
    <script src="{{asset('assets/frontend/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/jquery.counterup.min.js')}}"></script>
    <!-- Isotop js file -->
	<script src="{{asset('assets/frontend/js/isotope.min.js')}}"></script>
    <!-- Magnific js file -->
    <script src="{{asset('assets/frontend/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- SmoothScroll -->
    <script src="{{asset('assets/frontend/js/SmoothScroll.js')}}"></script>
    <!-- Parallax js -->
    <script src="{{asset('assets/frontend/js/parallaxie.js')}}"></script>
    <!-- MagicCursor js file -->
    <script src="{{asset('assets/frontend/js/gsap.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/magiccursor.js')}}"></script>
    <!-- Text Effect js file -->
    <script src="{{asset('assets/frontend/js/SplitText.js')}}"></script>
    <script src="{{asset('assets/frontend/js/ScrollTrigger.min.js')}}"></script>
    <!-- YTPlayer js File -->
    <script src="{{asset('assets/frontend/js/jquery.mb.YTPlayer.min.js')}}"></script>
    <!-- Wow js file -->
    <script src="{{asset('assets/frontend/js/wow.min.js')}}"></script>
    <!-- Main Custom js file -->
    <script src="{{asset('assets/frontend/js/function.js')}}"></script>

    @yield('scripts')
   
</body>

</html>