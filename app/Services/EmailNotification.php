<?php 

namespace App\Services;

use App\Services\Interfaces\NotificationInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Mail\EmailClass;
use App\Models\User;
// use App\Models\
use Illuminate\Contracts\Queue\ShouldQueue;

Class EmailNotification extends Notification implements NotificationInterface,ShouldQueue
{

	use Queueable;
	public $auser;

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
    public function send()
    {
    	$user='';
    		 //  $mail=$this->toMail();
    		 //  print_r($mail->view());
    		 // $mailclass=new EmailClass();
    		 // $view=$mailclass->build($mail);

    			 \Mail::send('welcome',
        array(
            'name' => 'saagarchapagain',
            'email' => 'saagarchapagain@gmail.com',
           
           

        ), function($message) use ($user){
    
        $message->to('saagarchapagain@gmail.com', 'Admin')->subject('Insurance Claim');
    });
    		 // $mailclass->send($view);
    		 
    }

    public function toMail()
    {

    	 return (new MailMessage)
    	 	->replyTo('saagarchapagain@gmail.com','sagar Chapagain')
            ->subject('Reset Password Notification')
            ->line('You are receiving this email because we received a password reset request for your account.')
            // ->action(Lang::getFromJson('Reset Password'), url(config('app.url').route('admin.dashboard')))
            ->line('If you did not request a password reset, no further action is required.');
    }


}