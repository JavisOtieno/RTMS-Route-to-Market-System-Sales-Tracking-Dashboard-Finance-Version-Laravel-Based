<?php

namespace App\Console;

use App\Models\Clockin;
use App\Mail\ReportSenderTest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    // protected function schedule(Schedule $schedule): void
    // {
    //     // $schedule->command('inspire')->hourly();
    // }

        protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            // $orders = Order::where('status', 'shipped')->get();
            // foreach ($orders as $order) {
            //     Mail::to($order->customer_email)->send(new OrderShipped($order));
            // }

            $clockin = Clockin::first();
            Mail::to('javisotieno@gmail.com',
            // 'Technology@scgafrica.com','stanley@scgafrica.com'
            )->send(new ReportSenderTest($clockin));
    
        })
        ->everyFiveMinutes();
        // ->dailyAt('08:00'); // Runs every day at 8 AM
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
