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
                        <h3 class="wow fadeInUp">donate now</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Your donation</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">
                            Your donation is more than just financial support; it is a powerful act of kindness that drives meaningful change. 
                            Every contribution helps Cameroon orphanages become more autonomous.
                        </p>
                    </div>

                    <!-- Form Start -->
                    <div class="donate-form campaign-donate-form">
                    <!-- Feedback Messages -->
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

    <!-- Montant -->
    <div class="form-group mb-4">
        <input type="number" name="amount" class="form-control" placeholder="Montant du don (min: 100 FCFA)" required min="100">
    </div>

    <!-- Don anonyme -->
    <div class="form-group mb-4">
        <label>Don anonyme ?</label><br>
        <input type="radio" name="anonymous" value="0" checked> Non
        <input type="radio" name="anonymous" value="1"> Oui
    </div>

    <!-- Infos personnelles -->
    <div class="form-group mb-4">
        <input type="text" name="donor_name" class="form-control" placeholder="Votre nom" required>
    </div>
    <div class="form-group mb-4">
        <input type="email" name="donor_email" class="form-control" placeholder="Votre email" required>
    </div>

    <!-- Message -->
    <div class="form-group mb-4">
        <textarea name="message" class="form-control" placeholder="Message (optionnel)"></textarea>
    </div>

    <!-- Carte -->
    <div class="form-group mb-4">
        <label for="card-element">Détails de la carte</label>
        <div id="card-element" class="form-control"></div>
        <div id="card-errors" class="text-danger mt-2"></div>
        <input type="hidden" name="payment_method" id="payment_method">
    </div>

    <button type="submit" id="donate-button" class="btn btn-primary">Faire un don</button>
</form>


                    </div>
                    <!-- Form End -->

                </div>
                <!-- Donation Box End -->
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
const stripe = Stripe(@json(config('services.stripe.key')));
const elements = stripe.elements();
const cardElement = elements.create('card');
cardElement.mount('#card-element');

const form = document.getElementById('donateForm');
const donateButton = document.getElementById('donate-button');

form.addEventListener('submit', async function(e) {
    e.preventDefault();
    donateButton.disabled = true;

    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    try {
        const res = await fetch("{{ route('donations.initiate') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData
        });

        const response = await res.json();
        if (response.error) throw new Error(response.error);

        const result = await stripe.confirmCardPayment(response.client_secret, {
            payment_method: {
                card: cardElement,
                billing_details: {
                    name: data.donor_name,
                    email: data.donor_email
                }
            }
        });

        if (result.error) {
            document.getElementById('card-errors').textContent = result.error.message;
            donateButton.disabled = false;
            return;
        }

        if (result.paymentIntent.status === 'succeeded') {
            await fetch("{{ route('donations.confirm') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    payment_id: result.paymentIntent.id,
                    amount: data.amount,
                    message: data.message,
                    anonymous: data.anonymous === "1",
                    donor_name: data.donor_name,
                    donor_email: data.donor_email,
                })
            });

            alert("Merci pour votre don !");
            window.location.href = "{{ route('donations.create') }}";
        }
    } catch (error) {
        console.error(error);
        document.getElementById('card-errors').textContent = error.message;
        donateButton.disabled = false;
    }
});
</script>


@endsection
