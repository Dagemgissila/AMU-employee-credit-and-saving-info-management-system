<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreditApproved extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($creditDuration, $creditAmount)
    {
        $this->creditDuration = $creditDuration;
        $this->creditAmount = $creditAmount;
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Loan Approved')
            ->line('Hello,')
            ->line('Your loan application has been approved.')
            ->line('Loan Details:')
            ->line('Amount: ' . $this->creditAmount)
            ->line('Duration: ' . $this->creditDuration)
            ->line('Thank you for choosing our service!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            "subject"=>"Loan Approved",
            'Greeting'=>"Loan is Approved",
            'Message'=>"Your loan Appilication is Approved",
            "loan amount"=>$this->creditAmount,
            "duration"=>$this->creditDuration
        ];
    }
}
