<?php

namespace App\Controller;

use Cake\Core\Exception\Exception;
use Cake\Event\EventInterface;
use Cake\Core\Configure;
use Cake\Log\Log;

class NotificationsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('EmailProvider');
    }
    
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['send']);
    }
   
    public function send(){
        $this->autoRender = false;
        try{
            //ip
            $ip = $this->request->clientIp();
            if(in_array($ip, Configure::read('Config.Localhost')) == false){
                throw new Exception('Nieznany adres IP ' . $ip . ', wywołujący rozsyłkę powiadomień.');
            }
            
            //TODO
            $this->EmailProvider->sendNotifications("Cron działa");
            
        }catch(Exception $e){
            Log::write('error', $e->getMessage());
            Log::write('error', $e->getTraceAsString());
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