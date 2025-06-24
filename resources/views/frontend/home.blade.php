@extends('layouts.frontend.header')
@section('home')

    <!-- Hero Section Start -->
    <div class="hero parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <!-- Hero Content Start -->
                    <div class="hero-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">welcome Changemaker </h3>
                            <h1 class="text-anime-style-2" data-cursor="-opaque"><span>Empower change</span>, one act of kindness at a time</h1>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Join us in creating brighter futures by providing hope, delivering help,
                                 and fostering lasting change for Cameroon orphanages</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- Hero Content Body Start -->
                        <div class="hero-body wow fadeInUp" data-wow-delay="0.4s">
                            <!-- Hero Button Start -->
                            <div class="hero-btn">
                                <a href="donation.html" class="btn-default">donate now</a>
                            </div>
                            
                        </div>
                        <!-- Hero Content Body End -->  
                        
                        <!-- Hero Footer Start -->
                        <div class="hero-footer wow fadeInUp" data-wow-delay="0.6s">
                            <div class="hero-list">
                                <ul>
                                    <li>Education and Skill Development</li>
                                    <li>Women and Youth Empowerment</li>
                                </ul>
                            </div>

                            <div class="hero-help-families">
                                <h3>help Cameroon orphanages</h3>
                                <p>Your gift of 10,000 FCFA can feed 40 children</p>
                            </div>
                        </div>
                        <!-- Hero Footer End -->
                    </div>
                    <!-- Hero Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Section End -->

    <!-- About Us Section Start -->
    <div class="about-us" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- About Us Images Start -->
                    <div class="about-us-images">
                        <!-- About Image 1 Start -->
                        <div class="about-img-1">
                            <figure class="image-anime">
                                <img src="{{asset('assets/frontend/images/about-img-1.jpg')}}" alt="">
                            </figure>
                        </div>
                        <!-- About Image 1 End -->

                        <!-- About Image 2 Start -->
                        <div class="about-img-2">
                            <figure class="image-anime">
                                <img src="{{asset('assets/frontend/images/about-img-2.jpg')}}" alt="">
                            </figure>
                        </div>
                        <!-- About Image 2 End -->

                        <!-- Need Fund Box Start -->
                        <div class="need-fund-box">
                            <img src="{{asset('assets/frontend/images/icon-funded-dollar.svg')}}" alt="">
                            <p>We've funded <span class="counter">1</span>M FCFA</p>
                        </div>
                        <!-- Need Fund Box End -->
                    </div>
                    <!-- About Us Images End -->
                </div>

                <div class="col-lg-6">
                    <!-- About Us Content Start -->
                    <div class="about-us-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">about us</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">United in compassion, changing lives</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Driven by compassion and a shared vision, we work hand-in-hand with orphanages to create meaningful change.</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- About Body Start -->
                        <div class="about-us-body">
                            <div class="about-us-body-content">
                                <!-- About Support Box Start -->
                                <div class="about-support-box wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="icon-box">
                                        <img src="{{asset('assets/frontend/images/icon-about-support.svg')}}" alt="">
                                    </div>
                                    <!-- About Support Content Start -->
                                    <div class="about-support-content">
                                        <h3>Project Support</h3>
                                        <p>Providing financial aid and expert assistnce to orphanages.</p>
                                    </div>
                                    <!-- About Support Content End -->
                                </div>
                                <!-- About Support Box End -->
                                
                                <!-- About Button Start -->
                                <div class="about-btn wow fadeInUp" data-wow-delay="0.6s">
                                    <a href="about.html" class="btn-default">about us</a>
                                </div>
                                <!-- About Button End -->
                            </div>

                            <!-- Helped Fund Item Start -->
                            <div class="helped-fund-item">
                                <div class="helped-fund-img">
                                    <figure class="image-anime">
                                        <img src="{{asset('assets/frontend/images/helped-fund-img.jpg')}}" alt="">
                                    </figure>
                                </div>
                                <div class="helped-fund-content">
                                    <h2><span class="counter">5,958</span></h2>
                                    <h3>helped fund</h3>
                                    <p>Supporting growth through orphanage- funding.</p>
                                </div>
                            </div>
                            <!-- Helped Fund Item End -->
                        </div>
                        <!-- About Body End -->
                    </div>
                    <!-- About Us Content End -->
                </div>
            </div>
        </div>
    </div>
     <!-- What We Do Section Start -->
    <div class="what-we-do">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- What We Do Content Start -->
                    <div class="what-we-do-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">what we do</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Building hope creating lasting change</h2>
                        </div>
                        <!-- Section Title End -->

                        <!-- what We List Start -->
                        <div class="what-we-list">
                            <!-- What We Item Start -->
                            <div class="what-we-item wow fadeInUp" data-wow-delay="0.2s">
                                <div class="icon-box">
                                    <img src="{{asset('assets/frontend/images/icon-what-we-1.svg')}}" alt="">
                                </div>
                                <div class="what-we-item-content">
                                    <h3>economic empowerment</h3>
                                    <p>Empowering individuals orphanages by, financing their  small businesses  to create sustainable livelihoods.</p>
                                </div>
                            </div>
                            <!-- What We Item End -->
                             <!-- What We Item Start -->
                            <div class="what-we-item wow fadeInUp" data-wow-delay="0.6s">
                                <div class="icon-box">
                                    <img src="{{asset('assets/frontend/images/icon-what-we-3.svg')}}" alt="">
                                </div>
                                <div class="what-we-item-content">
                                    <h3>expert assistance</h3>
                                    <p>Providing free expert guidance in their business, to create lifelong businesses.</p>
                                </div>
                            </div>
                            <!-- What We Item End -->

                            <!-- What We Item Start -->
                            <div class="what-we-item wow fadeInUp" data-wow-delay="0.4s">
                                <div class="icon-box">
                                    <img src="{{asset('assets/frontend/images/icon-what-we-2.svg')}}" alt="">
                                </div>
                                <div class="what-we-item-content">
                                    <h3>financial aid</h3>
                                    <p>Provide financial assistance to orphanages to support them in order to create sustainable livelihoods.</p>
                                </div>
                            </div>
                            <!-- What We Item End -->

                            
                        </div>
                        <!-- what We List End -->
                    </div>
                    <!-- What We Do Content End -->
                </div>
                <div class="col-lg-6">
                    <!-- What We Do Images Start -->
                    <div class="what-we-do-images">
                        <!-- What We Do Image 1 Start -->
                        <div class="what-we-do-img-1">
                            <figure class="image-anime reveal">
                                <img src="{{asset('assets/frontend/images/what-we-do-image-1.jpg')}}" alt="">
                            </figure>
                        </div>
                        <!-- What We Do Image 1 End -->

                        <!-- What We Do Image 2 Start -->
                        <div class="what-we-do-img-2">
                            <figure class="image-anime">
                                <img src="{{asset('assets/frontend/images/what-we-do-image-2.jpg')}}" alt="">
                            </figure>
                        </div>
                        <!-- What We Do Image 2 End -->

                        <!-- Donate Now Box Start -->
                        <div class="donate-now-box">
                            <a href="donation.html"><img src="{{asset('assets/frontend/images/icon-donate-now.svg')}}" alt="">donate now</a>
                        </div>
                        <!-- Donate Now Box End -->
                    </div>
                    <!-- What We Do Images End -->
                </div>
            </div>
        </div>
    </div>
    <!-- What We Do Section End -->
      <!-- Our Causes Section Start -->
   <div class="our-causes" id="orphanage">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">our orphanages</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Supporting local orphanages</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">We focus on providing a meaningful aid to local orphanages.Each fcfa you give can impact a child's life;from healthcare and education to food security and for lasting change.</p>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Causes Item Start -->
                    <div class="causes-item wow fadeInUp">
                        <div class="causes-image">
                            <figure class="image-anime">
                                <img src="{{asset('assets/frontend/images/causes-img-1.jpeg')}}" alt="">
                            </figure>
                        </div>
                        <div class="causes-body">
                            <div class="causes-content">
                                <h3>Saint Therese Orphanage</h3>
                                <p>Founded in 2003, run by the Sisters of the Catholic Religious Congregation "SŒURS MISSIONNAIRES DE LA RESURRECTION</p>
                            </div>
                            <div class="causes-button">
                                <a href="donation.html" class="btn-default">donate now</a>
                            </div>
                        </div>
                    </div>
                    <!-- Causes Item End -->
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <!-- Causes Item Start -->
                    <div class="causes-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="causes-image">
                            <figure class="image-anime">
                                <img src="{{asset('assets/frontend/images/causes-img-2.jpeg')}}" alt="">
                            </figure>
                        </div>
                        <div class="causes-body">
                            <div class="causes-content">
                                <h3>Mah Di's Orphanage</h3>
                                <p>One of two community schools and orphanages supported by GlobalGiving project, serving 250 children in total</p>
                            </div>
                            <div class="causes-button">
                                <a href="donation.html" class="btn-default">donate now</a>
                            </div>
                        </div>
                    </div>
                    <!-- Causes Item End -->
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <!-- Causes Item Start -->
                    <div class="causes-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="causes-image">
                            <figure class="image-anime">
                                <img src="{{asset('assets/frontend/images/causes-img-3.jpeg')}}" alt="">
                            </figure>
                        </div>
                        <div class="causes-body">
                            <div class="causes-content">
                                <h3>Hope Alive Orphanage</h3>
                                <p>Part of the same project as Mah Di's, helping children in conflict areas</p>
                            </div>
                            <div class="causes-button">
                                <a href="donation.html" class="btn-default">donate now</a>
                            </div>
                        </div>
                    </div>
                    <!-- Causes Item End -->
                </div>
            </div>
        </div>
   </div>
   <!-- Our Causes Section End -->
    <!-- About Us Section End -->

    
            
                
                

                <div class="col-lg-12">
                    <!-- Service Contact Text Start -->
                    <div class="section-footer-text wow fadeInUp" data-wow-delay="0.6s">
                        <p>You will be satisfy with our work. Contact us today <a href="tel:+237698696114">(+237) 698 696 114</a></p>
                    </div>
                    <!-- Service Contact Text End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Services Section End -->

   

   
    
   <!-- Why Choose Us Section Start -->
   <div class="why-choose-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- Why Choose Images Start -->
                    <div class="why-choose-images">
                        <div class="why-choose-image-1">
                            <figure class="image-anime">
                                <img src="{{asset('assets/frontend/images/why-choose-img-1.jpeg')}}" alt="">
                            </figure>
                        </div>
                        <div class="why-choose-image-2">
                            <figure class="image-anime">
                                <img src="{{asset('assets/frontend/images/why-choose-img-2.jpeg')}}" alt="">
                            </figure>
                        </div>
                    </div>
                    <!-- Why Choose Images End -->
                </div>
                
                <div class="col-lg-6">
                    <!-- Why Choose Content Start -->
                    <div class="why-choose-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">why choose us</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Why we stand out together</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Our dedication, transparency, and community-driven approach set us apart. partnering with us,programs that create meaningful change.</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- Why Choose List Start -->
                        <div class="why-choose-list wow fadeInUp" data-wow-delay="0.4s">
                            <ul>
                                <li>community-centered approach</li>
                                <li>transparency and accountability</li>
                                <li>empowerment through partner</li>
                                <li>volunteer and donor engagement</li>
                            </ul>
                        </div>
                        <!-- Why Choose List End -->

                        <!-- Why Choose Counters Start -->
                        <div class="why-choose-counters">
                            <!-- Why Choose Counters Item Start -->
                            <div class="why-choose-counter-item">
                                <h2><span class="counter">25</span>+</h2>
                                <p>Years of experience</p>
                            </div>
                            <!-- Why Choose Counters Item End -->
                            
                            <!-- Why Choose Counters Item Start -->
                            <div class="why-choose-counter-item">
                                <h2><span class="counter">230</span>+</h2>
                                <p>Thousands volunteers</p>
                            </div>
                            <!-- Why Choose Counters Item End -->
                            
                            <!-- Why Choose Counters Item Start -->
                            <div class="why-choose-counter-item">
                                <h2><span class="counter">100</span>+</h2>
                                <p>Cameroon orphanages</p>
                            </div>
                            <!-- Why Choose Counters Item End -->
                        </div>
                        <!-- Why Choose Counters End -->
                    </div>
                    <!-- Why Choose Content End -->
                </div>
            </div>
        </div>
   </div>
   <!-- Why Choose Us Section End -->

   <!-- Our Program Section Start -->
   <div class="our-program" id="campaign">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">our campaigns</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Empowering our programs</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">Our programs are designed to create sustainable change by addressing community needs, empowering orphanages, long-term development through crowdfunding.</p>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Program Item Start -->
                    <div class="program-item wow fadeInUp">
                        <div class="program-image">
                            <a href="program-single.html" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{asset('assets/frontend/images/program-1.jpg')}}" alt="">
                                </figure>
                            </a>
                        </div>
                        <div class="program-body">
                            <div class="program-content">
                                <h3><a href="program-single.html">Aqua farm </a></h3>
                                <p>We aim at rairing about 200 fish in a 400m squared or more man made lakes</p>
                            </div>
                            <div class="program-button">
                                <a href="program-single.html" class="readmore-btn">read more</a>
                            </div>
                        </div>
                    </div>
                    <!-- Program Item End -->                    
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <!-- Program Item Start -->
                    <div class="program-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="program-image">
                            <a href="program-single.html" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{asset('assets/frontend/images/program-2.jpg')}}" alt="">
                                </figure>
                            </a>
                        </div>
                        <div class="program-body">
                            <div class="program-content">
                                <h3><a href="program-single.html">Hope pig farm</a></h3>
                                <p>With low amount of resources, we aim at producing a large amount of pigs.</p>
                            </div>
                            <div class="program-button">
                                <a href="program-single.html" class="readmore-btn">read more</a>
                            </div>
                        </div>
                    </div>
                    <!-- Program Item End -->                    
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <!-- Program Item Start -->
                    <div class="program-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="program-image">
                            <a href="program-single.html" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{asset('assets/frontend/images/program-3.jpg')}}" alt="">
                                </figure>
                            </a>
                        </div>
                        <div class="program-body">
                            <div class="program-content">
                                <h3><a href="program-single.html">Chicken farming prooject</a></h3>
                                <p>We aim first toincrease our base of 23 chickens to a hundred ,then supply to clients.</p>
                            </div>
                            <div class="program-button">
                                <a href="program-single.html" class="readmore-btn">read more</a>
                            </div>
                        </div>
                    </div>
                    <!-- Program Item End -->                    
                </div>

                <div class="col-lg-12">
                    <!-- Service Contact Text Start -->
                    <div class="section-footer-text wow fadeInUp" data-wow-delay="0.6s">
                        <p>Your monthly <a href="#">gift of 1000FCFA</a> ensures that kids living in poverty have access to life - changing benefits</p>
                    </div>
                    <!-- Service Contact Text End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Program Section End -->


    

    <!-- Donate Now Section Start -->
    <div class="donate-now parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="intro-video-box">
                        <!-- Video Play Button Start -->
                        <div class="video-play-button">
                            <a href="https://www.youtube.com/watch?v=z0Nr_QBry5s" class="popup-video" data-cursor-text="Play">
                                <i class="fa-solid fa-play"></i>
                            </a>
                        </div>
                        <!-- Video Play Button End -->

                        <!-- Company Success Slider Start -->
                        <div class="donar-company-slider">
                            <div class="swiper">
                                <div class="swiper-wrapper" data-cursor-text="Drag">
                                    <!-- Client Logo Start -->
                                    <div class="swiper-slide">
                                        <div class="donar-company-logo">
                                            <img src="{{asset('assets/frontend/images/donar-company-logo-1.png')}}" alt="">
                                        </div>
                                    </div>
                                    <!-- Client Logo End -->

                                    <!-- Client Logo Start -->
                                    <div class="swiper-slide">
                                        <div class="donar-company-logo">
                                            <img src="{{asset('assets/frontend/images/donar-company-logo-2.png')}}" alt="">
                                        </div>
                                    </div>
                                    <!-- Client Logo End -->

                                    <!-- Client Logo Start -->
                                    <div class="swiper-slide">
                                        <div class="donar-company-logo">
                                            <img src="{{asset('assets/frontend/images/donar-company-logo-3.png')}}" alt="">
                                        </div>
                                    </div>
                                    <!-- Client Logo End -->
                                    
                                    <!-- Client Logo Start -->
                                    <div class="swiper-slide">
                                        <div class="donar-company-logo">
                                            <img src="{{asset('assets/frontend/images/donar-company-logo-1.png')}}" alt="">
                                        </div>
                                    </div>
                                    <!-- Client Logo End -->
                                    
                                    <!-- Client Logo Start -->
                                    <div class="swiper-slide">
                                        <div class="donar-company-logo">
                                            <img src="{{asset('assets/frontend/images/donar-company-logo-2.png')}}" alt="">
                                        </div>
                                    </div>
                                    <!-- Client Logo End -->

                                    <!-- Client Logo Start -->
                                    <div class="swiper-slide">
                                        <div class="donar-company-logo">
                                            <img src="{{asset('assets/frontend/images/donar-company-logo-3.png')}}" alt="">
                                        </div>
                                    </div>
                                    <!-- Client Logo End -->
                                </div>
                            </div>
                        </div>
                        <!-- Company Success Slider End -->
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- Donate Box Start -->
                    <div class="donate-box">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">donate now</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Donate us</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Your generous support enables to continue its mission of spreading God's love and serving our community.</p>
                        </div>
                        <!-- Section Title End -->

                        <div class="donate-form wow fadeInUp" data-wow-delay="0.4s">
                            <form id="donateForm" action="#" method="POST">
                                <div class="form-group mb-4">
                                    <input type="text" name="text" class="form-control" placeholder="$ 100.00" required>
                                </div>

                                <fieldset class="donate-value-box">                                  
                                    <div class="donate-value">
                                        <input type="radio" id="value1" name="value" value="value1" checked>
                                        <label for="value1">$ 100.00</label>
                                      </div>
                                    
                                      <div class="donate-value">
                                        <input type="radio" id="value2" name="value" value="value2">
                                        <label for="value2">$ 200.00</label>
                                      </div>
                                    
                                      <div class="donate-value">
                                        <input type="radio" id="value3" name="value" value="value3">
                                        <label for="value3">$ 300.00</label>
                                      </div>
                                      
                                      <div class="donate-value">
                                          <input type="radio" id="value4" name="value" value="value4">
                                          <label for="value4">$ 400.00</label>
                                      </div>
                                      
                                      <div class="donate-value">
                                          <input type="radio" id="value5" name="value" value="value5">
                                          <label for="value5">$ 500.00</label>
                                      </div>
                                      
                                      <div class="donate-value">
                                          <input type="radio" id="value6" name="value" value="value6">
                                          <label for="value6">$ 600.00</label>
                                      </div>
                                </fieldset>

                                <div class="form-group-btn">
                                    <button type="submit" class="btn-default">donate now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Donate Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Donate Now Section End -->


    <!-- Our Blog Section Start -->
    <div class="our-blog" id="blog">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">latest post</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Stories of impact and hope</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">Explore inspiring stories and updates about our initiatives, successes, and the lives we've touched. See how your support is creating real, lasting change in communities worldwide.</p>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Post Item Start -->
                    <div class="post-item wow fadeInUp">
                        <!-- Post Item Header Start -->
                        <div class="post-item-header">
                            <!-- Post Item Tag Start -->
                            <div class="post-item-meta">
                                <ul>
                                    <li>10 feb, 2025</li>
                                </ul>
                            </div>
                            <!-- Post Item Tag End -->

                            <!-- Post Item Content Start -->
                            <div class="post-item-content">
                                <h2><a href="blog-single.html">Chicken farming project</a></h2>
                            </div>
                            <!-- Post Item Content End -->
                        </div>
                        <!-- Post Item Header End -->

                        <!-- Post Featured Image Start-->
                        <div class="post-featured-image">
                            <a href="blog-single.html" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{asset('assets/frontend/images/post-1.jpeg')}}" alt="">
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

                <div class="col-lg-4 col-md-6">
                    <!-- Post Item Start -->
                    <div class="post-item wow fadeInUp" data-wow-delay="0.2s">
                        <!-- Post Item Header Start -->
                        <div class="post-item-header">
                            <!-- Post Item Tag Start -->
                            <div class="post-item-meta">
                                <ul>
                                    <li>07 feb, 2025</li>
                                </ul>
                            </div>
                            <!-- Post Item Tag End -->

                            <!-- Post Item Content Start -->
                            <div class="post-item-content">
                                <h2><a href="blog-single.html">Chicken farming Hope project</a></h2>
                            </div>
                            <!-- Post Item Content End -->
                        </div>
                        <!-- Post Item Header End -->

                        <!-- Post Featured Image Start-->
                        <div class="post-featured-image">
                            <a href="blog-single.html" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{asset('assets/frontend/images/post-2.jpeg')}}" alt="">
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

                <div class="col-lg-4 col-md-6">
                    <!-- Post Item Start -->
                    <div class="post-item wow fadeInUp" data-wow-delay="0.4s">
                        <!-- Post Item Header Start -->
                        <div class="post-item-header">
                            <!-- Post Item Tag Start -->
                            <div class="post-item-meta">
                                <ul>
                                    <li>04 feb, 2025</li>
                                </ul>
                            </div>
                            <!-- Post Item Tag End -->

                            <!-- Post Item Content Start -->
                            <div class="post-item-content">
                                <h2><a href="blog-single.html">Chicken farming project South</a></h2>
                            </div>
                            <!-- Post Item Content End -->
                        </div>
                        <!-- Post Item Header End -->

                        <!-- Post Featured Image Start-->
                        <div class="post-featured-image">
                            <a href="blog-single.html" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{asset('assets/frontend/images/post-3.jpeg')}}" alt="">
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
            </div>
        </div>
    </div>
    <!-- Our Blog Section End -->
@endsection