<?php

namespace App\Notifications\Parent;


use App\Student;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ConfirmStudentAgreement extends Notification
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
            ->subject('Žiadosť ' . $this->user->owner($this->user->owner_id)->company . ', pre rodiča: ' . $this->user->full_name())
            ->greeting('Dobrý deň')
            ->line('Podľa nových pravidiel GDPR, riaditeľ ' . $this->user->owner($this->user->owner_id)->company . ' žiada o súhlas na spracovanie osobných údajov pre žiaka, ')
            ->line('Súhlas udeľujete elektronicky, prihlásenim sa na uvedený email. Prístup k účtu získate vložením svojho emailu, a vyžiadaním si zmeny hesla.')
            ->line('Vaša emailová adresa na prihlásenie: ' . $this->user->email )
            ->action('Prihlásenie k rodičovskému účtu.', route('parent.login', [$this->user->id, $this->user->slug, $this->user->email]) )
//            ->action('Získať prístup k rodičovskému účtu.', url('password/reset'))
            ->line('S pozdravom, vedenie školy');
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
