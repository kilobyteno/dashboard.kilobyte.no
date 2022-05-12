<?php

namespace App\Console;

use aglipanci\ForgeTile\Commands\FetchForgeRecentEventsCommand;
use aglipanci\ForgeTile\Commands\FetchForgeServersCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Kilobyteno\PlausibleTile\FetchDataFromPlausibleCommand;
use TJVB\PackagistTile\FetchPackageDataCommand;
use TJVB\PackagistTile\FetchVendorPackagesCommand;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(FetchForgeServersCommand::class)->hourly();
        $schedule->command(FetchForgeRecentEventsCommand::class)->everyMinute();
        $schedule->command(FetchVendorPackagesCommand::class)->daily();
        $schedule->command(FetchPackageDataCommand::class)->twiceDaily();
        $schedule->command(FetchDataFromPlausibleCommand::class)->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
