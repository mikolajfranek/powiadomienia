<?php

namespace App\Controller;

use App\Form\LoginForm;
use App\Form\RegisterForm;
use App\Form\ResetForm;
use App\Form\SettingsForm;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Auth\DigestAuthenticate;
use Cake\Core\Configure;
use Cake\Datasource\FactoryLocator;
use Cake\Event\EventInterface;
use Exception;

class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['login', 'register', 'activate', 'reset']);
    }

    public function register()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid() == true)
        {
            $target = $this->Authentication->getLoginRedirect() ?? '/users/profile';
            return $this->redirect($target);
        }
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
    
    public function reset()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid() == true)
        {
            $target = $this->Authentication->getLoginRedirect() ?? '/users/profile';
            return $this->redirect($target);
        }
        //BEGIN: bodyClass
        $this->set('bodyClass', "login");
        //END: bodyClass
        $form = new ResetForm();
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
                if($user != null)
                {
                    $newPassword = substr(sha1(rand()), 0, 20);
                    $user->password = (new DefaultPasswordHasher())->hash($newPassword);
                    if ($users->save($user) == false) throw new Exception();
                    $this->EmailProvider->sendAboutReset($user, $newPassword);   
                }
                //END: sendEmail
                $this->myFlashSuccess(Configure::read('Config.Messages.ResetFormSuccess'));
                $this->redirect(array('action' => 'login'));
            }
            catch(Exception $e)
            {
                $this->myFlashError($e, Configure::read('Config.Messages.Failed'));
            }
        }
    }
    
    public function logout()
    {
        $this->myFlashSuccess(Configure::read('Config.Messages.UserLogout'));
        $this->Authentication->logout();
        $this->redirect(array('action' => 'login'));
    }
    
    public function login()
    {
        $result = $this->Authentication->getResult();
        //BEGIN: bodyClass
        $this->set('bodyClass', "login");
        //END: bodyClass
        $form = new LoginForm();
        $this->set('form', $form);
        if ($this->request->is('post'))
        {
            try
            {
                if($form->validate($this->request->getData()) == false) throw new Exception();
                if ($result->isValid() == false) throw new Exception();
                $user = $this->Authentication->getIdentity();
                if($user['is_account_active'] == false) throw new Exception(Configure::read('Config.Messages.UserNotBlocked'));
                if($user['is_email_confirmation'] == false) throw new Exception(Configure::read('Config.Messages.UserNotBlocked'));
                if($user['is_blocked'] == true) throw new Exception(Configure::read('Config.Messages.UserNotBlocked'));
                $target = $this->Authentication->getLoginRedirect() ?? '/users/profile';
                return $this->redirect($target);
            }
            catch (Exception $e)
            {
                $this->myFlashError($e, Configure::read('Config.Messages.LoginFormFailed'));
            }
        }
        else
        {
            if ($result->isValid() == true)
            {
                $target = $this->Authentication->getLoginRedirect() ?? '/users/profile';
                return $this->redirect($target);
            }
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    //TODO
    
    
    public function settings(){
        $form = new SettingsForm();
        $this->set('form', $form);
        if ($this->request->is('post'))
        {
            try
            {
                throw new Exception();
                
                
                
            }
            catch (Exception $e)
            {
                $this->myFlashError($e, Configure::read('Config.Messages.Failed'));
            }
        }
        else
        {
            try
            {
                $users = FactoryLocator::get('Table')->get('Users');
                $user = $users->find()
                    ->where(array('id' => $this->Authentication->getIdentity()['id']))
                    ->first();
                $form->setData([
                    'is_email_notification' => $user->is_email_notification,
                    'email' => $user->email
                ]); 
            }
            catch (Exception $e)
            {
                $this->myFlashError($e, Configure::read('Config.Messages.Failed'));
            }
        }
    }
    
    
    public function profile(){
     
    }
}