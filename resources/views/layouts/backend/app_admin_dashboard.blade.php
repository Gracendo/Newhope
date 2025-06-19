<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="">
  <meta name="keywords"
    content="">
  <meta name="author" content="">
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/frontend/images/favicon.png')}}">
  <title>admin_dasboard</title>
  <!--font-awesome-css-->
  <link rel="stylesheet" href="{{asset('assets/backend/vendor/fontawesome/css/all.css')}}">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">

  <!-- prism css-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/vendor/prism/prism.min.css')}}">

  <!-- Animation css -->
  <link rel="stylesheet" href="{{asset('assets/backend/vendor/animation/animate.min.css')}}">

  <!-- tabler icons-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/vendor/tabler-icons/tabler-icons.css')}}">

  <!--flag Icon css-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/vendor/flag-icons-master/flag-icon.css')}}">

  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/vendor/bootstrap/bootstrap.min.css')}}">

  <!-- apexcharts css-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/vendor/apexcharts/apexcharts.css')}}">

  <!-- simplebar css-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/vendor/simplebar/simplebar.css')}}">

  <!-- slick css -->
  <link rel="stylesheet" href="{{asset('assets/backend/vendor/slick/slick.css')}}">
  <link rel="stylesheet" href="{{asset('assets/backend/vendor/slick/slick-theme.css')}}">

  <!-- Data Table css-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/vendor/datatable/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/vendor/datatable/datatable2/buttons.dataTables.min.css')}}">

  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/style.css')}}">

  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/responsive.css')}}">
</head>

<body>
  <div class="app-wrapper">
    <div class="loader-wrapper">
      <div class="app-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    @include('layouts.backend.admin_sidebar')
     <div class="app-content">
      <div class="">
        @include('layouts.backend.admin_header')
        @yield('content')
        </div>
    </div>
    <!-- Body main section ends -->
        @include('layouts.backend.admin_footer')
         </div>



  <!--customizer-->
  <div id="customizer"></div>

  <!-- latest jquery-->
  <script src="{{asset('assets/backend/js/jquery-3.6.3.min.js')}}"></script>

  <!-- Bootstrap js-->
  <script src="{{asset('assets/backend/vendor/bootstrap/bootstrap.bundle.min.js')}}"></script>

  <!-- Simple bar js-->
  <script src="{{asset('assets/backend/vendor/simplebar/simplebar.js')}}"></script>

  <!-- chart js -->
  <script src="{{asset('assets/backend/vendor/chartjs/chart.js')}}"></script>

  <!-- latest jquery-->
  <script src="{{asset('assets/backend/vendor/datatable/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/backend/vendor/datatable/datatable2/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('assets/backend/vendor/datatable/datatable2/jszip.min.js')}}"></script>
  <script src="{{asset('assets/backend/vendor/datatable/datatable2/pdfmake.min.js')}}"></script>
  <script src="{{asset('assets/backend/vendor/datatable/datatable2/vfs_fonts.js')}}"></script>
  <script src="{{asset('assets/backend/vendor/datatable/datatable2/buttons.html5.min.js')}}"></script>
  <script src="{{asset('assets/backend/vendor/datatable/datatable2/buttons.print.min.js')}}"></script>

  <!-- data table js-->
  <script src="{{asset('assets/backend/js/data_table.js')}}"></script>

  <!-- slick-file -->
  <script src="{{asset('assets/backend/vendor/slick/slick.min.js')}}"></script>

  <!-- apexcharts -->
  <script src="{{asset('assets/backend/vendor/apexcharts/apexcharts.min.js')}}"></script>

  <!-- Customizer js-->
  <script src="{{asset('assets/backend/js/customizer.js')}}"></script>

  <!-- phosphor js -->
  <script src="{{asset('assets/backend/vendor/phosphor/phosphor.js')}}"></script>

  <!-- sortable js  -->
  <script src="{{asset('assets/backend/vendor/sortable/Sortable.min.js')}}"></script>

  <!-- prism js-->
  <script src="{{asset('assets/backend/vendor/prism/prism.min.js')}}"></script>

  <!-- Project Dashboard js-->
  <script src="{{asset('assets/backend/js/project_dashboard.js')}}"></script>

  <!-- App js-->
  <script src="{{asset('assets/backend/js/script.js')}}"></script>

</body>

</html>
