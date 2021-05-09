<?php

namespace App\Controller;

use Cake\Event\EventInterface;

class TicketsController extends AppController
{  
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
    }
    
    public function list(){
    
    }
}