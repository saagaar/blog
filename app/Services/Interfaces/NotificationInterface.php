<?php 

namespace App\Services\Interfaces;


interface NotificationInterface
{
    
    public function setup();

    public function send($data);

}