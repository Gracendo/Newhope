@extends('layouts.frontend.header')
@section('home') 

    <!-- Page Header Start -->
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque"><span></span> Orphanges</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Orphanages</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Page Blog Start -->
    <div class="page-blog">
        <div class="container">
            <div class="row">
                @foreach($orphanages as $orphanages)
                <!-- ici pour le for each start -->
                <div class="col-lg-4 col-md-6">
                    <!-- Post Item Start -->
                    <div class="post-item wow fadeInUp">
                        <!-- Post Item Header Start -->
                        <div class="post-item-header">
                            <!-- Post Item Tag Start -->
                            <div class="post-item-meta">
                                <ul>
                                    <li>{{$orphanages->country}}</li>
                                </ul>
                            </div>
                            <!-- Post Item Tag End -->

                            <!-- Post Item Content Start -->
                            <div class="post-item-content">
                                <h2><a href="{{route('orphanage.details',$orphanages->id)}}">{{$orphanages->name}}</a></h2>
                            </div>
                            <!-- Post Item Content End -->
                        </div>
                        <!-- Post Item Header End -->

                        <!-- Post Featured Image Start-->
                        <div class="post-featured-image">
                            <a href="{{route('orphanage.details',$orphanages->id)}}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{Storage::url( $orphanages->logo) }}" alt="{{ $orphanages->name }}">
                                </figure>
                            </a>
                        </div>
                        <!-- Post Featured Image End -->
                        
                        <!-- Blog Item Button Start -->
                        <div class="blog-item-btn">
                            <a href="blog-single.html" class="readmore-btn">read more</a>
                        </div>
                        <!-- Blog Item Button End -->
                    </div>
                    <!-- Post Item End -->
                </div>
                <!-- ici pour le for each end -->@endforeach
               
                
            <!-- ne touche pas les divs ci -->
        </div>
    </div>
    <!-- Page Blog End -->

    

    <!-- Jquery Library File -->
    <script src="js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap js file -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Validator js file -->
    <script src="js/validator.min.js"></script>
    <!-- SlickNav js file -->
    <script src="js/jquery.slicknav.js"></script>
    <!-- Swiper js file -->
    <script src="js/swiper-bundle.min.js"></script>
    <!-- Counter js file -->
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <!-- Isotop js file -->
	<script src="js/isotope.min.js"></script>
    <!-- Magnific js file -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <!-- SmoothScroll -->
    <script src="js/SmoothScroll.js"></script>
    <!-- Parallax js -->
    <script src="js/parallaxie.js"></script>
    <!-- MagicCursor js file -->
    <script src="js/gsap.min.js"></script>
    <script src="js/magiccursor.js"></script>
    <!-- Text Effect js file -->
    <script src="js/SplitText.js"></script>
    <script src="js/ScrollTrigger.min.js"></script>
    <!-- YTPlayer js File -->
    <script src="js/jquery.mb.YTPlayer.min.js"></script>
    <!-- Wow js file -->
    <script src="js/wow.min.js"></script>
    <!-- Main Custom js file -->
    <script src="js/function.js"></script>
</body>

</html>
@endsection