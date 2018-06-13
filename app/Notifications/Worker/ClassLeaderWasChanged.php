<?php

namespace App\Notifications\Worker;

use App\Grade;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ClassLeaderWasChanged extends Notification
{
    use Queueable;

    public $grade;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Grade $grade)
    {
        $this->grade = $grade;
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
            ->subject('Pridelená trieda ' . $this->grade->name)
            ->greeting('Dobrý deň')
            ->line('Administrátor školského portálu Vám pridelil triedu s právom Triedny učiteľ.')
            ->line('Administrátor školského portálu Vám pridelil triedu ' .  $this->grade->name . ' s právom Triedny učiteľ.')
            ->action('Prejsť na stránku portálu', url('/'))
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
