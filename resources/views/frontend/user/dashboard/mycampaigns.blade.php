@extends('layouts.frontend.user.header')
@section('user_dash')
 <!-- Page Header Start -->
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque"> <span></span>Campaigns</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('user.mycampaigns')}}">campaigns</a></li>
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
                            rgb(251,109,2)">Campaign</th>
                            <th style="color:
                            rgb(251,109,2)">Participation</th>
                            <th style="color:
                            rgb(251,109,2)">Amount</th>
                            <th style="color:
                            rgb(251,109,2)">Status</th>
                            <th style="color:
                            rgb(251,109,2)">Reward</th>
                            <th style="color:
                            rgb(251,109,2)">Date</th>
                          </tr>
                        </thead>
                        <tbody>
                              @forelse($campaigns as $campaign)
                              <tr>
                                  <td>{{ $campaign['number'] }}</td>
                                  <td>{{ $campaign['name'] }}</td>
                                  <td>
                                      <span class="badge {{ $campaign['badge_class'] }}">
                                          {{ $campaign['type'] }}
                                      </span>
                                  </td>
                                  <td>{{ $campaign['amount'] }}</td>
                                  <td>
                                      <span class="badge {{ $campaign['status_class'] }}">
                                          {{ $campaign['status'] }}
                                      </span>
                                  </td>
                                  <td>
                                      <span class="badge  text-bg-success">
                                          {{ $campaign['points'] }}
                                      </span>
                                  </td>
                                  <td>{{ $campaign['date'] }}</td>
                              </tr>
                              @empty
                              <tr>
                                  <td colspan="7" class="text-center">No campaign participation found</td>
                              </tr>
                              @endforelse
                          </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <!-- Pagination -->
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    @if($donations->count())
                                    <div class="d-flex justify-content-start">
                                        {{ $donations->links('pagination::bootstrap-4') }}
                                    </div>
                                    @endif
                                <div class="col-md-6">
                                    @if($volunteers->count())
                                    <div class="d-flex justify-content-end">
                                        {{ $volunteers->links('pagination::bootstrap-4') }}
                                    </div>
                                    @endif
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
   <style>
    /* Custom Pagination Styles */
.pagination {
    margin-top: 20px;
}

.page-item.active .page-link {
    background-color: rgb(251,109,2);
    border-color: rgb(251,109,2);
}

.page-link {
    color: rgb(251,109,2);
}

.page-link:hover {
    color: #fff;
    background-color: rgba(251,109,2,0.8);
    border-color: rgba(251,109,2,0.8);
}
   </style>
    @endsection