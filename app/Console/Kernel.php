<?php
namespace App\Console;

use App\Console\Commands\LoadChallenges;
use App\Console\Commands\LoadUsers;
use App\Console\Commands\LoadVideos;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        LoadUsers::class,
        LoadChallenges::class,
        LoadVideos::class,
    ];
}
