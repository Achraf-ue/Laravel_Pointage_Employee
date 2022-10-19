<?php

namespace App\Console;
use App\Console\Commands\Calcule_Pointage;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    protected $commmands=[
        Calcule_Pointage::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /*$schedule->call(function () {
            DB::table('recent_users')->delete();
        })->daily();*/

        //  $schedule->command('Calcule:Pointage')->dailyAt('14:45')->timezone('Africa/Casablanca');




        $schedule->command('Calcule:Pointage')->everyMinute();
        //$schedule->command('Calcule:Pointage')->cron('10 03 * * *')->timezone('Africa/Casablanca');
        

        //$schedule->command('Calcule:Pointage')->weekly()->thursdays()->at('04:18');

        /*$schedule->call(function () {
            DB::table('pointage__employees')->delete();
        })->weekly()->thursdays()->at('04:22');*/

        //php artisan schedule:work
        //$schedule->command('Calcule:Pointage')->cron('57 04 * * *')->timezone('Africa/Casablanca');        
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
   
     protected function scheduleTimezone()
    {
        return 'Africa/Casablanca';
    }
}
