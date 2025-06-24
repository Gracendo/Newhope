@extends('layouts.frontend.header')
@section('home')
 <!-- Page Donation Start -->
    <div class="page-donation">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Donation Box Start -->
                    <div class="donation-box">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">donate now</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Your donation</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Your donation is more than just financial support; it is a powerful act of 
                                kindness that drives meaningful change. Every contribution helps Cmeroon  orphanages become more autonomous .</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- Campaign Donation Form Start -->
                        <div class="donate-form campaign-donate-form">
                            <form id="donateForm" action="#" method="POST">
                                <div class="campaign-donate-value wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="form-group mb-4">
                                        <input type="number" name="amount" class="form-control"  id="donation" placeholder="Donate Now ..." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                    
                                    <fieldset class="donate-value-box">
                                        <div class="donate-value">
                                            <input type="radio" id="value1" name="value" value="1000" checked>
                                            <label for="value1"> 1000 FCFA</label>
                                        </div>
                                        
                                        <div class="donate-value">
                                            <input type="radio" id="value2" name="value" value="2000">
                                            <label for="value2">2000 FCFA</label>
                                        </div>
                                        
                                        <div class="donate-value">
                                            <input type="radio" id="value3" name="value" value="3000">
                                            <label for="value3">3000 FCFA</label>
                                        </div>
                                        
                                        <div class="donate-value">
                                            <input type="radio" id="value4" name="value" value="4000">
                                            <label for="value4">4000 FCFA</label>
                                        </div>
                                        
                                        <div class="donate-value">
                                            <input type="radio" id="value5" name="value" value="5000">
                                            <label for="value5">5000 FCFA</label>
                                        </div>
                                        
                                        <div class="donate-value">
                                            <input type="radio" id="value6" name="value" value="10000">
                                            <label for="value6">10000 FCFA</label>
                                        </div>
                                    </fieldset>
                                </div>
                    
                                <!-- Donation Payment Method Start -->
                                <div class="donate-payment-method">
                                    <div class="section-title">
                                         @if (session('status'))
                                        <h2 class="text-anime-style-2" data-cursor="-opaque">Select <span>Contribution  type</span></h2>
                                        @else 
                                        <h2 class="text-anime-style-2" data-cursor="-opaque">Select <span>Fund type</span></h2>
                                         @endif
                                    </div>
                                    <div class="donate-payment-type wow fadeInUp" data-wow-delay="0.6s">
                                        <div class="payment-method">
                                            <input type="radio" id="test" name="is_anonymous" value="false" checked>
                                            <label for="test">not anonymous </label>
                                        </div>
                                        <div class="payment-method">
                                            <input type="radio" id="Offline" name="status" value="true">
                                            <label for="Offline"> Anonymous</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Donation Payment Method End -->
                                
                                <!-- Donar Personal Info Start -->
                                <div class="donar-personal-info">
                                    <!-- Section Title Start -->
                                    <div class="section-title">
                                        <h2 class="text-anime-style-2" data-cursor="-opaque">Personal <span>info</span></h2>
                                    </div>
                                    <!-- Section Title End -->
                
                                    <div class="row wow fadeInUp" data-wow-delay="0.8s">
                                        <div class="form-group col-md-6 mb-4">
                                            <input type="text" name="donor_name" class="form-control" id="fname" placeholder="Name" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                
                
                                
                                        <div class="form-group col-md-12 mb-4">
                                            <input type="email" name ="donor_email" class="form-control" id="email" placeholder="Enter your e-mail" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                
                                        
                                    </div>
                                </div>
                                <!-- Donar Personal Info End -->
                    
                                <!-- Donar Info Form Button Start -->
                                <div class="form-group-btn wow fadeInUp" data-wow-delay="1s">
                                     @if (session('status'))
                                    <button type="submit" class="btn-default">Contribute now</button>
                                    @else
                                    <button type="submit" class="btn-default">Fund now</button>
                                    @endif
                                    <div id="msgSubmit" class="h3 hidden"></div>
                                </div>
                                <!-- Donar Info Form Button End -->
                            </form>
                        </div>
                        <!-- Campaign Donation Form End -->
                    </div>
                    <!-- Donation Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Donation End -->

   

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

<!-- Mirrored from html.awaikenthemes.com/lenity/donation.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Jun 2025 01:10:42 GMT -->
</html>
@endsection