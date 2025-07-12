<!DOCTYPE html>
<html lang="zxx">


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
	<!-- Data Table css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/vendor/datatable/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/vendor/datatable/datatable2/buttons.dataTables.min.css')}}">
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
    <!--Ajax js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js')}}"></script>
    <!-- Leaflet Geosearch CSS/JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css"/>
    <script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js')}}"></script>
    <!-- jQuery (optional, but simplifies AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js')}}"></script>
    
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
                                <li class="nav-item "><a class="nav-link" href="{{route('test')}}">Dashboard</a></li>                                
                                <li class="nav-item"><a class="nav-link" href="{{route('mycampaigns')}}">My Campaigns</a>
                                <li class="nav-item"><a class="nav-link" href="{{route('donations')}}">Donations</a></li>
                                <li class="nav-item submenu"><a class="nav-link" href="">user name</a>
                                    <ul>
                                        <li class="nav-item"><a class="nav-link" href="{{route('myrewards')}}">My Rewards</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{route('profilesetting')}}">Profile Settings</a></li> 
                                        <li class="nav-item"><a class="nav-link" href="{{route('changepassword')}}">Change Password</a></li>
                                        <li class="nav-item"><a class="nav-link" href="">Log out</a></li>
                                    </ul>
                                </li>                         
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
                               
                                    <h3>
                                     <a href="{{route('home')}}">
                                        HOME
                                    </a>
                                    </h3>
                               
                                    
                                
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
     @yield('user_dash')

	@include('layouts.frontend.user.footer')
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
    <!-- data table js-->
    <script src="{{asset('assets/backend/js/data_table.js')}}"></script>
<!-- Data Table js-->
 <script src="{{asset('assets/backend/vendor/datatable/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('assets/backend/vendor/datatable/datatable2/dataTables.buttons.min.js')}}"></script>
 <script src="{{asset('assets/backend/vendor/datatable/datatable2/jszip.min.js')}}"></script>
 <script src="{{asset('assets/backend/vendor/datatable/datatable2/pdfmake.min.js')}}"></script>
 <script src="{{asset('assets/backend/vendor/datatable/datatable2/vfs_fonts.js')}}"></script>
 <script src="{{asset('assets/backend/vendor/datatable/datatable2/buttons.html5.min.js')}}"></script>
 <script src="{{asset('assets/backend/vendor/datatable/datatable2/buttons.print.min.js')}}"></script>

 <!-- data table js-->
  <script src="{{asset('assets/backend/js/data_table.js')}}"></script>
</body>

</html>