<?php
namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AiController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $client = new Client();
        $response = $client->post('https://api.openai.com/v1/engines/davinci-codex/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'prompt' => $request->input('message'),
                'max_tokens' => 150,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        return response()->json([
            'response' => $data['choices'][0]['text'],
        ]);
    }
}
