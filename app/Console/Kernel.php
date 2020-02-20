<?php

namespace App\Console;

use App\Console\Commands\SetupUser;
use App\Console\Commands\ZlGroups;
use App\Console\Commands\ZlLights;
use App\Console\Commands\ZlNetwork;
use App\Jobs\GroupsStateJobs;
use App\Routine;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ZlGroups::class,
        ZlLights::class,
        ZlNetwork::class,
        SetupUser::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $routines = Routine::with('groups')->get();

        foreach ($routines as $routine) {
            foreach ($routine->groups as $group) {
                $schedule->job(new GroupsStateJobs($group, $routine->state))->dailyAt($routine->exec);
            }
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
