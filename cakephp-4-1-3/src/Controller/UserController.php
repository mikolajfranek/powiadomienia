<?php

namespace App\Controller;

use Cake\Auth\DigestAuthenticate;
use Cake\Core\Exception\Exception;
use Cake\Datasource\FactoryLocator;
use Cake\Event\EventInterface;

use App\Controller\AppController;
use App\Form\RegisterForm;
use App\Form\LoginForm;

class UserController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('EmailProvider');
    }
    
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
    }
    
    public function login(){
        $form = new LoginForm();
        if ($this->request->is('post')) {
            try{
                if ($form->execute($this->request->getData()) == false) throw new Exception('Wystąpił błąd w przetarzaniu formularza logowania');
                
                
                //if($this->Auth->login() == false) throw new Exception('Wystąpił błąd w tworzeniu sesji użytkownika');
                
                $this->Flash->success('Witamy w serwisie Powiadomienia.');
                $this->redirect(array('controller' => 'pages', 'action' => 'donate'));
            }catch(Exception $e){
                $this->Flash->error('Wystąpił błąd w wysyłaniu formularza, spóbuj ponownie.');
            }
        }
        $this->set('form', $form);
    }
    
    public function register(){
        $form = new RegisterForm($this->EmailProvider);
        if ($this->request->is('post')) {
            try{
                if ($form->execute($this->request->getData()) == false) throw new Exception('Wystąpił błąd w przetarzaniu formularza rejestracji');
                $this->Flash->success('Aktywuj konto za pomocą linku aktywacyjnego znajdującego się na Twojej poczcie elektrocznej.');
                $this->redirect(array('action' => 'login'));
            }catch(Exception $e){
                $this->Flash->error('Wystąpił błąd w wysyłaniu formularza, spóbuj ponownie.');
            }
        }
        $this->set('form', $form);
    }
    
    public function activate($user_id, $activating_hash){
        $this->autoRender = false;
        try{
            $users = FactoryLocator::get('Table')->get('Users');
            $user = $users->find()
                ->where(array('id' => $user_id))
                ->first();
            if(empty($user) == true) throw new Exception('Nie znaleziono zarejestrowanego użytkownika');
            $hash = DigestAuthenticate::password($user->login, ($user->login . $user->email), env('SERVER_NAME'));
            if($activating_hash != $hash) throw new Exception('Podany hash się nie zgadza');
            if($user->is_email_confirmation == 1) throw new Exception('Konto użytkownika zostało wcześniej aktywowane');
            $user->is_account_active = 1;
            $user->is_email_confirmation = 1;
            if($users->save($user) == false) throw new Exception('Nie aktywowano poprawnie użytkownika');
            $this->Flash->success('Pomyślnie aktywowano konto');
            $this->redirect(array('action' => 'login'));
        }catch(Exception $e){
            $this->Flash->error('Wystąpił błąd w procesie aktywacji konta');
            $this->redirect(array('action' => 'login'));
        }
    }
    
    public function logout(){
        
    }
}