<?php
namespace App\Services;

use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DataFetcherService
    {
    protected $apiUrl;
    protected $apiKey;

    /**
     * Trae la llave para conectar la api GTP
     */
    public function __construct()
    {
        $this->apiUrl = env('EXTERNAL_API_URL');
        $this->apiKey = env('EXTERNAL_API_KEY');
    }

    /**
     * Construye la petición a la api externa de AI para traer el listado de usuarios.
     *
     * @return array
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function fetchUsers()
    {
        $prompt = 'Generate a list of users with names and emails.';

        // Solicitar a OpenAI
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl , [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
            'max_tokens' => 150,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['choices'][0]['message']['content'])) {
                $text = $data['choices'][0]['message']['content'];


                // Dividir el texto en líneas y procesarlas
                $lines = explode("\n", trim($text));
                $users = [];

                foreach ($lines as $line) {
                    // Procesar cada línea para extraer nombre y correo
                    if (preg_match('/^\d+\.\s*(.+?)\s*-\s*(.+)$/', $line, $matches)) {
                        $name = trim($matches[1]);
                        $email = trim($matches[2]);

                        // Generate an image path based on the user's name (this can be adjusted as needed)
                        $imagePath = '/images/' . strtolower(str_replace(' ', '_', $name)) . '.jpg';

                        $users[] = [
                            'name' => $name,
                            'email' => $email,
                            'image_path' => $imagePath,
                        ];
                    }
                }

                return $users;
            }
        } else {
            Log::error('OpenAI API error', [
                'status' => $response->status(),
                'body' => $response->body(),
                'headers' => $response->headers(),
            ]);
        }

        throw new \Exception('Error al obtener usuarios de la API externa. Estado: ' . $response->status());
    }

    /**
     *
     *
     * @return array
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function fetchChallenges()
    {
        $prompt = 'Generate a list of challenges with titles, descriptions, and difficulty in number.';

        // Solicitar a OpenAI
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl, [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
            'max_tokens' => 300,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            Log::info('Response from OpenAI API', ['data' => $data]);
            $challenges = $this->parseChallenges($data);
            return $challenges;
        }

        Log::error('OpenAI API error', [
            'status' => $response->status(),
            'body' => $response->body(),
            'headers' => $response->headers(),
        ]);
        throw new \Exception('Error al obtener challenges de la API externa. Estado: ' . $response->status());
    }

    /**
     * @param $data
     * @return array
     */
    protected function parseChallenges($data)
    {
        $challenges = [];
        $content = $data['choices'][0]['message']['content'];
        Log::info('Text received from OpenAI API', ['text' => $content]);

        // Usa expresiones regulares para extraer los datos
        $pattern = '/^\d+\. (.*?)\nDescription: (.*?)\nDifficulty: (\d)$/m';
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $challenges[] = [
                'title' => $match[1],
                'description' => $match[2],
                'difficulty' => (int)$match[3], // Convertir la dificultad a entero
                'user_id' => 6, // Siempre relaciona con el usuario ID 6
            ];
        }

        return $challenges;
    }

    /**
     * @return string[]
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function fetchVideos()
    {
        $prompt = 'Generate a list of videos with titles, URLs, descriptions, and assign them to a user with ID 6. Format the response as a JSON array with each object containing title, url, description, and user_id.';

        // Solicitar a OpenAI
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl, [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
            'max_tokens' => 500,
        ]);

        // Manejar la respuesta
        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['choices'][0]['message']['content'])) {
                $content = $data['choices'][0]['message']['content'];

                // Intentar decodificar el contenido JSON
                $videos = json_decode($content, true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    // Validar y guardar cada video
                    foreach ($videos as $videoData) {
                        try {
                            // Crear el video
                            Video::updateOrCreate(
                                ['url' => $videoData['url']], // Uniqueness check
                                [
                                    'name' => $videoData['title'],
                                    'description' => $videoData['description'] ?? null,
                                    'user_id' => $videoData['user_id'],
                                    'videoable_type' => 'App\Models\User', // Ajusta si es necesario
                                    'videoable_id' => $videoData['user_id'], // Asumiendo que es un User
                                ]
                            );

                            Log::info('Video created successfully', ['video' => $videoData]);

                        } catch (\Exception $e) {
                            Log::error('Failed to create video', ['error' => $e->getMessage(), 'data' => $videoData]);
                        }
                    }

                    return ['message' => 'Videos creados exitosamente.'];
                } else {
                    Log::error('JSON decode error', ['error' => json_last_error_msg()]);
                    throw new \Exception('Error decoding JSON response.');
                }
            } else {
                Log::error('Unexpected API response format', ['data' => $data]);
                throw new \Exception('Unexpected format in OpenAI API response.');
            }
        } else {
            Log::error('OpenAI API error', [
                'status' => $response->status(),
                'body' => $response->body(),
                'headers' => $response->headers(),
            ]);
            throw new \Exception('Error al obtener videos de la API externa. Estado: ' . $response->status());
        }
    }
}
