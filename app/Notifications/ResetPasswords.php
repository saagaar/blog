<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswords extends ResetPassword 
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
      public function __construct($code='',$token=false,$rawData=array(),$additionalData=array(),$receiverInfo=array())
        {
          $repoNotify = app()->make('App\Repository\NotificationSettingInterface');
         
          $this->notification=$repoNotify->getNotificationByCode($code);
          $this->token=$token;
          $this->_channel=$this->notification->notification_type;
          $this->rawData=$rawData;
          $this->additionalData=$additionalData;
          $this->receiverInfo=$receiverInfo;

          $this->contactEmail=config('settings.contact_email');
          $this->siteName=config('settings.site_name');
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
           $link = url( "/password/reset/" . $this->token.'?email='.$notifiable->email );
           $this->rawData=array('NAME'=>$notifiable->name,'URL'=>$link,'SITENAME'=>$this->siteName);

           $body=$this->parseNotificationBody($this->notification->email_body);
                return (new MailMessage)
                ->view('emailTemplate.'.$this->notification->view, ['body' => $body,'data'=>$this->additionalData,'receiverInfo'=>array('email'=>$notifiable->email)])
                ->subject($this->notification->subject)
                ->from($this->contactEmail,$this->siteName);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
 
     private function parseNotificationBody($text_string)
    {
        $patterns_string = array();
        $replacement_string = array();
        $parseElement=$this->rawData;
        foreach($parseElement as $key=>$value)
        {
            $parserName=$key;
            $parseValue=$value;
            $text_string=str_replace("[$parserName]",$parseValue,$text_string);
        }
        return preg_replace($patterns_string, $replacement_string, $text_string);
    }
}
