<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GeminiClient
{
    public function generate(string $userText): array
    {
        $apiKey = config('gemini.api_key');
        $baseUrl = config('gemini.base_url');
        $model = config('gemini.model');
        $timeout = (int) config('gemini.timeout', 20);

        if (!$apiKey) {
            Log::channel('chatbot')->error('Missing GEMINI_API_KEY');

            return ['error' => 'Server is missing AI credentials.'];
        }

        // Load extra “context” text if present
        $contextPath = storage_path('app/legal/context.md');
        $context = is_file($contextPath) ? file_get_contents($contextPath) : '';

        // Strong system instruction to keep scope tight (English+French)
        $systemInstruction = [
            'parts' => [['text' => trim("
You are a Cameroonian child-law specialist. Stay strictly within:
- child law in Cameroon; and
- creating/running orphanages in Cameroon.

If user asks outside scope, reply:
\"I can only help with child law in Cameroon and orphanages.\"

Use step-by-step, concise, actionable guidance. If legal risk, advise consulting a qualified Cameroonian lawyer or the Ministry of Social Affairs.

Language: answer in the user's language (English or French). Avoid speculation. If uncertain, say so.

Additional context:
$context
")]],
        ];

        $payload = [
            'system_instruction' => $systemInstruction, // per REST docs (snake_case)
            'contents' => [[
                'role' => 'user',
                'parts' => [['text' => $userText]],
            ]],
            'generationConfig' => [
                'temperature' => 0.3,
                'topP' => 0.9,
                'topK' => 32,
                'maxOutputTokens' => 1024,
                // Optional: disable "thinking" budgets if you want fastest replies
                // 'thinkingConfig' => [ 'thinkingBudget' => 0 ],
            ],
            // You can optionally add safetySettings here.
        ];

        $url = "{$baseUrl}/models/{$model}:generateContent";

        $started = microtime(true);
        try {
            // $response = Http::timeout($timeout)
            // ->retry(2, 200) // 2 retries, 200ms backoff
            // ->withHeaders([
            // 'Content-Type'   => 'application/json',
            // 'x-goog-api-key' => $apiKey, // per REST docs
            // ])
            // ->post($url, $payload);
            $response = Http::timeout($timeout)
            ->retry(2, 200)
            ->withOptions([
                'verify' => false, //  disables SSL verification (testing only!)
            ])
            ->withHeaders([
                'Content-Type' => 'application/json',
                'x-goog-api-key' => $apiKey,
            ])
            ->post($url, $payload);

            $ms = (int) ((microtime(true) - $started) * 1000);

            if (!$response->successful()) {
                Log::channel('chatbot')->error('Gemini HTTP error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'time_ms' => $ms,
                ]);

                return ['error' => 'Gemini API error: HTTP '.$response->status()];
            }

            $data = $response->json();
            $blockReason = data_get($data, 'promptFeedback.blockReason');
            if ($blockReason) {
                Log::channel('chatbot')->warning('Prompt blocked by Gemini', [
                    'reason' => $blockReason,
                    'time_ms' => $ms,
                ]);

                return [
                    'answer' => "Your question triggered a safety block: {$blockReason}. "
                              .'Please rephrase within child law/orphanages in Cameroon.',
                    'blocked_by' => 'gemini_safety',
                ];
            }

            $text = data_get($data, 'candidates.0.content.parts.0.text');
            if (!is_string($text) || $text === '') {
                Log::channel('chatbot')->error('No text candidate in Gemini response', [
                    'data' => $data,
                    'time_ms' => $ms,
                ]);

                return ['error' => 'Empty response from AI. Try again.'];
            }

            // Log basic usage metadata if present
            $usage = [
                'prompt' => data_get($data, 'usageMetadata.promptTokenCount'),
                'output' => data_get($data, 'usageMetadata.candidatesTokenCount'),
                'model' => data_get($data, 'modelVersion'),
                'resp_id' => data_get($data, 'responseId'),
                'time_ms' => $ms,
            ];
            Log::channel('chatbot')->info('Gemini success', $usage + [
                'question_preview' => Str::limit($userText, 200),
            ]);

            return ['answer' => $text, 'usage' => $usage];
        } catch (\Throwable $e) {
            Log::channel('chatbot')->error('Gemini exception', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'trace' => Str::limit($e->getTraceAsString(), 5000),
            ]);

            return ['error' => 'Server error talking to AI. Please try again.'];
        }
    }
}
