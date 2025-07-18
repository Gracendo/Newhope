@extends('layouts.frontend.header')
@section('home')
<!-- Page Header Start -->
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque">Account<span> PENDING</span> </h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">home</a></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="page-services">
        <div class="container">
            <div class="row">
                <div class="col-lg-17 col-md-16">
                    <div class="container py-5">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header bg-warning">Pending Approval</div>

                                    <div class="card-body">
                                        <div class="alert alert-info">
                                            <h4 class="alert-heading">Thank you for verifying your email!</h4>
                                            <p>Your orphanage manager account is pending approval from our administrators.</p>
                                            <p>You will receive an email notification once your account has been approved.</p>
                                            <hr>
                                            <p class="mb-0">If you have any questions, please contact our support team.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection