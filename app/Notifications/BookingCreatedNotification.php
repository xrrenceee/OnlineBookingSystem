<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingCreatedNotification extends Notification
{
    use Queueable;

    protected $booking;

    /**
     * Create a new notification instance.
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail']; // You can also add 'database', 'broadcast', etc.
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Booking Confirmation')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your booking titled **"' . $this->booking->title . '"** has been successfully created.')
            ->line('📅 Booking Date: ' . $this->booking->booking_date->format('F j, Y g:i A'))
            ->line('📝 Notes: ' . ($this->booking->notes ?? 'N/A'))
            ->line('Thank you for using our booking service!');
    }

    /**
     * (Optional) Store notification in database.
     */
    public function toArray($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            'title' => $this->booking->title,
            'booking_date' => $this->booking->booking_date,
        ];
    }
}
