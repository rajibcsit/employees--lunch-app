<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class LunchReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $employee;
    /**
     * Create a new notification instance.
     */
    public function __construct($employee)
    {
        $this->employee = $employee;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        Log::info("Call notificay");
        Log::info($this->employee->name);
        return (new MailMessage)
            ->subject('Reminder: Mark Your Lunch Entry')
            ->greeting('Hello ' . $this->employee->name . ',')
            ->line('This is a friendly reminder to mark your lunch entry for today.')
            ->action('Mark Lunch', route('lunch.index'))
            ->line('Thank you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Reminder: Mark your lunch entry for today.',
            'url' => route('lunch.index'),
        ];
    }
}
