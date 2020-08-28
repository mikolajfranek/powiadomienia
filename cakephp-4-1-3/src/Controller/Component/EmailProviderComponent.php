<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Mailer\Mailer;

class EmailProviderComponent extends Component {

    
    public function sendNotifications($message){
        
        $mailer = new Mailer('default');
        
        $mailer
            ->setTo('mikolaj.franek95@gmail.com')
            ->setSubject('[Powiadomienia]'. '['. (date('Y-m-d', time())) . ']')
            ->setEmailFormat('html');
           
        $mailer->deliver();
        
    }
}