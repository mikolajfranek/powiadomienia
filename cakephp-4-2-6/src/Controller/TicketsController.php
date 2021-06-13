<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\EventInterface;

class TicketsController extends AppController
{  
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
    }
    
    public function register()
    {
        $menuside = Configure::read('Config.MenuSide');
        $menuside['TicketsRegister'] = true;
        $this->set('menuside',$menuside);
    }
}