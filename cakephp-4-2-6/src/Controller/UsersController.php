<?php

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Core\Configure;
use App\Form\LoginForm;
use Exception;
use Cake\Log\Log;
use App\Form\RegisterForm;

class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['login', 'register']);
    }
    
    public function login(){
        
        $result = $this->Authentication->getResult();
        // If the user is logged in send them away.
        if ($result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? '/users/home';
            return $this->redirect($target);
        }
        
        
        $form = new LoginForm();
        $this->set('form', $form);
        if ($this->request->is('post')) {
            try{
                if($form->validate($this->request->getData()) == false) throw new Exception();
                if ($result->isValid() == false) throw new Exception();
                
                //TODO
                                
                $this->Flash->success('Witamy w serwisie');
                
            }catch(Exception $e){
                
                //TODO
                
                Log::write('error', isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "");
                Log::write('error', isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "");
                Log::write('error', $e->getMessage());
                Log::write('error', $e->getTraceAsString());
                $this->Flash->error(empty($e->getMessage()) ? Configure::read('Config.Messages.FailedForm') : $e->getMessage());
            }
         }
    }
    
    public function register(){
        $form = new RegisterForm();
        $this->set('form', $form);
        
        if ($this->request->is('post')) {
            try{
                //if($form->validate($this->request->getData()) == false) throw new Exception();
                
                if ($form->execute($this->request->getData()) == false) throw new Exception();
                
                
                //TODO
                $this->Flash->success('Jest ok');
                
            }catch(Exception $e){
                
                //TODO
                
                Log::write('error', isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "");
                Log::write('error', isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "");
                Log::write('error', $e->getMessage());
                Log::write('error', $e->getTraceAsString());
                $this->Flash->error(empty($e->getMessage()) ? Configure::read('Config.Messages.FailedForm') : $e->getMessage());
            }
        }
    }
    
    public function home(){
     
    }
    
    public function logout(){
        $this->Flash->success('Nastąpiło wylogowanie, będziemy oczekiwać Twojego powrotu!');
        return $this->redirect($this->Authentication->logout());
    }
}