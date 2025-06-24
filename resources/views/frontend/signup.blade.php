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
                            <h3 class="wow fadeInUp">Sign up</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Welcome ,change maker!</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Thankyou for joining our contribution  to support these orphanages. Each contribution contributes in making them more authonomous.</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- Campaign Donation Form Start -->
                        <div class="donate-form campaign-donate-form">
                            <form id="donateForm"  method="post" enctype="multipart/form-data" action="" >
                               @csrf
                                <!-- Donar Personal Info Start -->
                                <div class="donar-personal-info">
                                    <!-- Section Title Start -->
                                    <div class="section-title">
                                        <h2 class="text-anime-style-2" data-cursor="-opaque">Personal <span>info</span></h2>
                                    </div>
                                    <!-- Section Title End -->
                
                                    <div class="row wow fadeInUp" data-wow-delay="0.8s">
                                        <div class="form-group col-md-6 mb-4">
                                            <input type="text" name="username" class="form-control" id="username" placeholder="User Name" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                
                                           <div class="form-group col-md-12 mb-4">
                                            <input type="email" name ="email" class="form-control" id="email" placeholder="Enter your e-mail" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                
                                        <div class="form-group col-md-12 mb-4">
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                
              
                                        
                                    </div>
                                     
                                </div>
                                <!-- Donar Personal Info End -->
                                    <div class="donate-payment-type wow fadeInUp" data-wow-delay="0.6s">
                                        <div class="payment-method">
                                            <input type="checkbox" name="remember"id="remember"  >
                                            <labelfor="remember">{{__('Remember Me')}} </label>
                                        </div>
                                        
                                    </div>
                                    <br>
                                <!-- Donar Info Form Button Start -->
                                <div class="form-group-btn wow fadeInUp" data-wow-delay="1s">
                                    
                                    <button type="submit" class="btn-default"> Register </button>
                                    
                                    <div id="msgSubmit" class="h3 hidden"></div>
                                </div>
                                <!-- Donar Info Form Button End -->
                            </form>
                             <div class="card-footer text-center">
          <small class="text-muted"> Have an account  ? <a href="{{ route('user.login') }}">log in</a></small>
        </div>
                        </div>
                        <!-- Campaign Donation Form End -->
                    </div>
                    <!-- Donation Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Donation End -->


@endsection

