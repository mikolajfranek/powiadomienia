<?php

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Core\Configure;
use App\Form\LoginForm;
use Exception;
use Cake\Log\Log;

class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['login']);
    }
    
    public function login(){
        
        $result = $this->Authentication->getResult();
        // If the user is logged in send them away.
        if ($result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? '/home';
            return $this->redirect($target);
        }
        
        
        $form = new LoginForm();
        $this->set('form', $form);
        if ($this->request->is('post')) {
            try{
                if($form->validate($this->request->getData()) == false) throw new Exception();
                if ($result->isValid() == false) throw new Exception();
                
                //TODO
                                
                //$this->Flash->success('Witamy w serwisie');
                
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
}