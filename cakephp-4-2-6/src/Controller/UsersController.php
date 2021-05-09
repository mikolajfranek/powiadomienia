<?php

namespace App\Controller;

use Cake\Event\EventInterface;

class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
    }
    
     public function login(){
         
         $this->Flash->success('Witamy w serwisie');
        
    }
}