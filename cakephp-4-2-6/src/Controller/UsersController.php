<?php

namespace App\Controller;

use Cake\Datasource\FactoryLocator;
use Cake\Event\EventInterface;
use Cake\Auth\DigestAuthenticate;
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
        $this->Authentication->allowUnauthenticated(['login', 'register', 'activate', 'reset']);
    }

    public function register()
    {
        //BEGIN: bodyClass
        $this->set('bodyClass', "login");
        //END: bodyClass
        $form = new RegisterForm();
        $this->set('form', $form);
        if ($this->request->is('post')) 
        {
            try
            {
                if ($form->execute($this->request->getData()) == false) throw new Exception();
                //BEGIN: sendEmail
                $users = FactoryLocator::get('Table')->get('Users');
                $user = $users->find()
                    ->where(array('email' => $this->request->getData()['email']))
                    ->first();
                $this->EmailProvider->sendAboutRegistration($user);
                //END: sendEmail
                $this->myFlashSuccess(Configure::read('Config.Messages.RegisterFormSuccess'));
                $this->redirect(array('action' => 'login'));
            }
            catch(Exception $e)
            {
                $this->myFlashError($e, Configure::read('Config.Messages.Failed'));
            }
        }
    }
    
    public function activate($userId, $activatingHash)
    {
        $this->autoRender = false;
        try
        {
            $users = FactoryLocator::get('Table')->get('Users');
            $user = $users->find()
                ->where(array('id' => $userId))
                ->first();
            if($user == null) throw new Exception(Configure::read('Config.Messages.UserNotFound'));
            $hash = DigestAuthenticate::password($user->email, $user->password, env('SERVER_NAME'));
            if($activatingHash != $hash) throw new Exception(Configure::read('Config.Messages.UserNotFound'));
            if($user->is_blocked == 1) throw new Exception(Configure::read('Config.Messages.UserNotFound'));
            if($user->is_email_confirmation == 1) throw new Exception(Configure::read('Config.Messages.UserNotFound'));
            $user->is_account_active = 1;
            $user->is_email_confirmation = 1;
            if($users->save($user) == false) throw new Exception();
            $this->myFlashSuccess(Configure::read('Config.Messages.ActivateSuccess'));
        }
        catch(Exception $e)
        {
            $this->myFlashError($e, Configure::read('Config.Messages.Failed'));
        }
        $this->redirect(array('action' => 'login'));
    }
    
    
    
    
    
    
    
    
    
    
    //TODO
    
    
    
    
    
    
    
    public function reset()
    {
        
        
    }
    
    
    
    
    
    public function login()
    {
        //BEGIN: bodyClass
        $this->set('bodyClass', "login");
        //END: bodyClass
        
        
        
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
                $this->Flash->error(empty($e->getMessage()) ? Configure::read('Config.Messages.Failed') : $e->getMessage(), ['key' => 'notification']);
            }
         }
    }
    
    public function logout(){
        $this->Flash->success('Nastąpiło wylogowanie, będziemy oczekiwać Twojego powrotu!');
        return $this->redirect($this->Authentication->logout());
    }
    
    
    
    
    
 
    
    public function home(){
        //return $this->redirect($this->Authentication->logout());
     
    }
    
 
}