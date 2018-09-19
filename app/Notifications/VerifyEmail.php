<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends Notification
{
    use Queueable;

    private $confirmationCode;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($confirmationCode)
    {
        $this->confirmationCode = $confirmationCode;
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
	 * @param mixed $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		$link = route('register.verify', $this->confirmationCode) . '?email=' . urlencode($notifiable->getEmailForPasswordReset());
		return (new MailMessage())->subject('E-Mail-Adresse bestätigen')
			->line('Du erhältst diese E-Mail, weil diese E-Mail-Adresse auf unserer Website zur Registrierung angegeben wurde.')
			->line('Wenn Du Deinen Account freischalten möchtest, bestätige bitte Deine E-Mail:')
			->action('E-Mail-Adresse bestätigen', $link)
			->line('Wenn Du dich nicht auf unserer Website registriert hast, solltest Du die E-Mail nicht bestätigen.');
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
