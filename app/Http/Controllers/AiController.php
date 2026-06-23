<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $userMessage = $request->input('message');

        try {
            $response = Http::withToken(config('services.nvidia.api_key'))
                ->timeout(60)
                ->post(config('services.nvidia.api_url'), [
                    'model' => config('services.nvidia.model'),
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'Kamu adalah Babu-Mu, asisten AI di aplikasi Awfulnotes yang membantu mahasiswa mengerjakan tugas. Jawab singkat, jelas, ramah, dan gunakan Bahasa Indonesia kecuali user menulis dalam bahasa lain.',
                        ],
                        [
                            'role' => 'user',
                            'content' => $userMessage,
                        ],
                    ],
                    'temperature' => 1,
                    'top_p' => 0.9,
                    'max_tokens' => 1024,
                ]);

            if ($response->failed()) {
                Log::error('NVIDIA API error', ['status' => $response->status(), 'body' => $response->body()]);
                return response()->json(['reply' => 'Maaf, AI sedang bermasalah. Coba lagi sebentar.'], 500);
            }

            $data = $response->json();
            $reply = $data['choices'][0]['message']['content'] ?? 'Maaf, tidak bisa menjawab saat ini.';

            return response()->json(['reply' => trim($reply)]);

        } catch (\Throwable $e) {
            Log::error('NVIDIA API exception', ['message' => $e->getMessage()]);
            return response()->json(['reply' => 'Maaf, koneksi ke AI gagal.'], 500);
        }
    }
}