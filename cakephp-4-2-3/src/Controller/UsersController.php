<?php

namespace App\Controller;

use App\Form\LoginForm;
use Cake\Event\EventInterface;
use Cake\Log\Log;
use Exception;

class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['register', 'activate']);
    }
    
    public function login(){
  
        
        if($this->Auth->user() != null){
            return $this->redirect($this->Auth->redirectUrl());
        }
        $form = new LoginForm();
        if ($this->request->is('post')) {
            try{
                if($form->validate($this->request->getData()) == false) throw new Exception('Wystąpił błąd w przetwarzaniu formularza.');
                
                
                
                
                $user = $this->Auth->identify() ->identify();
                if($user == false) throw new Exception("Login lub hasło są niepoprawne.");
                if($user['is_account_active'] != 1 || $user['is_email_confirmation'] != 1) throw new Exception("Konto jest zablokowane.");
                $this->Auth->setUser($user);
                $this->Flash->success('Witamy w serwisie ' . Configure::read('Config.WebName') . '.');
                return $this->redirect($this->Auth->redirectUrl());
                
            }catch(Exception $e){
                Log::write('error', isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "");
                Log::write('error', isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "");
                Log::write('error', $e->getMessage());
                Log::write('error', $e->getTraceAsString());
                $this->Flash->error(empty($e->getMessage()) ? 'Wystąpił błąd w wysyłaniu formularza, spóbuj ponownie.' : $e->getMessage());
            }
            
            
            
            
            
            
        }
        $this->set('form', $form);
    }
    
}