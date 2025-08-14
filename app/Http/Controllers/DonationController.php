<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Orphanage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DonationController extends Controller
{
    private $campayApiBaseUrl;
    private $campayAppUsername;
    private $campayAppPassword;

    public function __construct()
    {
        $this->campayApiBaseUrl = env('CAMPAY_API_BASE_URL');
        $this->campayAppUsername = env('CAMPAY_APP_USERNAME');
        $this->campayAppPassword = env('CAMPAY_APP_PASSWORD');
    }

    public function index()
    {
        return view('frontend.donation');
    }

    public function create(?Orphanage $orphanage = null)
    {
        // Pass the orphanage to the view
        return view('frontend.donation', [
            'orphanage' => $orphanage,
            'campaign' => null, // You can add campaign support similarly
        ]);
    }

    public function create1(?Campaign $campaign = null)
    {
        // Pass the orphanage to the view
        return view('frontend.donation', [
            'orphanage' => null,
            'campaign' => $campaign, // You can add campaign support similarly
        ]);
    }

    public function initiatePayment(Request $request)
    {
        try {
            $accessToken = $this->getCampayAccessToken();
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

        try {
            $collectReference = 'DONATE_'.time().'_'.substr(md5(uniqid()), 0, 8);

            Log::info("Requesting  from $ $request->phone_number...");

            $headers = [
                'Authorization' => "Token $accessToken",
                'Content-Type' => 'application/json',
            ];
            $collectPayload = [
                'amount' => $request->amount,
                'currency' => 'XAF',
                'from' => $request->phone_number,
                'description' => $request->description ?? 'Donation to orphanage',
                'external_reference' => $collectReference,
            ];

            $response = Http::withHeaders($headers)->withOptions([
                'verify' => 'C:\Users\Emie\Desktop\Newhope\certification\cacert.pem',
                // 'verify' => '../../../certification/cacert.pem',
            ])
                ->post($this->campayApiBaseUrl.'/collect/', $collectPayload);

            // dd($request);
            if ($response->successful()) {
                // Save donation record
                $donation = Donation::create([
                    'user_id' => Auth::id(),
                    'amount' => $request->amount,
                    'reference' => $collectReference,
                    'status' => 'pending',
                    'orphanage_id' => $request->orphanage_id,
                    'campaign_id' => $request->campaign_id,
                    'anonymous' => $request->anonymous,
                    'donor_name' => $request->anonymous ? null : $request->name,
                    'donor_email' => $request->anonymous ? null : $request->email,
                    'message' => $request->description,
                    'phone_number' => $request->phone_number,
                    'payment_method' => $request->payment_method,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Payment initiated successfully',
                    'reference' => $collectReference,
                    'payment_url' => $response->json()['payment_url'] ?? null,
                    'donation' => $donation,
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to initiate payment',
                'error' => $response->json(),
            ], 400);
        } catch (\Exception $e) {
            Log::info('Donation processing error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your donation',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function handleWebhook(Request $request)
    {
        Log::info('Campay webhook received:', $request->all());

        $payload = $request->all();
        $reference = $payload['reference'] ?? null;
        $status = $payload['status'] ?? null;

        if (!$reference || !$status) {
            Log::error('Invalid webhook payload:', $payload);

            return response()->json(['message' => 'Invalid payload'], 400);
        }

        $donation = Donation::where('reference', $reference)->first();

        if (!$donation) {
            Log::error('Donation not found for reference:', ['reference' => $reference]);

            return response()->json(['message' => 'Donation not found'], 404);
        }

        $donation->status = strtolower($status);
        $donation->save();

        if ($status === 'SUCCESSFUL') {
            $this->sendDonationConfirmation($donation);
        }

        return response()->json(['message' => 'Webhook processed']);
    }

    public function thankYou()
    {
        return view('donations.thankyou');
    }

    public function checkCollectStatus($reference)
    {
        $donation = Donation::where('reference', $reference)->first();

        if (!$donation) {
            return response()->json([
                'success' => false,
                'message' => 'Donation not found',
            ], 404);
        }

        try {
            $accessToken = $this->getCampayAccessToken();

            $response = Http::withOptions([
                'verify' => 'C:\Users\Emie\Desktop\Newhope\certification\cacert.pem',
            ])->withHeaders([
                'Authorization' => "Token $accessToken",
                'Content-Type' => 'application/json',
            ])->get(env('CAMPAY_API_BASE_URL')."/transaction/$reference/");

            if ($response->successful()) {
                $status = $response->json()['status'] ?? null;

                if ($status) {
                    $donation->status = strtolower($status);
                    $donation->save();

                    if ($status === 'SUCCESSFUL') {
                        $this->sendDonationConfirmation($donation);
                    }
                }

                return response()->json([
                    'success' => true,
                    'collectStatus' => $status,
                    'donation' => $donation,
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to check status',
                'error' => $response->json(),
            ], 400);
        } catch (\Exception $e) {
            Log::error('Error checking collect status:', [
                'reference' => $reference,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    private function sendDonationConfirmation(Donation $donation)
    {
        try {
            // Implement your email notification logic here
            // Example:
            // Mail::to($donation->donor_email)->send(new DonationConfirmation($donation));

            Log::info('Donation confirmation sent for:', ['donation_id' => $donation->id]);
        } catch (\Exception $e) {
            Log::error('Failed to send donation confirmation:', [
                'donation_id' => $donation->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function getCampayAccessToken()
    {
        try {
            $response = Http::withOptions([
                'verify' => 'C:\Users\Emie\Desktop\Newhope\certification\cacert.pem',
                // 'verify' => 'certification/cacert.pem',
            ])->post($this->campayApiBaseUrl.'/token/', [
                'username' => $this->campayAppUsername,
                'password' => $this->campayAppPassword,
            ]);

            if ($response->successful()) {
                return $response->json()['token'];
            } else {
                Log::error('Error fetching Campay access token:', $response->json());
                throw new \Exception('Failed to obtain Campay access token. Please check credentials and base URL.');
            }
        } catch (\Exception $e) {
            Log::error('Exception fetching Campay access token:', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
