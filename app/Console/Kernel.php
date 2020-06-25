<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Model\Site;
use App\Jobs;
use App\Services;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
    ];

    private const JOB_COMPARATOR = [
        'checkHttpCode' => 'CheckSiteHttpCode',
        'checkScoring' => 'CheckSiteGoogleScore',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $sites = Site::all();

        foreach ($sites as $site)
        {
            foreach ($site->hasMany('App\Model\SiteJobPeriod') as $jobPeriod)
            {
                $jobClass = 'Jobs\\' . self::JOB_COMPARATOR[$jobPeriod->job];

                switch ($jobPeriod->period)
                {
                    case ('hour'):
                    {
                        $schedule->job(new $$jobClass($site), 'default', 'database')->hourly();
                        break;
                    }
                    case ('day'):
                    {
                        $schedule->job(new $$jobClass($site), 'default', 'database')->daily();
                        break;
                    }
                    case ('week'):
                    {
                        $schedule->job(new $$jobClass($site), 'default', 'database')->weekly();
                        break;
                    }
                    case ('month'):
                    {
                        $schedule->job(new $$jobClass($site), 'default', 'database')->monthly();
                        break;
                    }
                }
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
