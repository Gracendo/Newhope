<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="{{asset('assets/frontend/css/signin.css')}}">
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">-->
    <!--links to the homepage styles-->
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
  </head>
<body>
  <!-- <div class="preloader">
		<div class="loading-container">
			<div class="loading"></div>
			<div id="loading-icon"><img src="{{asset('assets/frontend/images/loader.svg')}}" alt=""></div>
		</div>
	</div> -->
    <header class="signup-header">
        <div class="container">
            <h1>WELCOME OUR NEWHOPE</h1>
            <p class="tagline">Empower change, one act of kindness at a time</p>
        </div>
    </header>

    <main class="signup-main">
        <div class="container">
            <div class="signup-container">
                <div class="signup-info">
                    <h2>Join Our Mission</h2>
                    <p>Become part of our community dedicated to creating brighter futures by providing hope, delivering help, and fostering lasting change.</p>
                    <div class="benefits">
                        <div class="benefit-item">
                            <i class="fas fa-heart"></i>
                            <span>Make a real difference</span>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-bell"></i>
                            <span>Get updates on our work</span>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-hand-holding-heart"></i>
                            <span>Volunteer opportunities</span>
                        </div>
                    </div>
                </div>

                <form class="signup-form" id="signupForm">
                    <h3>Create Your Account</h3>
                    
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="confirm-password" required>
                    </div>
                    
                    <div class="form-group checkbox-group">
                        <input type="checkbox" id="newsletter" name="newsletter" checked>
                        <label for="newsletter">Subscribe to our newsletter</label>
                    </div>
                    
                    <button type="submit" class="hero-btn">Join Now <i class="fas fa-arrow-right"></i></button>
                    
                    <p class="login-link">Already have an account? <a href="#">Log in</a></p>
                </form>
            </div>
        </div>
    </main>

    <footer class="signup-footer">
        <div class="container">
            <p>&copy; 2023 Our Charity. All rights reserved.</p>
        </div>
    </footer>

    <!-- Jquery Library File -->
    <script src="js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap js file -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Validator js file -->
    <script src="js/validator.min.js"></script>
    <!-- SlickNav js file -->
    <script src="js/jquery.slicknav.js"></script>
    <!-- Swiper js file -->
    <script src="js/swiper-bundle.min.js"></script>
    <!-- Counter js file -->
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <!-- Isotop js file -->
	<script src="js/isotope.min.js"></script>
    <!-- Magnific js file -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <!-- SmoothScroll -->
    <script src="js/SmoothScroll.js"></script>
    <!-- Parallax js -->
    <script src="js/parallaxie.js"></script>
    <!-- MagicCursor js file -->
    <script src="js/gsap.min.js"></script>
    <script src="js/magiccursor.js"></script>
    <!-- Text Effect js file -->
    <script src="js/SplitText.js"></script>
    <script src="js/ScrollTrigger.min.js"></script>
    <!-- YTPlayer js File -->
    <script src="js/jquery.mb.YTPlayer.min.js"></script>
    <!-- Wow js file -->
    <script src="js/wow.min.js"></script>
    <!-- Main Custom js file -->
    <script src="js/function.js"></script>
</body>

</html>