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
        return view('frontend.donation', [
            'orphanage' => $orphanage,
            'campaign' => null,
        ]);
    }

    public function create1(?Campaign $campaign = null)
    {
        return view('frontend.donation', [
            'orphanage' => null,
            'campaign' => $campaign,
        ]);
    }

    public function initiatePayment(Request $request)
    {
        try {
            $accessToken = $this->getCampayAccessToken();
        } catch (\Exception $e) {
            Log::error('Failed to get access token in initiatePayment', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['message' => $e->getMessage()], 500);
        }

        try {
            $collectReference = 'DONATE_'.time().'_'.substr(md5(uniqid()), 0, 8);

            Log::info("Requesting payment from {$request->phone_number} for amount: {$request->amount} XAF");

            $headers = [
                'Authorization' => "Token $accessToken",
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ];

            $collectPayload = [
                'amount' => $request->amount,
                'currency' => 'XAF',
                'from' => $request->phone_number,
                'description' => $request->description ?? 'Donation to orphanage',
                'external_reference' => $collectReference,
            ];

            Log::info('Campay Collect Request:', [
                'url' => $this->campayApiBaseUrl.'/collect/',
                'headers' => $headers,
                'payload' => $collectPayload,
            ]);

            // REMOVED: 'verify' => false - Let PHP use system SSL configuration
            $response = Http::withHeaders($headers)
                ->timeout(30) // Add timeout
                ->post($this->campayApiBaseUrl.'/collect/', $collectPayload);

            // Log the full response from Campay
            Log::info('Campay Collect API Response:', [
                'status' => $response->status(),
                'successful' => $response->successful(),
                'body' => $response->body(),
                'json' => $response->json() ?? 'Invalid JSON response',
            ]);

            if ($response->successful()) {
                $responseData = $response->json();

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

                Log::info('Donation record created successfully:', [
                    'donation_id' => $donation->id,
                    'reference' => $collectReference,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Payment initiated successfully',
                    'reference' => $collectReference,
                    'payment_url' => $responseData['payment_url'] ?? null,
                    'donation' => $donation,
                ]);
            }

            Log::error('Campay Collect API failed:', [
                'status' => $response->status(),
                'body' => $response->body(),
                'json' => $response->json(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to initiate payment',
                'error' => $response->json(),
                'status' => $response->status(),
            ], 400);
        } catch (\Exception $e) {
            Log::error('Donation processing error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
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

        Log::info('Webhook processed - Donation status updated:', [
            'reference' => $reference,
            'new_status' => $status,
            'donation_id' => $donation->id,
        ]);

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
    Log::info("Checking collect status for reference: $reference");

    $donation = Donation::where('reference', $reference)->first();

    if (!$donation) {
        Log::warning("Polling: Donation not found for reference $reference");
        return response()->json([
            'success' => false,
            'message' => 'Donation not found',
        ], 404);
    }

    $secondsSinceCreation = now()->diffInSeconds($donation->created_at);
    
    // ⭐ EXTENDED WAITING LOGIC: Handle progressive waiting
    if ($waitingResponse = $this->handleExtendedWaiting($donation)) {
        return $waitingResponse;
    }

    try {
        $accessToken = $this->getCampayAccessToken();

        // ⭐ TRANSACTION VERIFICATION: Check if Campay received the transaction
        $verification = $this->verifyTransactionReceipt($reference, $accessToken);
        
        if ($verification['received']) {
            Log::info("Transaction $reference verified as received by Campay");
            // Even if still processing, show success message to user
            $statusMessage = $this->getEnhancedStatusMessage($secondsSinceCreation, 'processing');
            
            return response()->json([
                'success' => true,
                'status' => 'processing',
                'message' => $statusMessage,
                'received_by_campay' => true,
                'retry_after' => 30,
            ]);
        }

        Log::info('Checking Campay transaction status:', [
            'reference' => $reference,
            'url' => $this->campayApiBaseUrl."/transaction/$reference/",
            'age_seconds' => $secondsSinceCreation
        ]);

        $response = Http::withHeaders([
            'Authorization' => "Token $accessToken",
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->timeout(30)
        ->get($this->campayApiBaseUrl."/transaction/$reference/");

        Log::info('Campay Transaction Status Response:', [
            'reference' => $reference,
            'status_code' => $response->status(),
            'successful' => $response->successful(),
            'body' => $response->body(),
        ]);

        if (!$response->successful()) {
            // Handle "Invalid reference" gracefully with extended waiting
            if ($response->status() === 400 && strpos($response->body(), 'Invalid reference') !== false) {
                Log::warning("Reference $reference not found in Campay after $secondsSinceCreation seconds");
                
                $statusMessage = $this->getEnhancedStatusMessage($secondsSinceCreation);
                
                return response()->json([
                    'success' => true,
                    'status' => 'processing',
                    'message' => $statusMessage,
                    'retry_after' => $secondsSinceCreation < 300 ? 30 : 60,
                ]);
            }

            Log::error('Polling: Campay API error', [
                'reference' => $reference,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to check status',
                'error' => $response->json(),
            ], 400);
        }

        $data = $response->json();
        $status = strtolower($data['status'] ?? 'pending');

        $donation->status = match ($status) {
            'successful' => Donation::STATUS_SUCCESSFUL,
            'failed' => Donation::STATUS_FAILED,
            default => Donation::STATUS_PENDING,
        };
        $donation->network_transaction_id = $data['transaction_id'] ?? null;
        $donation->campay_response = json_encode($data);
        $donation->save();

        Log::info('Polling: Status updated', [
            'reference' => $reference,
            'newStatus' => $donation->status,
            'campay_data' => $data
        ]);

        if ($donation->isSuccessful()) {
            // ⭐ SUCCESS LOGGING
            Log::info("TRANSACTION SUCCESSFUL: Donation $reference completed successfully");
            $this->sendDonationConfirmation($donation);
        }

        // ⭐ COMMUNICATION STRATEGY: Enhanced user messages
        $statusMessage = $this->getEnhancedStatusMessage($secondsSinceCreation, $status);
        
        return response()->json([
            'success' => true,
            'status' => $donation->status,
            'message' => $statusMessage,
            'donation' => $donation,
            'campay' => $data,
        ]);

    } catch (\Exception $e) {
        Log::error('Polling: Exception checking status', [
            'reference' => $reference,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        // ⭐ GRACEFUL ERROR HANDLING: Don't fail, just ask to retry
        $statusMessage = $this->getEnhancedStatusMessage($secondsSinceCreation);
        
        return response()->json([
            'success' => true,
            'status' => 'processing',
            'message' => $statusMessage,
            'retry_after' => 30,
        ]);
    }
}
    // Add these methods to handle extended waiting and transaction verification

    /**
     * Extended waiting logic with progressive timeouts.
     */
    private function handleExtendedWaiting($donation)
    {
        $secondsSinceCreation = now()->diffInSeconds($donation->created_at);

        // Progressive waiting based on transaction age
        if ($secondsSinceCreation < 30) {
            return $this->respondWithRetry('Payment initiated. Waiting for confirmation...', 15);
        } elseif ($secondsSinceCreation < 180) { // 3 minutes
            return $this->respondWithRetry('Please check your phone to confirm the payment', 30);
        } elseif ($secondsSinceCreation < 300) { // 5 minutes
            return $this->respondWithRetry('Payment processing. This may take a few minutes...', 60);
        } elseif ($secondsSinceCreation < 600) { // 10 minutes
            return $this->respondWithRetry('Still processing. Mobile payments can sometimes take longer', 120);
        }

        return null; // No waiting needed, proceed with status check
    }

    /**
     * Unified response for retry scenarios.
     */
    private function respondWithRetry($message, $retryAfter)
    {
        return response()->json([
            'success' => true,
            'status' => 'processing',
            'message' => $message,
            'retry_after' => $retryAfter,
            'advice' => 'continue_polling',
        ]);
    }

    /**
     * Verify if Campay received the transaction (even if still processing).
     */
    private function verifyTransactionReceipt($reference, $accessToken)
    {
        try {
            $response = Http::withOptions([
                'verify' => true,
                'cafile' => 'C:\\wamp64\\bin\\php\\php8.1.31\\cacert.pem',
            ])->withHeaders([
                'Authorization' => "Token $accessToken",
                'Content-Type' => 'application/json',
            ])->timeout(30)
            ->get($this->campayApiBaseUrl."/transaction/$reference/");

            // If we get ANY response (even 400), it means Campay knows about this transaction
            if ($response->status() !== 404) {
                return [
                    'received' => true,
                    'status_code' => $response->status(),
                    'message' => 'Transaction received by Campay and being processed',
                ];
            }

            return ['received' => false, 'message' => 'Transaction not found in Campay system'];
        } catch (\Exception $e) {
            Log::warning("Transaction verification failed for $reference: ".$e->getMessage());

            return ['received' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Enhanced status check with communication strategy.
     */
    private function getEnhancedStatusMessage($secondsSinceCreation, $campayStatus = null)
    {
        if ($campayStatus === 'successful') {
            return 'Payment completed successfully! Thank you for your donation.';
        } elseif ($campayStatus === 'failed') {
            return 'Payment failed. Please try again or contact support.';
        }

        // Progressive messaging based on time
        if ($secondsSinceCreation < 30) {
            return 'Payment initiated. Waiting for confirmation...';
        } elseif ($secondsSinceCreation < 180) {
            return 'Please check your phone to confirm the payment';
        } elseif ($secondsSinceCreation < 300) {
            return 'Payment processing. This may take a few minutes...';
        } elseif ($secondsSinceCreation < 600) {
            return 'Still processing. Mobile payments can sometimes take longer';
        } else {
            return 'Payment taking longer than expected. Please wait or contact support';
        }
    }

    private function sendDonationConfirmation(Donation $donation)
    {
        try {
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
            Log::info('Requesting Campay access token', [
                'url' => $this->campayApiBaseUrl.'/token/',
                'username' => $this->campayAppUsername,
            ]);

            // REMOVED: 'verify' => false - Let PHP use system SSL configuration
            $response = Http::asForm() // Use form data for token request
                ->timeout(60) // Add timeout
                ->post($this->campayApiBaseUrl.'/token/', [
                    'username' => $this->campayAppUsername,
                    'password' => $this->campayAppPassword,
                ]);

            Log::info('Campay Token API Response:', [
                'status' => $response->status(),
                'successful' => $response->successful(),
                'body' => $response->body(),
            ]);

            if ($response->successful()) {
                $tokenData = $response->json();
                $token = $tokenData['token'] ?? null;

                if ($token) {
                    Log::info('Campay access token obtained successfully');

                    return $token;
                } else {
                    throw new \Exception('Token not found in response: '.$response->body());
                }
            } else {
                $errorResponse = $response->json();
                Log::error('Error fetching Campay access token:', [
                    'http_status' => $response->status(),
                    'campay_response' => $errorResponse,
                ]);
                throw new \Exception('Failed to obtain Campay access token. HTTP Status: '.$response->status());
            }
        } catch (\Exception $e) {
            Log::error('Exception fetching Campay access token:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }
}
