<?php

namespace App\Controller;

use Cake\Event\EventInterface;

class NotificationController extends AppController
{   
    public function beforeFilter(EventInterface $event)
    {
    }
   
    public function send(){
        $this->autoRender = false;
        
        echo "send";
    }
}