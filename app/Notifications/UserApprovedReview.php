<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserApprovedReview extends Notification
{
    use Queueable;

    public $photoshoot;

    /**
     * Create a new notification instance.
     */
    public function __construct($photoshoot)
    {
        $this->photoshoot = $photoshoot;
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Has aprobado exitosamente el photoshoot ' . $this->photoshoot->name . '.')
                    // ->action('Ir al photoshoot', url('/photoshoot/' . $this->photoshoot->slug))
                    ->line('Hemos notificado al administrador para que lo apruebe!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'photoshoot_id' => $this->photoshoot->id,
            'message' => 'Has aprobado exitosamente el photoshoot: ' . $this->photoshoot->name . '.',
        ];
    }
}
