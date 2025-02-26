<?php

namespace App\Http\Controllers;

use App\Models\AiConversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

            Log::debug('OpenRouter API Response:', [
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
            Log::error('AI Chat Error:', [
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

    public function emojiGenerator(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string',
            'style' => 'required|string|in:flat,3d,cartoon,pixel,hand-drawn',
        ]);

        try {
            // Create an enhanced prompt that specifies emoji style
            $enhancedPrompt = "Create a simple emoji of {$request->prompt} in {$request->style} style. Make it cute, simple, and expressive. The image should be centered with a clean background.";

            // Use the same image generation API that's already working in your app
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('HUGGINGFACE_API_KEY')
            ])->post('https://api-inference.huggingface.co/models/stabilityai/stable-diffusion-xl-base-1.0', [
                'inputs' => $enhancedPrompt,
                'parameters' => [
                    'negative_prompt' => 'blurry, bad quality, distorted, text, words, letters, complex background, multiple subjects',
                    'num_inference_steps' => 25,
                    'guidance_scale' => 7.0,
                    'width' => 512,
                    'height' => 512
                ]
            ]);

            if (!$response->successful()) {
                throw new \Exception('Emoji generation failed: ' . $response->body());
            }

            // Process the images
            $imageData = $response->body();
            $base64Image = base64_encode($imageData);
            $imageUrl = 'data:image/jpeg;base64,' . $base64Image;

            // Generate 4 variations by making additional API calls
            $emojis = [['url' => $imageUrl]];

            // Make 3 more API calls with slight variations to the prompt
            $variations = [
                " with a different expression",
                " in a different pose",
                " with a different color scheme"
            ];

            foreach ($variations as $variation) {
                try {
                    $varResponse = Http::withHeaders([
                        'Authorization' => 'Bearer ' . env('HUGGINGFACE_API_KEY')
                    ])->post('https://api-inference.huggingface.co/models/stabilityai/stable-diffusion-xl-base-1.0', [
                        'inputs' => $enhancedPrompt . $variation,
                        'parameters' => [
                            'negative_prompt' => 'blurry, bad quality, distorted, text, words, letters, complex background, multiple subjects',
                            'num_inference_steps' => 25,
                            'guidance_scale' => 7.0,
                            'width' => 512,
                            'height' => 512
                        ]
                    ]);

                    if ($varResponse->successful()) {
                        $varImageData = $varResponse->body();
                        $varBase64Image = base64_encode($varImageData);
                        $emojis[] = ['url' => 'data:image/jpeg;base64,' . $varBase64Image];
                    }
                } catch (\Exception $e) {
                    Log::warning('Failed to generate emoji variation: ' . $e->getMessage());
                    // Continue with the ones we have
                }
            }

            return response()->json([
                'success' => true,
                'emojis' => $emojis,
            ]);
        } catch (\Exception $e) {
            Log::error('Emoji generation failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Failed to generate emoji: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function colorPalette(Request $request)
    {
        $request->validate([
            'paletteSize' => 'required|integer|min:3|max:10',
            'prompt' => 'required_without:image|string|nullable',
            'image' => 'required_without:prompt|file|image|max:5120|nullable',
        ]);

        try {
            $paletteSize = $request->paletteSize;
            $colors = [];
            $description = "";

            // If an image was uploaded, analyze it to extract colors
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageData = file_get_contents($image->path());
                $base64Image = base64_encode($imageData);

                // First, get a description of the image using Hugging Face
                $descriptionResponse = Http::withHeaders([
                    'Authorization' => 'Bearer ' . env('HUGGINGFACE_API_KEY')
                ])->post('https://api-inference.huggingface.co/models/Salesforce/blip-image-captioning-large', [
                    'inputs' => [
                        'image' => $base64Image
                    ]
                ]);

                if ($descriptionResponse->successful()) {
                    $description = $descriptionResponse->json()[0]['generated_text'] ?? "Image analysis";
                    Log::info("Image description: " . $description);
                } else {
                    Log::warning("Failed to get image description: " . $descriptionResponse->body());
                    $description = "Uploaded image";
                }

                // Use OpenRouter to analyze the image and suggest colors
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
                    'HTTP-Referer' => config('app.url'),
                    'x-title' => 'AI Hub Color Palette',
                    'Content-Type' => 'application/json',
                ])->post('https://openrouter.ai/api/v1/chat/completions', [
                    'model' => 'google/gemini-pro-vision:free',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => "You are a color palette expert. Extract exactly {$paletteSize} dominant or complementary colors from the image. For each color, provide the hex code, RGB values, and a descriptive name. Format your response as a valid JSON array with objects containing 'hex', 'rgb', and 'name' properties. Do not include any explanations or text outside the JSON array."
                        ],
                        [
                            'role' => 'user',
                            'content' => [
                                [
                                    'type' => 'text',
                                    'text' => "Generate a color palette with {$paletteSize} colors from this image."
                                ],
                                [
                                    'type' => 'image_url',
                                    'image_url' => [
                                        'url' => "data:image/jpeg;base64,{$base64Image}"
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'max_tokens' => 1000,
                    'temperature' => 0.2
                ]);

                if (!$response->successful()) {
                    throw new \Exception('API request failed: ' . $response->body());
                }

                $responseData = $response->json();
                $content = $responseData['choices'][0]['message']['content'] ?? '';

                // Extract the JSON part from the response
                preg_match('/\[.*\]/s', $content, $matches);
                if (empty($matches)) {
                    throw new \Exception('Could not extract JSON from response');
                }

                $jsonStr = $matches[0];
                $colors = json_decode($jsonStr, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new \Exception('Invalid JSON response: ' . json_last_error_msg());
                }
            } else {
                // Use text prompt to generate colors
                $prompt = $request->prompt;

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
                    'HTTP-Referer' => config('app.url'),
                    'x-title' => 'AI Hub Color Palette',
                    'Content-Type' => 'application/json',
                ])->post('https://openrouter.ai/api/v1/chat/completions', [
                    'model' => 'google/gemini-2.0-flash-exp:free',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => "You are a color palette expert. Generate exactly {$paletteSize} colors that match the theme or description provided. For each color, provide the hex code, RGB values, and a descriptive name. Format your response as a valid JSON array with objects containing 'hex', 'rgb', and 'name' properties. Do not include any explanations or text outside the JSON array."
                        ],
                        [
                            'role' => 'user',
                            'content' => "Generate a color palette with {$paletteSize} colors for this theme: {$prompt}"
                        ]
                    ],
                    'max_tokens' => 1000,
                    'temperature' => 0.7
                ]);

                if (!$response->successful()) {
                    throw new \Exception('API request failed: ' . $response->body());
                }

                $responseData = $response->json();
                $content = $responseData['choices'][0]['message']['content'] ?? '';

                // Extract the JSON part from the response
                preg_match('/\[.*\]/s', $content, $matches);
                if (empty($matches)) {
                    throw new \Exception('Could not extract JSON from response');
                }

                $jsonStr = $matches[0];
                $colors = json_decode($jsonStr, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new \Exception('Invalid JSON response: ' . json_last_error_msg());
                }

                $description = $prompt;
            }

            // Ensure we have exactly the requested number of colors
            $colors = array_slice($colors, 0, $paletteSize);

            return response()->json([
                'success' => true,
                'palette' => $colors,
                'description' => $description
            ]);
        } catch (\Exception $e) {
            Log::error('Color palette generation failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Failed to generate color palette: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function nameGenerator(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:business,app,website,product,project',
            'description' => 'required|string|max:1000',
            'keywords' => 'nullable|string|max:500',
            'count' => 'required|integer|min:5|max:20',
        ]);

        try {
            $type = $request->type;
            $description = $request->description;
            $keywords = $request->keywords;
            $count = (int) $request->count;

            // Create a prompt for the AI
            $prompt = "Generate {$count} unique and creative names for a {$type} with the following description: {$description}.";

            if (!empty($keywords)) {
                $prompt .= " Consider these keywords or themes: {$keywords}.";
            }

            $prompt .= " For each name, provide a brief explanation of why it's appropriate. Format your response as a valid JSON array with objects containing 'name' and 'description' properties. Do not include any explanations or text outside the JSON array.";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
                'HTTP-Referer' => config('app.url'),
                'x-title' => 'AI Hub Name Generator',
                'Content-Type' => 'application/json',
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'google/gemini-2.0-flash-exp:free',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => "You are a creative naming expert who specializes in creating unique, memorable, and appropriate names for businesses, apps, websites, products, and projects. Your names should be original, easy to remember, and reflect the purpose and values of what you're naming."
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'max_tokens' => 2000,
                'temperature' => 0.8
            ]);

            if (!$response->successful()) {
                throw new \Exception('API request failed: ' . $response->body());
            }

            $responseData = $response->json();
            $content = $responseData['choices'][0]['message']['content'] ?? '';

            // Extract the JSON part from the response
            preg_match('/\[.*\]/s', $content, $matches);
            if (empty($matches)) {
                throw new \Exception('Could not extract JSON from response');
            }

            $jsonStr = $matches[0];
            $names = json_decode($jsonStr, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON response: ' . json_last_error_msg());
            }

            // Limit to the requested count
            $names = array_slice($names, 0, $count);

            return response()->json([
                'success' => true,
                'names' => $names
            ]);
        } catch (\Exception $e) {
            Log::error('Name generation failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Failed to generate names: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function checkDomains(Request $request)
    {
        $request->validate([
            'names' => 'required|array|min:1',
            'names.*' => 'string|max:100',
        ]);

        try {
            $names = $request->names;
            $availability = [];

            // For each name, check if the .com domain is available
            foreach ($names as $name) {
                // Convert to lowercase and remove spaces and special characters
                $domainName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $name));

                // In a real implementation, you would use a domain availability API
                // For this demo, we'll simulate with a random result
                $availability[] = (bool) rand(0, 1);
            }

            return response()->json([
                'success' => true,
                'availability' => $availability
            ]);
        } catch (\Exception $e) {
            Log::error('Domain check failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Failed to check domains: ' . $e->getMessage(),
            ], 500);
        }
    }
}
