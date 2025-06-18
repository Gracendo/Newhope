@extends('layouts.app_auth')
@section('content')
    <div class="main-container">
      <!-- Body main section starts -->
      <div class="container">
        <div class="row sign-in-content-bg">
          <div class="col-lg-6 image-contentbox d-none d-lg-block">
            <div class="form-container ">
              <div class="signup-content mt-4">
                <span>
                  <img src="{{asset('assets/backend/images/logo/1.png')}}" alt="" class="img-fluid ">
                </span>
              </div>
             
              <div class="signup-bg-img">
                <img src="{{asset('assets/backend/images/login/04.png')}}" alt="" class="img-fluid">
              </div>
            </div>

          </div>
          <div class="col-lg-6 form-contentbox">
            <div class="form-container">
              <form class="app-form" method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="row">
                  <div class="col-12">
                    <div class="mb-5 text-center text-lg-start">
                      <h2 class="text-primary f-w-600">Welcome To NEWHOPE  </h2>
                      <p>Sign in with your data that you enterd during your registration</p>
                    </div>
                  </div>
                  @include('backend.partials.message')
                  <div class="error-message"></div>
                  <div class="col-12">
                    <div class="mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" class="form-control" placeholder="Enter Your Username" id="username">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <a href="#" class="link-primary float-end">Forgot Password ?</a>
                      <input type="password" class="form-control" placeholder="Enter Your Password" id="password">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-check mb-3">
                      <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                      <label class="form-check-label text-secondary" for="checkDefault">
                        Remember me
                      </label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="mb-3">
                      <button id="form_submit" type="submit" class="btn btn-primary w-100">Sign In</button>
                    </div>
                  </div>
                 
                  <div class="app-divider-v justify-content-center">
                    <p>Or sign in with</p>
                  </div>
                  <div class="col-12">
                    <div class="text-center">
                      <button type="button" class="btn btn-facebook icon-btn b-r-22 m-1"><i
                          class="ti ti-brand-facebook text-white"></i></button>
                      <button type="button" class="btn btn-gmail icon-btn b-r-22 m-1"><i
                          class="ti ti-brand-google text-white"></i></button>
                      <button type="button" class="btn btn-github icon-btn b-r-22 m-1"><i
                          class="ti ti-brand-github text-white"></i></button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Body main section ends -->
    </div>
@endsection

@section('scripts')
    <script>
        (function($){
        "use strict";

            $(document).ready(function ($){
                
                $(document).on('click','#form_submit',function (e){
                    e.preventDefault();
                    var el = $(this);
                    var erContainer = $(".error-message");
                    erContainer.html('');
                    el.text('{{__('Veuillez patienter..')}}');
                    $.ajax({
                        url: "{{route('admin.login')}}",
                        type: "POST",
                        data: {
                            _token : "{{csrf_token()}}",
                            username : $('#username').val(),
                            password : $('#password').val(),
                            remember : $('#remember').val(),
                        },
                        error:function(data){
                            var errors = data.responseJSON;
                            erContainer.html('<div class="alert alert-danger"></div>');
                            $.each(errors.errors, function(index,value){
                                erContainer.find('.alert.alert-danger').append('<p>'+value+'</p>');
                            });
                            el.text('{{__('Login')}}');
                        },
                        success:function (data){
                            $('.alert.alert-danger').remove();
                            if (data.status == 'ok'){
                                el.text('{{__('Redirecting')}}..');
                                erContainer.html('<div class="alert alert-'+data.type+'">'+data.msg+'</div>');
                                location.reload();
                            }else{
                                erContainer.html('<div class="alert alert-'+data.type+'">'+data.msg+'</div>');
                                el.text('{{__('Login')}}');
                            }
                        }
                    });
                });

            });
        })(jQuery);
    </script>
@endsection