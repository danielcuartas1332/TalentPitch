<?php

namespace App\Console\Commands;

use App\Models\Video;
use App\Services\DataFetcherService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LoadVideos extends Command
{
    protected $signature = 'videos:load';
    protected $description = 'Load videos from an external API';

    protected $dataFetcherService;

    public function __construct(DataFetcherService $dataFetcherService)
    {
        parent::__construct();
        $this->dataFetcherService = $dataFetcherService;
    }

    public function handle()
    {
        $videos = $this->dataFetcherService->fetchVideos();
        Log::info('Videos obtenidos:', ['videos' => $videos]);

        foreach ($videos as $video) {
            if (is_array($video)) { // Verificar que $video es una matriz
                Video::updateOrCreate(
                    ['url' => $video['url'] ?? ''], // Asegurarse de que 'url' está presente
                    [
                        'name' => $video['title'] ?? '',
                        'description' => $video['description'] ?? null,
                        'user_id' => $video['user_id'] ?? 6, // Default to 6 if not present
                        'videoable_type' => $video['videoable_type'] ?? 'App\Models\User', // Ajusta si es necesario
                        'videoable_id' => $video['videoable_id'] ?? $video['user_id'] ?? 6, // Default to user_id if not present
                    ]
                );
            } else {
                Log::error('Formato de video inválido', ['video' => $video]);
            }
        }

        $this->info('Videos cargados exitosamente.');
    }
}
