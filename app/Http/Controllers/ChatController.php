<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatRequest;
use App\Services\GeminiClient;
use Illuminate\Http\JsonResponse;

class ChatController extends Controller
{
    public function __construct(private GeminiClient $gemini) {}

    /** Page */
    public function view()
    {
        return view('chat');
    }

    /** AJAX endpoint */
    public function ask(ChatRequest $request): JsonResponse
    {
        $result = $this->gemini->generate($request->string('message'));

        // Normalize the JSON structure for the frontend
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], 500);
        }
        return response()->json($result, 200);
    }
}
