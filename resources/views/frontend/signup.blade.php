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
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form id="donateForm" method="POST" action="{{route('user.register')}}" enctype="multipart/form-data">
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
                                        <input type="text"  name="country" class="form-control" placeholder="Enter Country name" >
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                        <input type="text"  name="region" class="form-control" placeholder="Enter region" >
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                        <input type="text"  name="city" class="form-control" placeholder="Enter city" >
                                        </div>
                                        <div class="form-group col-md-12 mb-4">
                                            <input type="text" name="orphanage_address" class="form-control" placeholder="Orphanage Address">
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                            <input type="number" step="0.000001" name="longitude" id="longitude" class="form-control" placeholder="Click to pick longitude on map"  >
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                            <input type="number" step="0.000001" name="latitude" id="latitude" class="form-control" placeholder="Click to pick  latitude on map" >
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
                            <!-- Map Modal -->
                            <div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mapModalLabel">Select Location</h5>
                                            
                                        </div>
                                        <div class="modal-body">
                                            <div id="locationMap" style="height: 500px;"></div>
                                            <div class="mt-3">
                                                <input type="text" id="addressSearch" class="form-control" placeholder="Search address...">
                                            </div>
                                             
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-primary" id="confirmLocation">Confirm Location</button>
                                                </div>
                                            </div>
                                        </div>
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
    // ===============ORPHANAGE TOGGLE======================
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
        
    // // =============================================
    // // COUNTRY-REGION-CITY DROPDOWNS IMPLEMENTATION
    // // =============================================

    // // Get references to the dropdown elements
    // const countrySelect = document.getElementById('country');
    // const regionSelect = document.getElementById('region');
    // const citySelect = document.getElementById('city');

    // /**
    //  * Load all countries from the API and populate the country dropdown
    //  */
    // function loadCountries() {
    //         // Clear existing options and show loading state
    //         countrySelect.innerHTML = '<option value="">Loading countries...</option>';
            
    //         // Fetch countries from the API
    //         fetch('https://countriesnow.space/api/v0.1/countries')
    //         .then(response => {
    //             // Check if the response is successful
    //             if (!response.ok) throw new Error('Network response was not ok');
    //             return response.json();
    //         })
    //         .then(data => {
    //             // Check if API returned valid data
    //             if (data.error) throw new Error(data.msg || 'API error');
                
    //             // Reset dropdown and add default option
    //             countrySelect.innerHTML = '<option value="">Select Country</option>';
                
    //             // Add each country to the dropdown
    //             data.data.forEach(country => {
    //                 const option = new Option(country.country, country.country);
    //                 countrySelect.add(option);
    //             });
    //         })
    //         .catch(error => {
    //             console.error('Failed to load countries:', error);
    //             countrySelect.innerHTML = '<option value="">Error loading countries</option>';
    //         });
    // }

    // /**
    //  * Load regions/states for the selected country
    //  */
    // function loadRegions() {
    //             // Clear and disable dependent dropdowns
    //             regionSelect.innerHTML = '<option value="">Select Region</option>';
    //             regionSelect.disabled = true;
    //             citySelect.innerHTML = '<option value="">Select City</option>';
    //             citySelect.disabled = true;

    //             const selectedCountry = countrySelect.value;
    //             if (!selectedCountry) return;

    //             // Show loading state
    //             regionSelect.innerHTML = '<option value="">Loading regions...</option>';
                
    //             // Fetch regions for the selected country
    //             fetch('https://countriesnow.space/api/v0.1/countries/states', {
    //                 method: 'POST',
    //                 headers: { 'Content-Type': 'application/json' },
    //                 body: JSON.stringify({ country: selectedCountry })
    //             })
    //             .then(response => {
    //                 if (!response.ok) throw new Error('Network response was not ok');
    //                 return response.json();
    //             })
    //             .then(data => {
    //                 if (data.error) throw new Error(data.msg || 'API error');
                    
    //                 // Reset dropdown
    //                 regionSelect.innerHTML = '<option value="">Select Region</option>';
                    
    //                 // Add regions if available
    //                 if (data.data?.states?.length) {
    //                     data.data.states.forEach(region => {
    //                         regionSelect.add(new Option(region.name, region.name));
    //                     });
    //                     regionSelect.disabled = false;
    //                 } else {
    //                     regionSelect.innerHTML = '<option value="">No regions available</option>';
    //                 }
    //             })
    //             .catch(error => {
    //                 console.error('Failed to load regions:', error);
    //                 regionSelect.innerHTML = '<option value="">Error loading regions</option>';
    //             });
    // }

    //         /**
    //          * Load cities for the selected region
    //          */
    //         function loadCities() {
    //             citySelect.innerHTML = '<option value="">Select City</option>';
    //             citySelect.disabled = true;

    //             const selectedCountry = countrySelect.value;
    //             const selectedRegion = regionSelect.value;
    //             if (!selectedCountry || !selectedRegion) return;

    //             // Show loading state
    //             citySelect.innerHTML = '<option value="">Loading cities...</option>';
        
    //             // Fetch cities for the selected region
    //             fetch('https://countriesnow.space/api/v0.1/countries/state/cities', {
    //                 method: 'POST',
    //                 headers: { 'Content-Type': 'application/json' },
    //                 body: JSON.stringify({
    //                     country: selectedCountry,
    //                     state: selectedRegion
    //                 })
    //             })
    //             .then(response => {
    //                 if (!response.ok) throw new Error('Network response was not ok');
    //                 return response.json();
    //             })
    //             .then(data => {
    //                 if (data.error) throw new Error(data.msg || 'API error');
                    
    //                 // Reset dropdown
    //                 citySelect.innerHTML = '<option value="">Select City</option>';
                    
    //                 // Add cities if available
    //                 if (data.data?.length) {
    //                     data.data.forEach(city => {
    //                         citySelect.add(new Option(city, city));
    //                     });
    //                     citySelect.disabled = false;
    //                 } else {
    //                     citySelect.innerHTML = '<option value="">No cities available</option>';
    //                 }
    //             })
    //             .catch(error => {
    //                 console.error('Failed to load cities:', error);
    //                 citySelect.innerHTML = '<option value="">Error loading cities</option>';
    //             });
    //         }

    //         // Initialize the country dropdown when page loads
    //         document.addEventListener('DOMContentLoaded', loadCountries);

    //         // Set up event listeners for dropdown changes
    //         countrySelect.addEventListener('change', loadRegions);
    //         regionSelect.addEventListener('change', loadCities);

    //         // =============================================
    //         // INTERACTIVE MAP IMPLEMENTATION
    //         // =============================================

    //         // Get references to map-related elements
    //         const mapModal = document.getElementById('mapModal');
    //         const latitudeInput = document.getElementById('latitude');
    //         const longitudeInput = document.getElementById('longitude');
    //         const confirmLocationBtn = document.getElementById('confirmLocation');

    //         let map; // Leaflet map instance
    //         let marker; // Current location marker
    //         let selectedLocation = null; // Stores selected coordinates

    //         /**
    //          * Initialize the map when the modal is shown
    //          */
    //         function initMap() {
    //             // Create map centered at (0,0) with zoom level 2
    //             map = L.map('locationMap').setView([0, 0], 2);
                
    //             // Add OpenStreetMap base layer
    //             L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //                 attribution: '© OpenStreetMap contributors'
    //             }).addTo(map);

    //             // Add search control
    //             const searchControl = new GeoSearch.GeoSearchControl({
    //                 provider: new GeoSearch.OpenStreetMapProvider(),
    //                 style: 'bar',
    //                 searchLabel: 'Search for location...',
    //                 showMarker: true,
    //                 retainZoomLevel: false,
    //                 animateZoom: true
    //             });
    //             map.addControl(searchControl);

    //             // Handle map clicks to place marker
    //             map.on('click', function(e) {
    //                 updateMarkerPosition(e.latlng);
    //             });

    //             // Handle search results to place marker
    //             map.on('geosearch/showlocation', function(result) {
    //                 updateMarkerPosition({
    //                     lat: result.location.y,
    //                     lng: result.location.x
    //                 });
    //             });

    //             // If existing coordinates exist, center map there
    //             if (latitudeInput.value && longitudeInput.value) {
    //                 const existingLocation = {
    //                     lat: parseFloat(latitudeInput.value),
    //                     lng: parseFloat(longitudeInput.value)
    //                 };
    //                 updateMarkerPosition(existingLocation);
    //                 map.setView(existingLocation, 15);
    //             }
    //         }

    //         /**
    //          * Update the marker position and store the selected location
    //          * @param {Object} latlng - Object with lat and lng properties
    //          */
    //         function updateMarkerPosition(latlng) {
    //             // Remove existing marker if it exists
    //             if (marker) {
    //                 map.removeLayer(marker);
    //             }
                
    //             // Create new marker at clicked position
    //             marker = L.marker(latlng).addTo(map);
                
    //             // Store the selected location
    //             selectedLocation = latlng;
    //         }

    //         /**
    //          * Handle opening the map modal
    //          */
    //         function openMapModal() {
    //             // Initialize map if not already done
    //             if (!map) {
    //                 initMap();
    //             }
                
    //             // Show the modal
    //             const modal = new bootstrap.Modal(mapModal);
    //             modal.show();
    //         }

    //         /**
    //          * Handle confirming the location selection
    //          */
    //         function confirmLocation() {
    //             if (selectedLocation) {
    //                 // Update the input fields with selected coordinates
    //                 latitudeInput.value = selectedLocation.lat.toFixed(6);
    //                 longitudeInput.value = selectedLocation.lng.toFixed(6);
                    
    //                 // Hide the modal
    //                 const modal = bootstrap.Modal.getInstance(mapModal);
    //                 modal.hide();
    //             } else {
    //                 alert('Please select a location on the map first.');
    //             }
    //         }

    //         // Set up event listeners for map functionality
    //         latitudeInput.addEventListener('click', openMapModal);
    //         longitudeInput.addEventListener('click', openMapModal);
    //         confirmLocationBtn.addEventListener('click', confirmLocation);


</script>
@endsection