<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CampayController extends Controller
{
    // --- Configuration ---
    private $campayApiBaseUrl;
    private $campayAppUsername;
    private $campayAppPassword;

    public function __construct()
    {
        $this->campayApiBaseUrl = env('CAMPAY_API_BASE_URL');
        $this->campayAppUsername = env('CAMPAY_APP_USERNAME');
        $this->campayAppPassword = env('CAMPAY_APP_PASSWORD');
    }

    // --- Helper function to get Campay Access Token ---
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

    // --- Internal function to handle Disbursement ---
    private function performDisbursement($data, $accessToken)
    {
        $receiverPhoneNumber = $data['receiverPhoneNumber'];
        $grossAmount = $data['grossAmount'];
        $currency = $data['currency'];
        $senderPhoneNumber = $data['senderPhoneNumber'];
        $collectReference = $data['collectReference'];

        $FEE_PERCENTAGE = 0.1; // 10% fee
        $feeAmount = $grossAmount * $FEE_PERCENTAGE;
        $netAmount = round($grossAmount - $feeAmount);

        $disburseReference = 'DISBURSE_'.time().'_'.substr(md5(uniqid()), 0, 9);

        Log::info("--- Initiating Disburse for collectRef: $collectReference ---");
        Log::info("Disbursing $netAmount $currency to $receiverPhoneNumber...");

        $headers = [
            'Authorization' => "Token $accessToken",
            'Content-Type' => 'application/json',
        ];

        $disbursePayload = [
            'amount' => $netAmount,
            'currency' => $currency,
            'to' => $receiverPhoneNumber,
            'description' => "Exchange from $senderPhoneNumber (Fee: $feeAmount) - Related to collect: $collectReference",
            'external_reference' => $disburseReference,
        ];

        try {
            $response = Http::withHeaders($headers)
                ->post($this->campayApiBaseUrl.'/withdraw/', $disbursePayload);

            if ($response->successful() && $response->json()['status'] === 'SUCCESSFUL') {
                Log::info('Disbursement successful:', $response->json());

                return [
                    'success' => true,
                    'message' => 'Disbursement completed successfully.',
                    'disburseDetails' => $response->json(),
                ];
            } else {
                Log::error('Campay Disburse failed:', $response->json());

                return [
                    'success' => false,
                    'message' => 'Disbursement failed or is pending Campay processing.',
                    'disburseDetails' => $response->json(),
                ];
            }
        } catch (\Exception $e) {
            Log::error('Error during Campay disbursement:', ['error' => $e->getMessage()]);

            return [
                'success' => false,
                'message' => 'An error occurred during disbursement API call.',
                'errorDetails' => $e->getMessage(),
            ];
        }
    }

    // --- POST /api/campay/exchange-with-fee ---
    public function exchangeWithFee(Request $request)
    {
        // dd($request);
        $request->validate([
            'senderPhoneNumber' => 'required|string',
            'receiverPhoneNumber' => 'required|string',
            'grossAmount' => 'required|numeric|min:0.01',
            'currency' => 'required|string',
            'description' => 'sometimes|string',
        ]);

        $senderPhoneNumber = $request->input('senderPhoneNumber');
        $receiverPhoneNumber = $request->input('receiverPhoneNumber');
        $grossAmount = $request->input('grossAmount');
        $currency = $request->input('currency');
        $description = $request->input('description', 'Collection for money exchange');

        // Phone number validation (Cameroon example)
        $phoneRegex = '/^237\d{9}$/';
        if (!preg_match($phoneRegex, $senderPhoneNumber)) {
            return response()->json(['message' => 'Invalid sender phone number format. Must include country code (e.g., 237xxxxxxxxx).'], 400);
        }
        if (!preg_match($phoneRegex, $receiverPhoneNumber)) {
            return response()->json(['message' => 'Invalid receiver phone number format. Must include country code (e.g., 237xxxxxxxxx).'], 400);
        }

        try {
            $accessToken = $this->getCampayAccessToken();
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

        $collectReference = 'COLLECT_'.time().'_'.substr(md5(uniqid()), 0, 9);

        try {
            Log::info("Requesting $grossAmount $currency from $senderPhoneNumber...");

            $headers = [
                'Authorization' => "Token $accessToken",
                'Content-Type' => 'application/json',
            ];

            $collectPayload = [
                'amount' => $grossAmount,
                'currency' => $currency,
                'from' => $senderPhoneNumber,
                'description' => $description,
                'external_reference' => $collectReference,
            ];

            $response = Http::withHeaders($headers)->withOptions([
                'verify' => 'C:\Users\Emie\Desktop\Newhope\certification\cacert.pem',
                // 'verify' => '../../../certification/cacert.pem',
            ])
                ->post($this->campayApiBaseUrl.'/collect/', $collectPayload);

            if ($response->successful()) {
                Log::info('Campay Collect Initiation successful:', $response->json());

                // Here you would typically store the transaction in your database
                // with status 'PENDING_COLLECTION'

                return response()->json([
                    'message' => 'Money collection initiated. Awaiting sender confirmation and Campay processing.',
                    'status' => $response->json()['status'] ?? 'PENDING',
                    'collectReference' => $collectReference,
                    'details' => $response->json(),
                    'receiverPhoneNumber' => $receiverPhoneNumber,
                    'nextSteps' => 'Monitor transaction status using the collectReference or await webhook for completion.',
                ], 202);
            } else {
                Log::error('Campay Collect Initiation failed with unexpected status:', $response->json());

                return response()->json([
                    'message' => 'Failed to initiate money collection from sender.',
                    'details' => $response->json(),
                ], 400);
            }
        } catch (\Exception $e) {
            Log::error('Error during Campay collect initiation:', ['error' => $e->getMessage()]);

            return response()->json([
                'message' => 'An unexpected error occurred during the collection initiation.',
                'campayError' => $e->getMessage(),
                'collectReference' => $collectReference,
            ], 500);
        }
    }

    // --- Webhook Listener for Campay Status Updates ---
    public function handleCampayWebhook(Request $request)
    {
        Log::info('Received Campay Webhook:', $request->all());

        $transaction = $request->all();
        $paymentReference = $transaction['reference'] ?? null;
        $status = $transaction['status'] ?? null;

        if (!$paymentReference || !$status) {
            return response()->json(['message' => 'Invalid webhook payload'], 400);
        }

        // In a real application, you would retrieve this from your database
        $storedTransactionData = [
            'senderPhoneNumber' => '2376XXXXXXXXX', // Retrieve from DB based on paymentReference
            'receiverPhoneNumber' => '2376YYYYYYYYY', // Retrieve from DB
            'grossAmount' => 1000, // Retrieve from DB
            'currency' => 'XAF', // Retrieve from DB
            'collectReference' => $paymentReference,
        ];

        if ($status === 'SUCCESSFUL') {
            Log::info("Collect transaction $paymentReference is SUCCESSFUL. Proceeding to disburse.");

            try {
                $accessToken = $this->getCampayAccessToken();
                $disburseResult = $this->performDisbursement($storedTransactionData, $accessToken);

                if ($disburseResult['success']) {
                    Log::info("Disbursement for $paymentReference completed.");

                    return response()->json(['message' => 'Webhook processed: Disbursement successful.']);
                } else {
                    Log::error("Disbursement for $paymentReference failed:", $disburseResult['message']);

                    return response()->json(['message' => 'Webhook processed: Disbursement failed (reconciliation needed).']);
                }
            } catch (\Exception $e) {
                Log::error("Webhook: Failed to process disbursement for $paymentReference:", ['error' => $e->getMessage()]);

                return response()->json(['message' => 'Failed to process webhook: Token error.'], 500);
            }
        } elseif (in_array($status, ['FAILED', 'CANCELLED'])) {
            Log::info("Collect transaction $paymentReference $status. No disbursement needed.");

            return response()->json(['message' => 'Webhook processed: Collection failed.']);
        } else {
            Log::info("Collect transaction $paymentReference is $status. Waiting for final status.");

            return response()->json(['message' => 'Webhook processed: Status updated.']);
        }
    }

    // --- Polling to Check Transaction Status ---
    public function checkCollectStatus($collectReference)
    {
        if (!$collectReference) {
            return response()->json(['message' => 'Missing collectReference parameter.'], 400);
        }

        try {
            $accessToken = $this->getCampayAccessToken();
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

        $headers = [
            'Authorization' => "Token $accessToken",
            'Content-Type' => 'application/json',
        ];

        try {
            $response = Http::withHeaders($headers)
                ->get($this->campayApiBaseUrl."/transaction/$collectReference/");

            $transactionStatus = $response->json()['status'] ?? null;
            Log::info("Status for $collectReference: $transactionStatus");

            if ($transactionStatus === 'SUCCESSFUL') {
                // In a real app, you would retrieve this from your database
                $storedTransactionData = [
                    'senderPhoneNumber' => '237651558567',
                    'receiverPhoneNumber' => '237651558567',
                    'grossAmount' => 10,
                    'currency' => 'XAF',
                    'collectReference' => $collectReference,
                ];

                $disburseResult = $this->performDisbursement($storedTransactionData, $accessToken);

                return response()->json([
                    'message' => 'Collection successful. Disbursement '.($disburseResult['success'] ? 'initiated' : 'failed to initiate').'.',
                    'collectStatus' => $transactionStatus,
                    'disburseStatus' => $disburseResult['disburseDetails']['status'] ?? 'N/A',
                    'details' => $response->json(),
                ]);
            } else {
                return response()->json([
                    'message' => 'Collection status checked.',
                    'collectStatus' => $transactionStatus,
                    'details' => $response->json(),
                ]);
            }
        } catch (\Exception $e) {
            Log::error("Error checking status for $collectReference:", ['error' => $e->getMessage()]);

            return response()->json([
                'message' => 'Failed to check transaction status.',
                'campayError' => $e->getMessage(),
            ], 500);
        }
    }
}
