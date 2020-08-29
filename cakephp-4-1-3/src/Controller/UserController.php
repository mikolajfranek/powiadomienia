<?php

namespace App\Controller;

use Cake\Core\Exception\Exception;
use Cake\Event\EventInterface;

use App\Controller\AppController;
use App\Form\RegisterForm;
use App\Form\LoginForm;

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
        $form = new LoginForm();
        if ($this->request->is('post')) {
            if ($form->execute($this->request->getData())) {
                $this->Flash->success('Witamy w serwisie Powiadomienia.');
            } else {
                $this->Flash->error('Wystąpił błąd w wysyłaniu formularza, spóbuj ponownie.');
            }
        }
        $this->set('form', $form);
    }
    
    public function register(){
        $form = new RegisterForm();
        if ($this->request->is('post')) {
            if ($form->execute($this->request->getData())) {
                $this->Flash->success('Aktywuj konto za pomocą linku aktywacyjnego znajdującego się na Twojej poczcie elektrocznej.');
                $this->redirect(array('action' => 'login'));
            } else {
                $this->Flash->error('Wystąpił błąd w wysyłaniu formularza, spóbuj ponownie.');
            }
        }
        $this->set('form', $form);
    }
    
    public function logout(){
        
    }
}