@extends('layouts.frontend.user.header')
@section('user_dash')
 <!-- Page Header Start -->
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque"> <span></span>Donations</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('user.donations')}}">donations</a></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <!-- my campaign page start -->
    <!-- Page Services Start -->
    <div class="page-services">
        <div class="container">
            <div class="row">
                <div class="col-lg-25 col-md-16">
                    <!-- Services Item Start -->
                    <div class="service-item wow fadeInUp">
                        <!-- Default Datatable start -->
              <div class="col-12">
                <div >
                 
                  <div class="card-body p-0">
                    <div class="app-datatable-default overflow-auto">
                      <table id="example" class="display app-data-table default-data-table">
                        <thead>
                          <tr>
                            <th style="color:
                            rgb(251,109,2)">No</th>
                            <th style="color:
                            rgb(251,109,2)">Donated to</th>
                            <th style="color:
                            rgb(251,109,2)">Donation date</th>
                            <th style="color:
                            rgb(251,109,2)">Amount</th>
                            <th style="color:
                            rgb(251,109,2)">Reward</th>
                            
                          </tr>
                        </thead>
                       <tbody>
                                        @forelse($donations as $index => $donation)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if($donation->campaign)
                                                    {{ $donation->campaign->title }} Campaign
                                                @elseif($donation->orphanage)
                                                    {{ $donation->orphanage->name }} Orphanage
                                                @else
                                                    Unknown Recipient
                                                @endif
                                            </td>
                                            <td>{{ $donation->created_at->format('Y-m-d') }}</td>
                                            <td>{{ number_format($donation->amount) }}</td>
                                            <td>
                                              <span class="badge bg-success">5 points</span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No donations found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            <div class="row mt-4">
                                <div class="col-md-12">

                      <div class="d-flex justify-content-center">
                                        {{ $donations->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Default Datatable end -->
                    </div>
                    <!-- Services Item End -->
                </div>
                
            </div>
        </div>
    </div>
    <!-- Page Services End -->
    <!-- js -->
   
    @endsection