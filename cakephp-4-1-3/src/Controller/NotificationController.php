<?php

namespace App\Controller;

use Cake\Core\Exception\Exception;
use Cake\Event\EventInterface;

class NotificationController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('EmailProvider');
    }
    
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
    }
   
    public function send(){
        $this->autoRender = false;
        try{
            //ip
            $ip = $this->getClientIp();
            if($this->isLocalhost($ip) == false){
                throw new Exception('Nieznany adres IP ' . $ip . ', wywołujący rozsyłkę powiadomień.');
            }
            
            //TODO
            
            
            
            
            $this->EmailProvider->sendNotifications("");
            
        }catch(Exception $e){
            $this->EmailProvider->sendNotifications($e->getMessage());
            ob_start();
            echo "Krytyczny błąd";
            ob_end_flush();
            exit;
        }
        ob_start();
        echo "Ok";
        ob_end_flush();
        exit;
    }
}