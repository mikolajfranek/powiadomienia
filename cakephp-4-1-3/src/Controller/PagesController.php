<?php

namespace App\Controller;

use Cake\Event\EventInterface;

class PagesController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['home', 'donate']);
    }
    
    public function home(){}
    
    public function donate(){}
}
