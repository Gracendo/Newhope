@extends('layouts.frontend.header')
@section('home')
 <!-- Page Header Start -->
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque">OUR<span> CAMPAIGNS</span> </h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Campaigns</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Page Programs Start -->
    <div class="page-programs">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Program Item Start -->
                    <div class="program-item wow fadeInUp">
                        <div class="program-image">
                            <a href="program-single.html" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{asset('assets/frontend/images/program-1.jpg')}}" alt="">
                                </figure>
                            </a>
                        </div>
                        <div class="program-body">
                            <div class="program-content">
                                <h3><a href="program-single.html">Aqua farm</a></h3>
                                <p>We aim at rairing about 200 fish in a 400m squared or more man made lakes</p>
                            </div>
                            <div class="program-button">
                                <a href="program-single.html" class="readmore-btn">read more</a>
                            </div>
                        </div>
                    </div>
                    <!-- Program Item End -->                    
                </div>
                
                

    <!-- Main Footer Section Start -->
    <footer class="main-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Main Footer Box Start -->
                    <div class="main-footer-box">
                        <!-- Footer About Start -->
                        <div class="footer-about">
                            <!-- Footer Logo Start -->
                            <div class="footer-logo">
                                <img src="images/footer-logo.svg" alt="">
                            </div>
                            <!-- Footer Logo End -->
                            
                            <!-- Footer Contact Detail Start -->
                            <div class="footer-contact-detail">
                                <div class="footer-contact-item">
                                    <p>Toll free customer care</p>
                                    <h3><a href="tel:+123456789">+123 456 789</a></h3>
                                </div>
                                
                                <div class="footer-contact-item">
                                    <p>Need live support!</p>
                                    <h3><a href="mailto:info@domainname.com">info@domainname.com</a></h3>
                                </div>
                            </div>
                            <!-- Footer Contact Detail End -->
                            
                            <!-- Footer Social Links Start -->
                            <div class="footer-social-links">
                                <h3>Follow on</h3>
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>                                    								
                                </ul>
                            </div>
                            <!-- Footer Social Links End -->
                        </div>
                        <!-- Footer About End -->

                        <!-- Footer Links Box Start -->
                        <div class="footer-links-box">
                            <!-- Newsletter Form Start -->
                            <div class="newsletter-form">
                                <form id="newsletterForm" action="#" method="POST">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" id="mail" placeholder="Enter Your Email" required="">
                                        <button type="submit" class="newsletter-btn"><i class="fa-regular fa-paper-plane"></i></button>
                                    </div>
                                </form>
                            </div>
                            <!-- Newsletter Form End -->

                            <!-- Footer Links Start -->
                            <div class="footer-links">
                                <h3>Quick link</h3>
                                <ul>
                                    <li><a href="index.html">home</a></li>
                                    <li><a href="about.html">about us</a></li>
                                    <li><a href="services.html">services</a></li>
                                    <li><a href="blog.html">blog</a></li>
                                </ul>
                            </div>
                            <!-- Footer Links End -->
                            
                            <!-- Footer Links Start -->
                            <div class="footer-links footer-service-links">
                                <h3>services</h3>
                                <ul>
                                    <li><a href="service-single.html">food security initiatives</a></li>
                                    <li><a href="service-single.html">healthcare access</a></li>
                                    <li><a href="service-single.html">educational support</a></li>
                                    <li><a href="service-single.html">youth development</a></li>
                                </ul>
                            </div>
                            <!-- Footer Links End -->
                            
                            <!-- Footer Links Start -->
                            <div class="footer-links">
                                <h3>support</h3>
                                <ul>
                                    <li><a href="#">help</a></li>
                                    <li><a href="#">privacy policy</a></li>
                                    <li><a href="#">term's & condition</a></li>
                                    <li><a href="#">support</a></li>
                                </ul>
                            </div>
                            <!-- Footer Links End -->
                        </div>
                        <!-- Footer Links Box End -->
                    </div>
                    <!-- Main Footer Box End -->
                </div>
            </div>
        </div>

        <!-- Footer Copyright Start -->
        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Copyright Text Start -->
                        <div class="copyright-text">
                            <p>Copyright © 2025 All Rights Reserved.</p>
                        </div>
                        <!-- Copyright Text End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Copyright End -->
    </footer>
    <!-- Main Footer Section End -->

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

<!-- Mirrored from html.awaikenthemes.com/lenity/programmes.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Jun 2025 01:10:35 GMT -->
</html>
@endsection