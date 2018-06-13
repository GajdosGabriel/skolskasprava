<?php

namespace App\Notifications\Worker;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WorkerInvitationNotification extends Notification
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->replyTo($this->user->owner($this->user->owner_id)->email, 'škola')
            ->subject('Vytvorený prístup pre ' . $this->user->full_name() )
            ->greeting('Dobrý deň')
            ->line('Riaditeľ školy Vám vytvoril prístup do školského informačného systému na správu osobných údajov.')
            ->action('Získať prístup k svojmu účtu.', url('password/reset'))
            ->line('S pozdravom, riaditeľ školy');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
