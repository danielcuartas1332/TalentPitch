<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DataFetcherService
    {
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiUrl = env('EXTERNAL_API_URL'); // URL de la API externa
        $this->apiKey = env('EXTERNAL_API_KEY'); // Clave API
    }

    public function fetchUsers()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl . '/completions', [
            'model' => 'text-davinci-003',
            'prompt' => 'Generate a list of users with names and emails.',
            'max_tokens' => 150,
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        Log::error('OpenAI API error', [
            'status' => $response->status(),
            'body' => $response->body(),
            'headers' => $response->headers(),
        ]);
        throw new \Exception('Error al obtener usuarios de la API externa. Estado: ' . $response->status());
    }
}
