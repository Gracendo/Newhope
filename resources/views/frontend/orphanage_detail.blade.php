@extends('layouts.frontend.header')
@section('home')
    <!-- Page Header Start -->
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque"><span>{{ $orphanage->name }}</span></h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('orphanage') }}">campaigns</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $orphanage->name }}</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
     <!-- Page Single Post Start -->
    <div class="page-single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Post Featured Image Start -->
                    <div class="post-image">
                        <figure class="image-anime reveal">
                             <img src="{{Storage::url( $orphanage->logo) }}" alt="{{ $orphanage->name }}">

                        </figure>
                    </div>
                    <!-- Post Featured Image Start -->

                    <!-- Post Single Content Start -->
                    <div class="post-content">
                        <!-- Post Entry Start -->
                        <div class="post-entry">
                            <p class="wow fadeInUp">{{ $orphanage->description }}</p>

                            <!-- <p class="wow fadeInUp" data-wow-delay="0.2s">By working hand-in-hand with local communities, governments, and global partners, we aim to create a balanced relationship between humans and nature. Together, we can ensure that forests continue to thrive, supporting livelihoods, wildlife, and the planet for years to come.</p>
                            
                            <blockquote class="wow fadeInUp" data-wow-delay="0.4s">
                                <p>Safeguarding forests is essential for our planet's health and future generations. Through reforestation, sustainable practices, and community engagement, we aim to protect ecosystems, combat climate change, preserve biodiversity.</p>
                            </blockquote>

                            <p class="wow fadeInUp" data-wow-delay="0.6s">Our mission focuses on protecting forests to preserve biodiversity, combat climate change, and support sustainable livelihoods. Through reforestation, conservation efforts, and community partnerships, we work to ensure a greener, healthier future for our planet.</p> -->

                            <h2 class="wow fadeInUp" data-wow-delay="0.8s">{{ $orphanage->name }} Contact Information</h2>

                            <p class="wow fadeInUp" data-wow-delay="1s">Please feel free to reachout to us for more information .We shall be glad to receive you at our orphanage ,pay us a visit at your convinience.</p>

                            <ul class="wow fadeInUp" data-wow-delay="1.2s">
                                <li><b>Country :</b> {{ $orphanage->country }}</li>
                                <li><b>Region :</b>{{ $orphanage->region }}</li>
                                <li><b>City :</b>{{ $orphanage->city }}</li>
                                <li><b>Address :</b>{{ $orphanage->address }}</li>
                                <li><b>email :</b>{{ $orphanage->email }}</li>
                            </ul>
                            
                            </div>
                        <!-- Post Entry End -->

                        <!-- Post Tag Links Start -->
                        <div class="post-tag-links">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <!-- Post Tags Start -->
                                    <div class="post-tags wow fadeInUp" data-wow-delay="0.5s">
                                        <span class="tag-links">
                                            
                                            <a href="{{ route('orphanage.donate', $orphanage->id) }}">Support Orphanage</a>
                                        </span>
                                    </div>
                                    <!-- Post Tags End -->
                                </div>

                                <div class="col-lg-4">
                                    <!-- Post Social Links Start -->
                                    <!-- <div class="post-social-sharing wow fadeInUp" data-wow-delay="0.5s">
                                        <ul>
                                            <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                        </ul>
                                    </div> -->
                                    <!-- Post Social Links End -->
                                </div>
                            </div>
                        </div>
                        <!-- Post Tag Links End -->
                    </div>
                    <!-- Post Single Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Single Post End -->

@endsection