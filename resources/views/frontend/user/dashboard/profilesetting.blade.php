@extends('layouts.frontend.user.header')
@section('user_dash')
 <!-- Page Header Start -->
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque"> <span></span>Profile Settings</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('user.profile')}}">Profile Setting</a></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <!--Profile Setting Start-->
     <!-- Page Services Start -->
    <div class="page-services">
        <div class="container">
            <div class="column">
                <div class="container mt-4">
                    <div class="row border rounded shadow-sm" style="min-height: 600px;">
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
                                <p class="small mb-3">+37696865114</p>
                                
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
                                    <!-- Image Upload Section -->
                                    <div class="text-center mb-4">
                                        <div class="border border-2 border-dashed rounded position-relative" style="height: 150px; background-color: #f8f9fa; border-color: rgb(251,109,2) !important; cursor: pointer; overflow: hidden;" onclick="document.getElementById('imageInput').click();">
                                            <div class="d-flex align-items-center justify-content-center h-100 position-absolute w-100" id="uploadPlaceholder">
                                                <i class="fas fa-plus" style="font-size: 2rem; color: rgb(251,109,2);"></i>
                                            </div>
                                            <img id="previewImage" class="position-absolute top-0 start-0" style="display: none; width: 100%; height: 100%; object-fit: cover;" />
                                            <input type="file" id="imageInput" accept="image/jpeg,image/jpg,image/png" style="display: none;" onchange="previewFile(this)" />
                                        </div>
                                        <div class="mt-2">
                                            <i class="fas fa-camera" style="color: rgb(251,109,2);"></i>
                                            <small class="text-muted ms-2">Supported file: jpeg, jpg, png, jpeg size: 200x200px</small>
                                        </div>
                                    </div>
                                    
                                    <script>
                                        function previewFile(input) {
                                            if (input.files && input.files[0]) {
                                                const file = input.files[0];
                                                
                                                // Check file type
                                                if (!file.type.match('image/jpeg') && !file.type.match('image/jpg') && !file.type.match('image/png')) {
                                                    alert('Please select a valid image file (JPEG, JPG, or PNG)');
                                                    return;
                                                }
                                                
                                                // Check file size (optional - you can set a limit)
                                                const maxSize = 5 * 1024 * 1024; // 5MB
                                                if (file.size > maxSize) {
                                                    alert('File size too large. Please select an image smaller than 5MB.');
                                                    return;
                                                }
                                                
                                                const reader = new FileReader();
                                                reader.onload = function(e) {
                                                    const previewImage = document.getElementById('previewImage');
                                                    const placeholder = document.getElementById('uploadPlaceholder');
                                                    
                                                    previewImage.src = e.target.result;
                                                    previewImage.style.display = 'block';
                                                    placeholder.style.display = 'none';
                                                };
                                                reader.readAsDataURL(file);
                                            }
                                        }
                                    </script>
                                    
                                    
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">First Name <span  style="color: red;">*</span> </label>
                                                <input type="text" class="form-control" value="rila">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Last Name <span  style="color: red;">*</span></label>
                                                <input type="text" class="form-control" value="rilax">
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">State</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Zip Code</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-lg text-white fw-bold" style="
                                                background-color: rgb(251,109,2);
                                                border: none;
                                                cursor: pointer;
                                                transition: all 0.3s ease;
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
        </div>
    </div>
    <!-- Page Services End -->
    @endsection