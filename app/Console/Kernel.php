<?php

namespace Azuriom\Console;

use Azuriom\Support\Optimizer;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('game:ping')->everyMinute();
        $schedule->command('attachments:purge')->daily();
        $schedule->command('logs:purge')->monthly();
        // Pixelax : AzBoost (routes et config en cache) est stocké dans le conteneur, donc perdu à chaque
        // déploiement. On le réactive automatiquement, comme le bouton de l'admin, dès qu'il est désactivé.
        $schedule->call(function () {
            $optimizer = app(Optimizer::class);
            if (! $optimizer->isEnabled()) {
                $optimizer->cache();
            }
        })->everyMinute()->name('azboost')->withoutOverlapping(5);
        // Pixelax : aucun worker ne tourne en continu, on traite la file (mails de la newsletter…) chaque minute
        $schedule->command('queue:work --stop-when-empty --max-time=50 --tries=1')
            ->everyMinute()
            ->withoutOverlapping(5)
            ->runInBackground();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        // require base_path('routes/console.php');
    }
}
