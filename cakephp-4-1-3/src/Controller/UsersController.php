<?php

namespace App\Controller;

use App\Form\LoginForm;
use App\Form\RegisterForm;
use Cake\Auth\DigestAuthenticate;
use Cake\Core\Exception\Exception;
use Cake\Datasource\FactoryLocator;
use Cake\Event\EventInterface;
use const False\MyClass\true;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('EmailProvider');
    }
    
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['register', 'activate']);
    }
  
    public function login(){
        $form = new LoginForm();
        if($this->Auth->user() != null){
            return $this->redirect($this->Auth->redirectUrl());
        }
        if ($this->request->is('post')) {
            try{
                if($form->validate($this->request->getData()) == false) throw new Exception('Wystąpił błąd w przetarzaniu formularza logowania.');
                $user = $this->Auth->identify();
                if($user == false) throw new Exception("Login lub hasło są niepoprawne.");
                if($user['is_account_active'] != 1 || $user['is_email_confirmation'] != 1) throw new Exception("Konto zostało zablokowane.");
                $this->Auth->setUser($user);
                $this->Flash->success('Witamy w serwisie Powiadomienia.');
                return $this->redirect($this->Auth->redirectUrl());
            }catch(Exception $e){
                $this->Flash->error(empty($e->getMessage()) ? 'Wystąpił błąd w wysyłaniu formularza, spóbuj ponownie.' : $e->getMessage());
            }
        }
        $this->set('form', $form);
    }
    
    public function register(){
        $form = new RegisterForm($this->EmailProvider);
        if($this->Auth->user() != null){
            return $this->redirect($this->Auth->redirectUrl());
        }
        if ($this->request->is('post')) {
            try{
                if ($form->execute($this->request->getData()) == false) throw new Exception('Wystąpił błąd w przetarzaniu formularza rejestracji.');
                $this->Flash->success('Aktywuj konto za pomocą linku aktywacyjnego znajdującego się na Twojej poczcie elektrocznej.');
                $this->redirect(array('action' => 'login'));
            }catch(Exception $e){
                $this->Flash->error(empty($e->getMessage()) ? 'Wystąpił błąd w wysyłaniu formularza, spóbuj ponownie.' : $e->getMessage());
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
            if(empty($user) == true) throw new Exception('Nie znaleziono zarejestrowanego użytkownika.');
            $hash = DigestAuthenticate::password($user->login, ($user->login . $user->email), env('SERVER_NAME'));
            if($activating_hash != $hash) throw new Exception('Podany hash się nie zgadza.');
            if($user->is_email_confirmation == 1) throw new Exception('Konto użytkownika zostało wcześniej aktywowane.');
            $user->is_account_active = 1;
            $user->is_email_confirmation = 1;
            if($users->save($user) == false) throw new Exception('Nie aktywowano poprawnie użytkownika.');
            $this->Flash->success('Pomyślnie aktywowano konto!');
            $this->redirect(array('action' => 'login'));
        }catch(Exception $e){
            $this->Flash->error(empty($e->getMessage()) ? 'Wystąpił błąd w procesie aktywacji konta.' : $e->getMessage());
            $this->redirect(array('action' => 'login'));
        }
    }
    
    public function logout(){
        $this->Flash->success('Nastąpiło wylogowanie, będziemy oczekiwać Twojego powrotu!');
        return $this->redirect($this->Auth->logout());
    }
}