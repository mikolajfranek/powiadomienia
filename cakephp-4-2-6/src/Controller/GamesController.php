<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\EventInterface;

class GamesController extends AppController
{  
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
    }
    
    public function list()
    {
        $menuside = Configure::read('Config.MenuSide');
        $menuside['GamesList'] = true;
        $this->set('menuside',$menuside);
    }
}