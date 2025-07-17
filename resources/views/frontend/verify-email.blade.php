@extends('layouts.frontend.header')

@section('home')
 <!-- Page Header Start -->
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                         <h1 class="text-anime-style-2" data-cursor="-opaque"><span>Verify your</span> email address</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">home</a></li>
                                
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
     <!--verify start-->
    <div class="page-services">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6"> 
                    <div class="card-body"> 
                            @if (session('status')) 
                                <div class="alert alert-success" >
                                    {{ session('status') }} 
                                </div>
                            @endif

                            <p class="mb-4">
                                Before proceeding, please check your email (<strong>{{ auth()->user()->email }}</strong>) 
                                for a verification link.
                            </p>
                            <p class="mb-4">
                                If you didn't receive the email, 
                                <a href="#" onclick="event.preventDefault(); document.getElementById('resend-form').submit();">
                                    click here to request another
                                </a>.
                            </p>
                    </div>  
                </div>
            </div>
        </div>
    </div>
@endsection