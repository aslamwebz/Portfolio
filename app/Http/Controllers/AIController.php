<?php

namespace App\Http\Controllers;

use App\Models\AiConversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    private function getRateLimitInfo($response = null)
    {
        if ($response) {
            return [
                'limit' => (int) $response->header('x-ratelimit-limit'),
                'remaining' => (int) $response->header('x-ratelimit-remaining'),
                'reset' => $response->header('x-ratelimit-reset'),
                'tokens_used' => (int) $response->header('openrouter-tokens-used'),
                'model_tokens_used' => (int) $response->header('openrouter-model-tokens-used'),
            ];
        }

        // If no response provided, make a HEAD request to get limits
        $checkResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
            'HTTP-Referer' => config('app.url'),
            'x-title' => 'AI Hub Chat',
        ])->head('https://openrouter.ai/api/v1/auth/key');

        return [
            'limit' => (int) $checkResponse->header('x-ratelimit-limit'),
            'remaining' => (int) $checkResponse->header('x-ratelimit-remaining'),
            'reset' => $checkResponse->header('x-ratelimit-reset'),
            'tokens_used' => 0,
            'model_tokens_used' => 0,
        ];
    }

    public function checkRateLimit()
    {
        try {
            $rateLimit = $this->getRateLimitInfo();
            return response()->json([
                'success' => true,
                'rateLimit' => $rateLimit
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to check rate limit',
                'error' => config('app.debug') ? $e->getMessage() : 'An error occurred'
            ], 500);
        }
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
                'HTTP-Referer' => config('app.url'),
                'x-title' => 'AI Hub Chat',
                'Content-Type' => 'application/json',
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'google/gemini-2.0-flash-exp:free',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful AI assistant.'],
                    ['role' => 'user', 'content' => $request->message],
                ],
                'max_tokens' => 1000,
                'temperature' => 0.7,
                'stream' => false
            ]);

            $rateLimit = $this->getRateLimitInfo($response);

            \Log::debug('OpenRouter API Response:', [
                'status' => $response->status(),
                'body' => $response->json(),
                'headers' => $response->headers(),
            ]);

            if (!$response->successful()) {
                throw new \Exception('API request failed: ' . $response->body());
            }

            $responseData = $response->json();

            if (!isset($responseData['choices'][0]['message']['content'])) {
                throw new \Exception('Invalid response structure from API');
            }

            $content = $responseData['choices'][0]['message']['content'];

            if (!$content) {
                throw new \Exception('Empty response from AI');
            }

            return response()->json([
                'success' => true,
                'message' => $content,
                'rateLimit' => $rateLimit
            ]);
        } catch (\Exception $e) {
            \Log::error('AI Chat Error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to get response from AI',
                'error' => config('app.debug') ? $e->getMessage() : 'An error occurred'
            ], 500);
        }
    }

    public function getConversations()
    {
        try {
            $conversations = AiConversation::latest()->get();
            return response()->json([
                'success' => true,
                'conversations' => $conversations
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch conversations'
            ], 500);
        }
    }

    public function saveConversation(Request $request)
    {
        $request->validate([
            'messages' => 'required|array',
            'title' => 'nullable|string'
        ]);

        try {
            $title = $request->title ?? $this->generateTitle($request->messages);

            $conversation = AiConversation::create([
                'title' => $title,
                'messages' => $request->messages
            ]);

            return response()->json([
                'success' => true,
                'conversation' => $conversation
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save conversation'
            ], 500);
        }
    }

    private function generateTitle($messages)
    {
        // Get the first user message as the title
        $firstMessage = collect($messages)
            ->where('role', 'user')
            ->first();

        return substr($firstMessage['content'] ?? 'New Conversation', 0, 50) . '...';
    }

    public function generateImage(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|max:1000'
        ]);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('HUGGINGFACE_API_KEY')
            ])->post('https://api-inference.huggingface.co/models/stabilityai/stable-diffusion-xl-base-1.0', [
                'inputs' => $request->prompt,
                'parameters' => [
                    'negative_prompt' => 'blurry, bad quality, distorted',
                    'num_inference_steps' => 30,
                    'guidance_scale' => 7.5
                ]
            ]);

            if (!$response->successful()) {
                throw new \Exception('Image generation failed: ' . $response->body());
            }

            // The response is the image data
            $imageData = $response->body();
            $base64Image = base64_encode($imageData);

            return response()->json([
                'success' => true,
                'image' => 'data:image/jpeg;base64,' . $base64Image
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate image',
                'error' => config('app.debug') ? $e->getMessage() : 'An error occurred'
            ], 500);
        }
    }
}
