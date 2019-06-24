<?php 

namespace App\Services;

use App\Services\Interfaces\NotificationInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
// use App\Models\
use Illuminate\Contracts\Queue\ShouldQueue;

Class EmailNotification extends Notification implements NotificationInterface,ShouldQueue
{
	 /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }	
    
    public function setup()
    {
    	echo 'we are here';	exit;	
    }

    public function send($notifiable)
    {
    	 return (new MailMessage)
            ->subject(Lang::getFromJson('Reset Password Notification'))
            ->line(Lang::getFromJson('You are receiving this email because we received a password reset request for your account.'))
            ->action(Lang::getFromJson('Reset Password'), url(config('app.url').route('password.reset', $this->token, false)))
            ->line(Lang::getFromJson('If you did not request a password reset, no further action is required.'));
    }


}