<?php
namespace App\Console;

use App\Console\Commands\LoadUsers;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        LoadUsers::class
    ];
}
