<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Multipurpose, super flexible, powerful, clean modern responsive bootstrap 5 admin template">
  <meta name="keywords"
    content="admin template, ra-admin admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="la-themes">
  <link rel="icon" href="{{asset('assets/backend/images/logo/favicon.png')}}" type="image/x-icon">
  <link rel="shortcut icon" href="{{asset('assets/backend/images/logo/favicon.png')}}" type="image/x-icon">

  <title>Sign In | ra-admin - Premium Admin Template</title>

  <!--font-awesome-css-->
  <link rel="stylesheet" href="{{asset('assets/backend/vendor/fontawesome/css/all.css')}}">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">

  <!-- tabler icons-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/vendor/tabler-icons/tabler-icons.css')}}">

  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/vendor/bootstrap/bootstrap.min.css')}}">

  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/style.css')}}">

  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/responsive.css')}}">

</head>

<body class="sign-in-bg">
  <div class="app-wrapper d-block">

    @yield('content')

</div>
  <!-- latest jquery-->
  <script src="{{asset('assets/backend/js/jquery-3.6.3.min.js')}}"></script>

  <!-- Bootstrap js-->
  <script src="{{asset('assets/backend/vendor/bootstrap/bootstrap.bundle.min.js')}}"></script>

</body>

</html>