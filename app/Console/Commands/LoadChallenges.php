<?php

namespace App\Console\Commands;

use App\Models\Challenge;
use App\Services\DataFetcherService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LoadChallenges extends Command
{
    protected $signature = 'challenges:load';
    protected $description = 'Load challenges from an external API';

    protected $dataFetcherService;

    public function __construct(DataFetcherService $dataFetcherService)
    {
        parent::__construct();
        $this->dataFetcherService = $dataFetcherService;
    }

    public function handle()
    {
        $challenges = $this->dataFetcherService->fetchChallenges();
        Log::info('Challenges obtenidos:', ['challenges' => $challenges]);

        foreach ($challenges as $challenge) {
            Challenge::updateOrCreate(
                ['title' => $challenge['title']], // Uniqueness check
                [
                    'description' => $challenge['description'],
                    'difficulty' => $challenge['difficulty'],
                    'user_id' => $challenge['user_id'],
                ]
            );
        }

        $this->info('Challenges cargados exitosamente.');
    }
}
