<?php

namespace App\Controller;

use App\Form\LoginForm;
use App\Form\RegisterForm;

class UsersController extends AppController
{
    public function login(){
        $form = new LoginForm();
        $this->set('form', $form);
    }
    
    public function register(){
        $form = new RegisterForm();
        
        $this->set('form', $form);
    }
}