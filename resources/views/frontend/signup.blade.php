@extends('layouts.frontend.header')
@section('home')
<!-- Page Donation Start -->
<div class="page-donation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Donation Box Start -->
                <div class="donation-box">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Sign up</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Welcome, change maker!</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">Thank you for joining our contribution to support these orphanages. Each contribution helps make them more autonomous.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Campaign Donation Form Start -->
                    <div class="donate-form campaign-donate-form">
                        <form id="donateForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- Donar Personal Info Start -->
                            <div class="donar-personal-info">
                                <!-- Section Title Start -->
                                <div class="section-title">
                                    <h2 class="text-anime-style-2" data-cursor="-opaque">Personal <span>info</span></h2>
                                </div>
                                <!-- Section Title End -->
            
                                <div class="row wow fadeInUp" data-wow-delay="0.8s">
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="username" class="form-control" placeholder="User Name" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                                    </div>
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="email" name="email" class="form-control" placeholder="Enter your e-mail" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="address" class="form-control" placeholder="Enter your Address" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <select name="status" class="form-control" id="statusSelect" required>
                                            <option value="contributor">Contributor</option>
                                            <option value="orphanagemanager">Orphanage Manager</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                    </div>
                                </div>
                            </div>
                            <!-- Donar Personal Info End -->

                            <!-- Orphanage Info Section (Initially Hidden) -->
                            <div id="orphanageInfoSection" style="display: none;">
                                <div class="donar-personal-info">
                                    <div class="section-title">
                                        <h2 class="text-anime-style-2" data-cursor="-opaque">Orphanage <span>Details</span></h2>
                                    </div>
                                    <div class="row wow fadeInUp" data-wow-delay="0.8s">
                                        <div class="form-group col-md-6 mb-4">
                                            <input type="text" name="orphanage_name" class="form-control" placeholder="Orphanage Name">
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                            <input type="text" name="country" class="form-control" placeholder="Country">
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                            <input type="text" name="city" class="form-control" placeholder="City">
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                            <input type="text" name="region" class="form-control" placeholder="Region">
                                        </div>
                                        <div class="form-group col-md-12 mb-4">
                                            <input type="text" name="orphanage_address" class="form-control" placeholder="Orphanage Address">
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                            <input type="number" step="0.000001" name="longitude" class="form-control" placeholder="Longitude">
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                            <input type="number" step="0.000001" name="latitude" class="form-control" placeholder="Latitude">
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                            <input type="text" name="num_enregistrement" class="form-control" placeholder="Registration Number">
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                            <input type="file" name="logo" class="form-control" accept="image/*">
                                        </div>
                                        <div class="form-group col-md-12 mb-4">
                                            <textarea name="description" class="form-control" placeholder="Description"></textarea>
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                            <input type="email" name="orphanage_email" class="form-control" placeholder="Orphanage Email">
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                            <input type="text" name="orphanage_phone" class="form-control" placeholder="Orphanage Phone">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-btn wow fadeInUp" data-wow-delay="1s">
                                <button type="submit" class="btn-default">Register</button>
                                <div id="msgSubmit" class="h3 hidden"></div>
                            </div>
                        </form>
                        <div class="card-footer text-center">
                            <small class="text-muted">Have an account? <a href="{{ route('user.login') }}">Log in</a></small>
                        </div>
                    </div>
                    <!-- Campaign Donation Form End -->
                </div>
                <!-- Donation Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Donation End -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('statusSelect');
        const orphanageSection = document.getElementById('orphanageInfoSection');

        // Initial check
        toggleOrphanageFields();
        
        // Event listener for changes
        statusSelect.addEventListener('change', toggleOrphanageFields);

        function toggleOrphanageFields() {
            if (statusSelect.value === 'orphanagemanager') {
                orphanageSection.style.display = 'block';
                // Make orphanage fields required
                orphanageSection.querySelectorAll('input, textarea').forEach(field => {
                    field.required = true;
                });
            } else {
                orphanageSection.style.display = 'none';
                // Remove required attribute
                orphanageSection.querySelectorAll('input, textarea').forEach(field => {
                    field.required = false;
                });
            }
        }
    });
</script>
@endsection