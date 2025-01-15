<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\LunchReminderNotification;
use Illuminate\Support\Facades\Log;

class LunchRemainder implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $employees = User::where('role', 'employee')->get();

        foreach ($employees as $employee) {
            Log::info('Sending lunch reminder notification to: ' . $employee->name);
            $employee->notify(new LunchReminderNotification($employee));
        }
        Log::info('Lunch reminder notifications sent successfully.');
    }
}
