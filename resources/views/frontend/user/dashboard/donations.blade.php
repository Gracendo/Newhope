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
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('donations')}}">donations</a></li>
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
                          <tr>
                            <td>1</td>
                            <td>Chicken Farming Campaign</td>
                            <td >2025-04-25</td>
                            <td>1000</td>
                            <td><span class="badge bg-success">5 points</span></td>
                           
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>Newhope Orphanage</td>
                            <td >2025-05-05</td>
                            <td>5000</td>
                            <td><span class="badge bg-success">5 points</span></td>
                            
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>Aqua farm Campaign</td>
                            <td>2025-05-21</td>
                            <td>4000</td>
                            <td><span class="badge bg-success">5 points</span></td>
                            
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>Tomato Farming Campaign</td>
                            <td>2025-07-25</td>
                            <td>40000</td>
                            <td><span class="badge bg-success">5 points</span></td>
                           
                          </tr>
                           
                          
                          
                        </tbody>
                      </table>
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