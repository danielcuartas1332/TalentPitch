<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DataFetcherService;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class LoadUsers extends Command
{
    protected $signature = 'users:load';
    protected $description = 'Load users from OpenAI API and store them in the database.';

    protected $dataFetcherService;

    public function __construct(DataFetcherService $dataFetcherService)
    {
        parent::__construct();
        $this->dataFetcherService = $dataFetcherService;
    }

    public function handle()
    {
        try {
            $usersData = $this->dataFetcherService->fetchUsers();

            foreach ($usersData as $userData) {
                User::updateOrCreate(
                    ['email' => $userData['email']], // Uniqueness check
                    [
                        'name' => $userData['name'],
                        'image_path' => $userData['image_path'] ?? null,
                    ]
                );
            }

            $this->info('Users loaded successfully.');
        } catch (\Exception $e) {
            $this->error('Failed to load users: ' . $e->getMessage());
            // Log additional error details if needed
            Log::error('Failed to load users', ['exception' => $e]);
        }
    }
}
