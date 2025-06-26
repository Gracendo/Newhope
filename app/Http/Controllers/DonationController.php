<?php

namespace App\Http\Controllers;

use App\Models\DonationTransaction;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class DonationController extends Controller
{
     public function index()
    {
        return view('frontend.donation');
    }

    public function initiate(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:100',
        'message' => 'nullable|string|max:1000',
        'anonymous' => 'nullable|boolean',
        'donor_name' => 'required|string|max:255',
        'donor_email' => 'required|email|max:255',
    ]);

    Stripe::setApiKey(config('services.stripe.secret'));

    try {
        $intent = PaymentIntent::create([
            'amount' => intval($request->amount) * 100,
            'currency' => 'xaf',
            'automatic_payment_methods' => ['enabled' => true, 'allow_redirects' => 'never'],
            'metadata' => [
                'donor_name' => $request->donor_name,
                'donor_email' => $request->donor_email,
                'message' => $request->message ?? '',
                'anonymous' => $request->boolean('anonymous'),
                'user_id' => auth()->id(),
            ],
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 400);
    }

    return response()->json([
        'client_secret' => $intent->client_secret,
        'payment_id' => $intent->id,
    ]);
}


    public function create()
    {
        return view('frontend.donation'); // à adapter selon l'emplacement exact de ta vue
    }


public function store(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:100',
        'message' => 'nullable|string|max:1000',
        'anonymous' => 'nullable|boolean',
        'donor_name' => 'required|string|max:255',
        'donor_email' => 'required|email|max:255',
    ]);

    Stripe::setApiKey(config('services.stripe.secret'));

    try {
        $intent = PaymentIntent::create([
            'amount' => intval($request->amount) * 100,
            'currency' => 'xaf',
            'automatic_payment_methods' => [
                'enabled' => true,
                'allow_redirects' => 'never',
            ],
        ]);
    } catch (\Exception $e) {
        return back()->withErrors(['payment' => 'Stripe error: ' . $e->getMessage()]);
    }

    return view('frontend.donation', [
        'clientSecret' => $intent->client_secret, // 💡 Tu passes bien la variable ici
        'amount' => $request->amount,
        'message' => $request->message,
        'anonymous' => $request->anonymous,
        'donor_name' => $request->donor_name,
        'donor_email' => $request->donor_email,
    ]);
}

public function confirmDonation(Request $request)
{
    $request->validate([
        'payment_id' => 'required|string',
        'amount' => 'required|numeric',
        'message' => 'nullable|string|max:1000',
        'anonymous' => 'nullable|boolean',
        'donor_name' => 'required|string|max:255',
        'donor_email' => 'required|email|max:255',
    ]);

    DonationTransaction::create([
        'user_id' => auth()->check() ? auth()->id() : null,
        'amount' => $request->amount,
        'message' => $request->message,
        'anonymous' => $request->boolean('anonymous'),
        'payment_id' => $request->payment_id,
        'status' => 'succeeded',
        'donor_name' => $request->donor_name,
        'donor_email' => $request->donor_email,
    ]);

    return response()->json(['success' => true]);
}


}
