<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminNotifiedOfReviewApproval extends Notification
{
    use Queueable;

    protected $photoshoot;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($photoshoot, $user)
    {
        $this->photoshoot = $photoshoot;
        $this->user = $user;
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
            ->line('El usuario ' . $this->user->name . ' ha aprobado la revisión para el photoshoot: ' . $this->photoshoot->name)
            ->action('Ver photoshoot', url('/photoshoot/' . $this->photoshoot->slug))
            ->line('Aprueba este photoshoot y envía las fotografías al cliente!');
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
            'user_id' => $this->user->id,
            'message' => 'El usuario ' . $this->user->name . ' ha aprobado la revisión para el photoshoot: ' . $this->photoshoot->name,
        ];
    }
}
