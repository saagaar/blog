<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Repository\NotificationSettingInterface; 

class Notifications extends Notification implements ShouldQueue
{
    use Queueable;

    protected $notification;

    protected $contactEmail;

    protected $systemEmail;
    protected $receiverInfo;
    protected$additionalData;
    /**
     * All notification Channels to list
     * 
     * @type array
     */
     protected $_channel = null;

     /**
     * All notification Channels to list
     * 
     * @return type array
     */
     protected $rawData = array();
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($code='',$rawData=array(),$additionalData=array(),$receiverInfo=array())
    {
      $repoNotify = app()->make('App\Repository\NotificationSettingInterface');
     
      $this->notification=$repoNotify->getNotificationByCode($code);
      
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
        if (!$this->_channel)
        {
            throw new \Exception('Notification Couldn\'t be set. No channel provided.');
        }
        return  $this->_channel ;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $body=$this->parseNotificationBody($this->notification->email_body);
        return (new MailMessage)
        ->view('emailTemplate.'.$this->notification->view, ['body' => $body,'data'=>$this->additionalData,'receiverInfo'=>$this->receiverInfo])
        ->subject($this->notification->subject)
        ->from($this->contactEmail,$this->siteName);
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        $body=$this->parseNotificationBody($this->notification->database_body);
        return 
        [
             'message'=>$body,
             'user'    =>$this->receiverInfo
        ];
    }

    public function toSms($notifiable)
    {
        $body=$this->parseNotificationBody($this->notification->database_body);
        return 
        [
             'message'=>$body
        ];
    }

     //to parse the the email which is available in the
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
