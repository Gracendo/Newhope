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
                            <h3 class="wow fadeInUp">Log in</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Welcome back,change maker!</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Thankyou for every contribution you give to support these orphanages. Each contribution contributes in making them more authonomous.</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- Campaign Donation Form Start -->
                        <div class="donate-form campaign-donate-form">
                            <form id="donateForm"  method="post" enctype="multipart/form-data" action="{{ route('user.login') }}" method="POST">
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
                                    
                                    <button type="submit" class="btn-default">Log in</button>
                                    
                                    <div id="msgSubmit" class="h3 hidden"></div>
                                </div>
                                <!-- Donar Info Form Button End -->
                            </form>
                             <div class="card-footer text-center">
          <small class="text-muted">Do not have an account yet ? <a href="{{ route('user.register') }}">Create an account</a></small>
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

@section('scripts')
    <script>
        (function($){
            "use strict";
            $(document).on('click', '#login_btn', function (e) {
                e.preventDefault();
                var formContainer = $('#login_form_order_page');
                var el = $(this);
                var username = formContainer.find('input[name="username"]').val();
                var password = formContainer.find('input[name="password"]').val();
                var remember = formContainer.find('input[name="remember"]').val();

                el.text('{{__("Please Wait")}}');

                $.ajax({
                    type: 'post',
                    url: "{{route('user.ajax.login')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        username : username,
                        password : password,
                        remember : remember,
                    },
                    success: function (data){
                        if(data.status == 'invalid'){
                            el.text('{{__("Login")}}')
                            formContainer.find('.error-wrap').html('<div class="alert alert-danger">'+data.msg+'</div>');
                        }else{
                            formContainer.find('.error-wrap').html('');
                            el.text('{{__("Login Success.. Redirecting ..")}}');
                            location.reload();
                        }
                    },
                    error: function (data){
                        var response = data.responseJSON.errors;
                        formContainer.find('.error-wrap').html('<ul class="alert alert-danger"></ul>');
                        $.each(response,function (value,index){
                            formContainer.find('.error-wrap ul').append('<li>'+index+'</li>');
                        });
                        el.text('{{__("Login")}}');
                    }
                });
            });
        })(jQuery)
    </script>
@endsection