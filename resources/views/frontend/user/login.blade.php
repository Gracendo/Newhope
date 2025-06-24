@extends('layouts.frontend.header')
@section('home')
<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-header text-center">
          <h5 class="mb-0">Connexion</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('user.login') }}" method="post" enctype="multipart/form-data" class="account-form" id="login_form_order_page">
            @csrf
            <div class="error-wrap"></div>
            <div class="mb-3">
              <label for="text" class="form-label">Nom d'utilisateur</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="ex: user" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Mot de passe</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
            </div>

            <div class="col-6 mt-3 mb-3">
                <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                    <label class="custom-control-label" for="remember">{{__('Remember Me')}}</label>
                </div>
            </div>

            <div class="d-grid">
              <button type="submit" id="login_btn" class="btn btn-primary">Se connecter</button>
            </div>
          </form>
        </div>
        <div class="card-footer text-center">
          <small class="text-muted">Pas encore inscrit ? <a href="{{ route('user.register') }}">Créer un compte</a></small>
        </div>
      </div>
    </div>
  </div>
</div>

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