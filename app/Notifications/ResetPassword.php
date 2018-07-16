<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class ResetPassword extends ResetPasswordNotification
{
    use Queueable;

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
	 * @param mixed $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		$link = route('password.reset', $this->token) . '?email=' . urlencode($notifiable->getEmailForPasswordReset());
		return (new MailMessage())->subject('Passwort zurücksetzen')
			->line('Du erhältst diese E-Mail, weil für Deinen Account eine Anfrage gestellt wurde, das Passwort zurück zu setzen.')
			->action('Passwort zurücksetzen', $link)
            ->line('Falls Du Dein Passwort nicht zurücksetzen wolltest, kannst du diese E-Mail einfach löschen.');
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
