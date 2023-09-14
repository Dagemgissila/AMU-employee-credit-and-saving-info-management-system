<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Saving extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($monthly_saving_amount)
    {
        $this->monthly_saving_amount=$monthly_saving_amount;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            "Subject"=>"Monthly Saving",
            'Greeting'=>"Monthly Saving Is deposited successfully",
            'Message'=>"We pleased inform you that " .$this->monthly_saving_amount . " Birr Deposited succefully to your Saving Account"

        ];
    }
}
