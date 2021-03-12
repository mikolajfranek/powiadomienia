<?php

namespace App\Controller;

use App\Form\LoginForm;
use App\Form\RegisterForm;

class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login', 'register']);
    }
    
    public function login(){
        $form = new LoginForm();
        $this->set('form', $form);
    }
    
    public function register(){
        $form = new RegisterForm();
        
        
        
        $this->set('form', $form);
    }
}