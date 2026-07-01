<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Assignment;

class AiController extends Controller
{
    public function chat(Request $request)
    {
        $userMessage = trim($request->input('message', ''));
        $userId = $request->user()?->id;

        if ($userMessage === '') {
            return response()->json(['reply' => 'Mau nanya apa nih? 😄', 'action' => false]);
        }

        $apiKey = config('services.nvidia.api_key');
        $apiUrl = config('services.nvidia.api_url');
        $model  = config('services.nvidia.model');

        if (!$apiKey || !$apiUrl || !$model) {
            Log::error('NVIDIA config kosong', ['apiUrl' => $apiUrl, 'model' => $model, 'apiKey_set' => (bool) $apiKey]);
            return response()->json(['reply' => '⚠️ Konfigurasi AI belum lengkap. Cek .env ya.', 'action' => false]);
        }

        $today = now()->toDateString();
        $systemPrompt = <<<PROMPT
        Kamu "Babu-Mu", asisten tugas mahasiswa di aplikasi Awfulnotes. Tanggal hari ini: {$today}.

        Kalau user minta MENAMBAH tugas/assignment, balas HANYA dengan JSON (tanpa teks lain, tanpa ```), format persis:
        {"action":"create_assignment","data":{"title":"...","subject":"...","deadline":"YYYY-MM-DD","priority":"medium","notes":"..."}}

        Kalau user minta MENGHAPUS/membatalkan tugas, balas HANYA dengan JSON (tanpa teks lain, tanpa ```), format persis:
        {"action":"delete_assignment","data":{"title":"..."}}

        Aturan:
        - create_assignment: "title" dan "subject" WAJIB. Kalau user nggak nyebut mata kuliah, isi "Umum". "deadline" (YYYY-MM-DD), "priority" (low/medium/high), "notes" opsional (null kalau gak disebut, priority default "medium").
        - delete_assignment: "title" = judul tugas yang mau dihapus, ambil persis dari kata-kata user.
        - Kalau user nyebut tenggat relatif (mis. "besok"), hitung jadi YYYY-MM-DD berdasarkan tanggal hari ini.
        - Kalau user cuma ngobrol biasa (mis. "halo"), balas teks biasa yang ramah. JANGAN balas JSON.
        PROMPT;

        // Call the AI with auto-retry (handles flaky 500 / timeout)
        $payload = [
            'model'       => $model,
            'messages'    => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user',   'content' => $userMessage],
            ],
            'temperature' => 0.5,
            'max_tokens'  => 1024,
        ];

        $response = null;
        for ($attempt = 1; $attempt <= 3; $attempt++) {
            try {
                $response = Http::withToken($apiKey)
                    ->timeout(40)
                    ->post(rtrim($apiUrl, '/') . '/chat/completions', $payload);
            } catch (\Throwable $e) {
                Log::warning("NVIDIA attempt {$attempt} exception", ['err' => $e->getMessage()]);
                $response = null;
            }

            if ($response && $response->successful()) {
                break; // success, exit loop
            }

            if ($response) {
                Log::warning("NVIDIA attempt {$attempt} gagal", [
                    'status' => $response->status(),
                    'body'   => substr($response->body(), 0, 800),
                ]);
            }
            usleep(900000); // wait 0.9s before retrying
        }

        if (!$response || $response->failed()) {
            $status = $response ? $response->status() : 'no-response';
            Log::error('NVIDIA API gagal total', ['status' => $status]);
            return response()->json(['reply' => "😵 AI lagi sibuk (status {$status}), coba lagi sebentar ya 🙏", 'action' => false]);
        }

        $res     = $response->json();
        $content = data_get($res, 'choices.0.message.content', '');
        Log::info('NVIDIA raw', $res ?? []);

        $parsed = $this->extractJson($content);

        // === CREATE ASSIGNMENT ===
        if ($parsed && ($parsed['action'] ?? null) === 'create_assignment') {
            $data    = $parsed['data'] ?? [];
            $title   = trim($data['title'] ?? '');
            $subject = trim($data['subject'] ?? '') ?: 'Umum'; // subject is required, give a default to avoid DB error

            if ($title === '') {
                return response()->json(['reply' => 'Judul tugasnya apa ya? Coba sebutin lagi 🙏', 'action' => false]);
            }

            // Validate deadline — set to null if the format is invalid
            $deadline = $data['deadline'] ?? null;
            if ($deadline && !strtotime($deadline)) {
                $deadline = null;
            }

            // Validate priority (fallback to "medium")
            $priority = in_array($data['priority'] ?? null, ['low', 'medium', 'high'], true)
                ? $data['priority']
                : 'medium';

            try {
                $assignment = Assignment::create([
                    'user_id'  => $userId,
                    'title'    => $title,
                    'subject'  => $subject,
                    'deadline' => $deadline,
                    'notes'    => $data['notes'] ?? null,
                    'priority' => $priority,
                    // 'status' defaults to 'todo' (set in migration)
                ]);
            } catch (\Throwable $e) {
                Log::error('Gagal bikin assignment', ['err' => $e->getMessage()]);
                return response()->json(['reply' => '❌ Gagal nambah tugas: ' . $e->getMessage(), 'action' => false]);
            }

            $info = "📚 {$assignment->subject}";
            if ($deadline) $info .= " • ⏰ {$deadline}";

            return response()->json([
                'reply'  => "Siap! Tugas \"{$assignment->title}\" ({$info}) udah aku tambahin ya. 📝",
                'action' => true, // trigger list auto-refresh on the frontend
            ]);
        }

        // === DELETE ASSIGNMENT ===
        if ($parsed && ($parsed['action'] ?? null) === 'delete_assignment') {
            $title = trim($parsed['data']['title'] ?? '');

            if ($title === '') {
                return response()->json(['reply' => 'Tugas mana yang mau dihapus? Sebutin judulnya ya 🙏', 'action' => false]);
            }

            // Only search assignments owned by the current user (security guard) + fuzzy title match
            $matches = Assignment::where('user_id', $userId)
                ->where('title', 'like', '%' . $title . '%')
                ->get();

            // No match found
            if ($matches->isEmpty()) {
                return response()->json(['reply' => "Hmm, aku nggak nemu tugas \"{$title}\" 🤔 Coba cek lagi judulnya ya.", 'action' => false]);
            }

            // Multiple matches → ask the user to be more specific (avoid wrong deletion)
            if ($matches->count() > 1) {
                $list = $matches->pluck('title')->map(fn ($t) => "• {$t}")->implode("\n");
                return response()->json([
                    'reply'  => "Ada beberapa tugas yang mirip nih:\n{$list}\nSebutin judul yang lebih lengkap ya, biar aku gak salah hapus 🙏",
                    'action' => false,
                ]);
            }

            // Exactly one match → delete it
            $deleted = $matches->first();
            $judul   = $deleted->title;
            $deleted->delete();

            return response()->json([
                'reply'  => "Oke, tugas \"{$judul}\" udah aku hapus ya. 🗑️✅",
                'action' => true, // trigger list auto-refresh on the frontend
            ]);
        }

        // Not an action → normal chat
        return response()->json([
            'reply'  => $content !== '' ? $content : 'Maaf, lagi nggak bisa jawab nih 😅',
            'action' => false,
        ]);
    }

    private function extractJson(string $text): ?array
    {
        $text  = trim(preg_replace('/```(json)?|```/', '', $text));
        $start = strpos($text, '{');
        $end   = strrpos($text, '}');
        if ($start === false || $end === false) {
            return null;
        }
        $decoded = json_decode(substr($text, $start, $end - $start + 1), true);
        return is_array($decoded) ? $decoded : null;
    }
}