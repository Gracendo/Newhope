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
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('user.home')}}">dashboard</a></li>
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
                            <h3><a href="{{route('user.mycampaigns')}}">Total Campaigns</a></h3>
                            <p>You participated in <b style="color:
                            rgb(251,109,2)">{{ $volunteerStats['totalCampaigns'] ?? 0 }}</b> Campaigns</p>
                        </div>
                        <div class="service-btn">
                            <a href="{{route('user.mycampaigns')}}" class="readmore-btn">see all</a> <!-- href to my campaigns-->
                        </div>
                    </div>
                    <!-- Services Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Services Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-content">
                            <h3><a href="{{route('user.mycampaigns')}}">Pending Volunteering Request</a></h3>
                            <p>You have <b style="color:
                            rgb(251,109,2)">{{ $volunteerStats['pendingRequests'] ?? 0 }}</b> pending request </p>
                        </div>
                         <div class="service-btn">
                            <a href="{{route('user.mycampaigns')}}" class="readmore-btn">see all</a> <!-- href to my campaigns-->
                        </div>
                    </div>
                    <!-- Services Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Services Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="service-content">
                            <h3><a href="{{route('user.mycampaigns')}}">Approved Volunteering Request</a></h3>
                             <p>You have <b style="color:
                            rgb(251,109,2)">{{$volunteerStats['approvedRequests'] ?? 0 }}</b> approved request </p>
                        </div>
                         <div class="service-btn">
                            <a href="{{route('user.mycampaigns')}}" class="readmore-btn">see all</a> <!-- href to my campaigns-->
                        </div>
                    </div>
                    <!-- Services Item End -->
                </div>
            <div class="col-lg-4 col-md-6">
                    <!-- Services Item Start -->
                    <div class="service-item wow fadeInUp">
                        <div class="service-content">
                            <h3><a href="{{route('user.mycampaigns')}}">Total Volunteering Experience</a></h3>
                            <p>You volunteered  in <b style="color:
                            rgb(251,109,2)">{{ $volunteerStats['totalExperience'] ?? 0 }}</b> Campaigns</p>
                        </div>
                        <div class="service-btn">
                            <a href="{{route('user.mycampaigns')}}" class="readmore-btn">see all</a> <!-- href to my campaigns-->
                        </div>
                    </div>
                    <!-- Services Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Services Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service-content">
                            <h3><a href="{{route('user.donations')}}">Donnations</a></h3>
                             <p>You donated a total of <b style="color:
                            rgb(251,109,2)">{{ number_format($donationStats['monthlyDonations'] ?? 0) }} FCFA</b> this month !</p>
                        </div>
                         <div class="service-btn">
                            <a href="{{route('user.donations')}}" class="readmore-btn">see all</a> <!-- href to donations-->
                        </div>
                    </div>
                    <!-- Services Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Services Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="1s">
                        <div class="service-content">
                            <h3><a href="{{route('user.rewards')}}">Rewards</a></h3>
                            <p>You won a total of <b style="color:
                            rgb(251,109,2)">0 </b> Rewards this month</p>
                        </div> 
                         <div class="service-btn">
                            <a href="{{route('user.rewards')}}" class="readmore-btn">see all</a> <!-- href to my rewards-->
                        </div>
                    </div>
                    <!-- Services Item End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Services End -->


@endsection