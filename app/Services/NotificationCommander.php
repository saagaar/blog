<?php 

namespace App\Services;

// use App\Services\NotificationCommander;


Class NotificationCommander  
{
  
   public static function build ($type='') {
        if($type == '') {
            // throw new Exception('Invalid Notification Type.');
        } else {
            $className = "App\Services\\".ucfirst($type).'Notification';
            // Assuming Class files are already loaded using autoload concept
            if(class_exists($className)) {

                return new $className();
            } else {
                exit;
                // throw new Exception('Notification type not found.');
            }
        }
    }


}