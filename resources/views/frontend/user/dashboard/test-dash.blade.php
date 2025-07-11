@extends('layouts.frontend.user.header')
@section('user_dash')
 <!-- Page Header Start -->
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque"> <span></span> DASHBOARD</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('test')}}">dashboard</a></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <!-- dashboard content start -->
    <!-- Page Services Start -->
    <div class="page-services">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Services Item Start -->
                    <div class="service-item wow fadeInUp">
                        <div class="service-content">
                            <h3><a href="service-single.html">Total Campaigns</a></h3>
                            <p>You participated in <b style="color:
                            rgb(251,109,2)">100</b> Campaigns</p>
                        </div>
                        <div class="service-btn">
                            <a href="" class="readmore-btn">see all</a> <!-- href to my campaigns-->
                        </div>
                    </div>
                    <!-- Services Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Services Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-content">
                            <h3><a href="service-single.html">Pending Volunteering Request</a></h3>
                            <p>You have <b style="color:
                            rgb(251,109,2)">10</b> pending request </p>
                        </div>
                         <div class="service-btn">
                            <a href="" class="readmore-btn">see all</a> <!-- href to my campaigns-->
                        </div>
                    </div>
                    <!-- Services Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Services Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="service-content">
                            <h3><a href="service-single.html">Approved Volunteering Request</a></h3>
                             <p>You have <b style="color:
                            rgb(251,109,2)">10</b> approved request </p>
                        </div>
                         <div class="service-btn">
                            <a href="" class="readmore-btn">see all</a> <!-- href to my campaigns-->
                        </div>
                    </div>
                    <!-- Services Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Services Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service-content">
                            <h3><a href="service-single.html">Donnations</a></h3>
                             <p>You donated a total of <b style="color:
                            rgb(251,109,2)">100000</b> this month !</p>
                        </div>
                         <div class="service-btn">
                            <a href="" class="readmore-btn">see all</a> <!-- href to donations-->
                        </div>
                    </div>
                    <!-- Services Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Services Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="1s">
                        <div class="service-content">
                            <h3><a href="service-single.html">Rewards</a></h3>
                            <p>You donated a total of <b style="color:
                            rgb(251,109,2)">3</b> Rewards this month</p>
                        </div> 
                         <div class="service-btn">
                            <a href="" class="readmore-btn">see all</a> <!-- href to my rewards-->
                        </div>
                    </div>
                    <!-- Services Item End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Services End -->


@endsection