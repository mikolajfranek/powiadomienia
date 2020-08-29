<?php

namespace App\Controller;

use Cake\Core\Exception\Exception;
use Cake\Event\EventInterface;

class UserController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
    }
    
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
    }
    
    public function login(){
        
    }
    
    public function register(){
        
    }
}