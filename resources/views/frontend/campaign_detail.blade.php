@extends('layouts.frontend.header')
@section('home')
<style>
    .program-entry p {
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: normal;
}
    .building-stability-box p{
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: normal;
    }
    .accordion-body p{
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: normal;
    }
</style>
    <!-- Page Header Start -->
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque"><span>{{ $campaign->name }}</span></h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('campaign') }}">campaigns</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $campaign->name }}</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Page Program Single Start -->
    <div class="page-program-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <!-- Page Single Sidebar Start -->
                    <div class="page-single-sidebar">
                        <!-- Campaign Info Box Start -->
                        <div class="page-sidebar-catagery-list wow fadeInUp">
                            <h3>Campaign Details</h3>
                            <ul>
                                <li><strong>Duration:</strong> {{ ucfirst($campaign->project_duration) }}</li>
                                <li><strong>Goal Amount:</strong> {{ number_format($campaign->goal_amount, 2) }}FCFA</li>
                                <li><strong>Raised Amount:</strong> {{ number_format($campaign->raised_amount, 2) }}FCFA</li>
                                <li><strong>Start Date:</strong> {{ $campaign->start_date }}</li>
                                <li><strong>End Date:</strong> {{ $campaign->end_date }}</li>
                            </ul>
                        </div>
                        <!-- Campaign Info Box End -->

                        <!-- Sidebar CTA Box Start -->
                        <div class="sidebar-cta-box wow fadeInUp" data-wow-delay="0.2s">
                            <!-- Cta Content Start -->
                            <div class="icon-box">
                                <img src="{{ asset('assets/frontend/images/icon-cta.svg') }}" alt="">
                            </div>

                            <div class="sidebar-cta-content">
                                <p>small gifts, big changes</p>
                                <h3>empowering every orphanages through crowdfunding</h3>
                            </div>
                            <!-- Cta Content End -->

                            <!-- Cta Appointment Button Start -->
                            <div class="sidebar-cta-btn">
                                <a href="{{ route('orphanage.donate',$campaign->orphanage->id) }}" class="btn-default">Donate Now</a>
                            </div>
                            <!-- Cta Appointment Button End -->
                        </div>
                        <!-- Sidebar CTA Box End -->
                    </div>
                    <!-- Page Single Sidebar End -->
                </div>
                
                <div class="col-lg-8">
                    <!-- Program Single Start -->
                    <div class="program-single-contemt">
                        <!-- Program Feature Image Start -->
                        <div class="program-feature-image">
                            <figure class="image-anime reveal">
                                <img src="{{ Storage::url($campaign->image) }}" alt="{{ $campaign->name }}">
                            </figure>
                        </div>
                        <!-- Program Feature Image End -->
                    
                        <!-- Program Entry Start -->
                        <div class="program-entry">
                            <h2 class="text-anime-style-2">{{ $campaign->name }}</h2>                        
                            <p class="wow fadeInUp">{{ $campaign->description }}</p>

                            <div class="building-stability-box">
                                <h2 class="text-anime-style-2">Campaign Objectives</h2>
                                <p class="wow fadeInUp">{{ $campaign->objectif }}</p>
                                
                                @if($campaign->gallery)
                                <!-- Gallery Section Start -->
                                <div class="program-entry-video intro-video-box wow fadeInUp" data-wow-delay="0.4s">
                                    @foreach(json_decode($campaign->gallery) as $image)
                                    <!-- Gallery Item Start -->
                                    <div class="program-entry-video-item">
                                        <div class="program-entry-video-image">
                                            <figure class="image-anime">
                                                <img src="{{ Storage::url($image) }}" alt="Gallery Image">
                                            </figure>
                                        </div>
                                    </div>
                                    <!-- Gallery Item End -->
                                    @endforeach
                                </div>
                                <!-- Gallery Section End -->
                                @endif

                                
                            </div>                    

                            <!-- Program Why Choose Start -->
                            <div class="program-why-choose">
                                <h2 class="text-anime-style-2">Why Support This Campaign</h2>
                                <p class="wow fadeInUp">Your support makes a real difference in the lives of those we serve. Here's why this campaign matters:</p>

                                <!-- Program Why Choose List Start -->
                                <div class="program-why-choose-list">
                                    <!-- Program Why Choose Item Start -->
                                    <div class="program-why-choose-item wow fadeInUp">
                                        <div class="icon-box">
                                            <img src="{{ asset('assets/frontend/images/icon-program-why-choose-1.svg') }}" alt="">
                                        </div>
                                        <div class="program-why-choose-content">
                                            <h3>Direct Impact</h3>
                                            <p>Your contribution directly supports {{ $campaign->name }}, creating measurable change in our community.</p>
                                        </div>
                                    </div>
                                    <!-- Program Why Choose Item End -->

                                    <!-- Program Why Choose Item Start -->
                                    <div class="program-why-choose-item wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="icon-box">
                                            <img src="{{ asset('assets/frontend/images/icon-program-why-choose-2.svg') }}" alt="">
                                        </div>
                                        <div class="program-why-choose-content">
                                            <h3>Sustainable Solutions</h3>
                                            <p>We focus on long-term solutions that create lasting change beyond immediate needs.</p>
                                        </div>
                                    </div>
                                    <!-- Program Why Choose Item End -->

                                    <!-- Program Why Choose Item Start -->
                                    <div class="program-why-choose-item wow fadeInUp" data-wow-delay="0.4s">
                                        <div class="icon-box">
                                            <img src="{{ asset('assets/frontend/images/icon-program-why-choose-3.svg') }}" alt="">
                                        </div>
                                        <div class="program-why-choose-content">
                                            <h3>Transparent Process</h3>
                                            <p>We maintain complete transparency about how funds are used and the impact created.</p>
                                        </div>
                                    </div>
                                    <!-- Program Why Choose Item End -->

                                    <!-- Program Why Choose Item Start -->
                                    <div class="program-why-choose-item wow fadeInUp" data-wow-delay="0.6s">
                                        <div class="icon-box">
                                            <img src="{{ asset('assets/frontend/images/icon-program-why-choose-4.svg') }}" alt="">
                                        </div>
                                        <div class="program-why-choose-content">
                                            <h3>Community Focused</h3>
                                            <p>This initiative was developed with direct input from the community it serves.</p>
                                        </div>
                                    </div>
                                    <!-- Program Why Choose Item End -->
                                </div>
                                <!-- Program Why Choose List End -->

                                <!-- Service Contact Text Start -->
                                <div class="section-footer-text program-why-choose-footer wow fadeInUp" data-wow-delay="0.8s">
                                    
                                        
                                    @auth
                                    @unless(auth()->user()->role === 'orphanagemanager')
                                    <div class="volunteer-section mt-4">
                                        @if(!$hasVolunteered)
                                        <p><span>1 hour</span> A day Can greatly help this orphanage in becoming autonomous. 
                                        <a href="#"data-bs-toggle="modal" data-bs-target="#volunteerModal"> Volunteer for this Project</a></p>
                                        @else
                                        <div class="alert alert-info">
                                            Your volunteer request is {{ $volunteerStatus }}.
                                        </div>
                                        @endif
                                    </div>
                                    @endunless
                                    @endauth
                                    @if (session('status'))
                                    <p><span>1000FCFA</span> Can greatly help this orphanage in becoming autonomous. 
                                    <a href="{{ route('campaign.donate',$campaign->id) }}">Contribute now</a></p>
                            
                                    @else 
                                    <p><span>1000FCFA</span> Can greatly help this orphanage in becoming autonomous. 
                                    <a href="{{ route('campaign.donate',$campaign->id) }}">Fund now</a></p>
                                    @endif
                                </div>
                                <!-- Service Contact Text End -->
                            </div>
                            <!-- Program Why Choose End -->
                        </div>
                        <!-- Program Entry End -->
                       
                        <!-- Program FAQ Section Start -->
                        <div class="our-faq-section">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h2 class="text-anime-style-2" data-cursor="-opaque">Frequently Asked Questions</h2>
                            </div>
                            <!-- Section Title End -->

                            <!-- FAQ Accordion Start -->
                            <div class="faq-accordion" id="accordion">
                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp">
                                    <h2 class="accordion-header" id="heading1">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                            What is the goal of this campaign?
                                        </button>
                                    </h2>
                                    <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#accordion">
                                        <div class="accordion-body">
                                            <p>The primary goal is to {{ $campaign->objectif }} with a target of raising ${{ number_format($campaign->goal_amount, 2) }}.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="0.2s">
                                    <h2 class="accordion-header" id="heading2">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                            How can I contribute?
                                        </button>
                                    </h2>
                                    <div id="collapse2" class="accordion-collapse collapse show" aria-labelledby="heading2" data-bs-parent="#accordion">
                                        <div class="accordion-body">
                                            <p>You can make a financial donation or volunteer your time and skills. Click the "Donate Now" button above to contribute financially.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="0.4s">
                                    <h2 class="accordion-header" id="heading3">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                            How will my donation be used?
                                        </button>
                                    </h2>
                                    <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordion">
                                        <div class="accordion-body">
                                            <p>Funds will be used specifically for {{ $campaign->name }} as outlined in our project description. We provide regular updates on fund utilization.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="0.6s">
                                    <h2 class="accordion-header" id="heading4">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                            When will this campaign end?
                                        </button>
                                    </h2>
                                    <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordion">
                                        <div class="accordion-body">
                                            <p>The campaign is scheduled to run until {{ $campaign->end_date }} or until we reach our funding goal.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="0.8s">
                                    <h2 class="accordion-header" id="heading5">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                            Can I get updates on this project?
                                        </button>
                                    </h2>
                                    <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordion">
                                        <div class="accordion-body">
                                            <p>Yes! Subscribe to our newsletter or follow us on social media for regular updates on this and other projects.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->
                            </div>
                            <!-- FAQ Accordion End -->
                        </div>
                        <!-- Program FAQ Section End -->
                    </div>
                    <!-- Program Single End -->
                </div>                
            </div>
        </div>
    </div>
    <!-- Page Program Single End -->
 <!-- Volunteer Modal -->
                        <div class="modal fade" id="volunteerModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('volunteer.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                                        <div class="modal-body">
                                            <p>Thank you for volunteering for "{{ $campaign->name }}"!</p>
                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
    <!-- Main Footer Section Start -->
    <!-- <footer class="main-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12"> -->
                    @endsection