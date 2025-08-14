@extends('layouts.frontend.header')

@section('home')
<div class="page-donation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Donation Box Start -->
                <div class="donation-box">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp"> @isset($campaign) fund now @else donate now @endisset</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque"> @isset($campaign) Your funding @else Your donation @endisset</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">
                            Your donation is more than just financial support; it is a powerful act of kindness that drives meaningful change. 
                            Every contribution helps Cameroon orphanages become more autonomous.
                        </p>
                    </div>

                    <!-- Form Start -->
                    <div class="donate-form campaign-donate-form">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form id="donateForm" method="POST">
                            @csrf
<!-- Hidden field for orphanage_id -->
    @if(isset($orphanage))
        <input type="hidden" name="orphanage_id" value="{{ $orphanage->id }}">
    @endif
    @if(isset($campaign))
        <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
    @endif
                            <!-- Amount -->
                            <div class="form-group mb-4">
                                <input type="number" name="amount" class="form-control" 
                                       placeholder="Amount (min: 100 FCFA)" required min="100" 
                                       value="{{ old('amount') }}">
                            </div>

                            <!-- Payment Method -->
                            <div class="form-group mb-4">
                                <label>Payment Method</label>
                                <select name="payment_method" class="form-control" required>
                                    <option value="MTN">MTN Mobile Money</option>
                                    <option value="ORANGE">Orange Money</option>
                                </select>
                            </div>

                            <!-- Phone Number -->
                            <div class="form-group mb-4">
                                <input type="text" name="phone_number" class="form-control" 
                                       placeholder="Phone number (e.g., 2376XXXXXX)" required 
                                       value="{{ auth()->check() && auth()->user()->phone ? auth()->user()->phone : old('phone_number') }}"
                                       {{ auth()->check() && auth()->user()->phone ? 'readonly' : '' }}>
                            </div>

                            <!-- Anonymous Donation -->
                            <div class="form-group mb-4">
                                <label>Anonymous donation?</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="anonymous" id="anonymous_no" value="0" checked>
                                    <label class="form-check-label" for="anonymous_no">No</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="anonymous" id="anonymous_yes" value="1" {{ old('anonymous') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="anonymous_yes">Yes</label>
                                </div>
                            </div>

                            <!-- Donor Info (shown/hidden based on anonymous selection) -->
                            <div id="donor-info-section">
                                <div class="form-group mb-4">
                                    <input type="text" name="name" class="form-control" placeholder="Your name" 
                                           value="{{ auth()->check() ? auth()->user()->first_name : old('name') }}"
                                           {{ auth()->check() ? 'readonly' : '' }}>
                                </div>
                                <div class="form-group mb-4">
                                    <input type="email" name="email" class="form-control" placeholder="Your email" 
                                           value="{{ auth()->check() ? auth()->user()->email : old('email') }}"
                                           {{ auth()->check() ? 'readonly' : '' }}>
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="form-group mb-4">
                                <textarea name="description" class="form-control" placeholder="Message (optional)">{{ old('description') }}</textarea>
                            </div>

                            <button type="submit" id="donate-button" class="btn btn-primary"> @isset($campaign) fund now @else donate now @endisset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle donor info visibility based on anonymous selection
    const anonymousRadios = document.querySelectorAll('input[name="anonymous"]');
    const donorInfoSection = document.getElementById('donor-info-section');
    
    function toggleDonorInfo() {
        const isAnonymous = document.querySelector('input[name="anonymous"]:checked').value === '1';
        donorInfoSection.style.display = isAnonymous ? 'none' : 'block';
        
        // Make fields required/not required based on anonymous selection
        const nameInput = document.querySelector('input[name="name"]');
        const emailInput = document.querySelector('input[name="email"]');
        
        if (isAnonymous) {
            nameInput.removeAttribute('required');
            emailInput.removeAttribute('required');
        } else {
            nameInput.setAttribute('required', 'required');
            emailInput.setAttribute('required', 'required');
        }
    }

    anonymousRadios.forEach(radio => {
        radio.addEventListener('change', toggleDonorInfo);
    });

    // Initialize with current state
    toggleDonorInfo();

    // Handle form submission
    document.getElementById('donateForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = this;
        const button = document.getElementById('donate-button');
        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';

        try {
            // Collect all form data
            const formData = new FormData(form);
            const data = {
                amount: formData.get('amount'),
                phone_number: formData.get('phone_number'),
                payment_method: formData.get('payment_method'),
                description: formData.get('description'),
                anonymous: formData.get('anonymous') === '1',
                name: formData.get('name'),
                email: formData.get('email'),
                orphanage_id: formData.get('orphanage_id'),
                campaign_id: formData.get('campaign_id'),
                
            };
            console.log(data)
            // Make the API request
            const response = await fetch("{{ route('donations.initiate') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(data)
            });

            const responseData = await response.json();

            if (!response.ok) {
                throw new Error(responseData.message || 'Payment initiation failed');
            }

            if (responseData.payment_url) {
                // Redirect to payment page
                window.location.href = responseData.payment_url;
            } else {
                // Start polling for payment status if no redirect URL
                pollPaymentStatus(responseData.reference);
            }
        } catch (error) {
            alert('Error: ' + error.message);
            button.disabled = false;
            button.innerHTML = 'Donate Now';
        }
    });

    // Poll payment status every 10 seconds
    function pollPaymentStatus(reference) {
        const interval = setInterval(async () => {
            try {
                const response = await fetch(`/campay/check-collect-status/${reference}`);
                const data = await response.json();

                if (data.collectStatus === 'SUCCESSFUL') {
                    clearInterval(interval);
                    window.location.href = "{{ route('donations.thankyou') }}";
                } else if (data.collectStatus === 'FAILED') {
                    clearInterval(interval);
                    alert('Payment failed. Please try again.');
                    window.location.reload();
                }
            } catch (error) {
                console.error('Polling error:', error);
            }
        }, 10000); // 10 seconds
    }
});
</script>
@endsection