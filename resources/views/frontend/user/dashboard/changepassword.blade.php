@extends('layouts.frontend.user.header')
@section('user_dash')
 <!-- Page Header Start -->
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque"> <span></span>Change Password</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('changepassword')}}">Change Password</a></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <!-- change password page start-->
    <div class="page-services">
        <div class="container">
            <div class="column">
                <div class="container mt-4">
                    <div class="row border rounded shadow-sm" style="min-height: 400px;">
                        <!-- Left Profile Section -->
                        <div class="col-md-4 p-4" style="border-right: 2px dashed #dee2e6;">
                            <div class="text-center">
                                <div class="mb-3">
                                    <i class="fas fa-user-circle text-muted" style="font-size: 4rem;"></i>
                                </div>
                                <h6 class="mb-1">Username</h6>
                                <p class="text-muted small mb-3">rilaxvw</p>
                                
                                <hr style="border-top: 2px dashed #999;">
                                
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-envelope text-muted me-2"></i>
                                    <small class="text-muted">Email</small>
                                </div>
                                <p class="small mb-3">rilaxvw.223@gmail.com</p>
                                
                                <hr style="border-top: 2px dashed #999;">
                                
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-phone text-muted me-2"></i>
                                    <small class="text-muted">Mobile</small>
                                </div>
                                <p class="small mb-3">2376968S5114</p>
                                
                                <hr style="border-top: 2px dashed #999;">
                                
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-globe text-muted me-2"></i>
                                    <small class="text-muted">Country</small>
                                </div>
                                <p class="small mb-3">Cameroon</p>
                                
                                <hr style="border-top: 2px dashed #999;">
                                
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                    <small class="text-muted">Address</small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Form Section -->
                        <div class="col-md-8 p-4">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Current Password <span  style="color: red;">*</span></label>
                                    <input type="password" class="form-control" style="height: 45px;">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">New Password <span  style="color: red;">*</span></label>
                                    <input type="password" class="form-control" style="height: 45px;">
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Confirm Password <span  style="color: red;">*</span></label>
                                    <input type="password" class="form-control" style="height: 45px;">
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-lg text-white fw-bold" style="
                                        background-color: rgb(251,109,2);
                                        border: none;
                                        cursor: pointer;
                                        transition: all 0.3s ease;
                                        height: 50px;
                                    " 
                                    onmouseover="this.style.backgroundColor='rgba(2,13,25,1)'"
                                    onmouseout="this.style.backgroundColor='rgb(251,109,2)'">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection