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
    public function initialize() : void
    {
        parent::initialize();
        
        $this->loadComponent('Search.Search', array(
            'actions' => array('results')
        ));
    }
    
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['login', 'register', 'activate', 'reset']);
    }

    public function register()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        if ($result->isValid() == true)
        {
            $target = $this->Authentication->getLoginRedirect() ?? '/users/results';
            return $this->redirect($target);
        }
        //BEGIN: bodyClass
        $this->set('bodyClass', 'login');
        //END: bodyClass
        $form = new RegisterForm();
        $this->set('form', $form);
        try
        {
            if ($this->request->is('post'))
            {
                if ($form->execute($this->request->getData()) == false) throw new Exception();
                $users = FactoryLocator::get('Table')->get('Users');
                $user = $users->find()
                    ->where(array('email' => $this->request->getData()['email']))
                    ->first();
                //BEGIN: sendEmail
                $this->EmailProvider->sendAboutRegistration($user);
                //END: sendEmail
                $this->myFlashSuccess(Configure::read('Config.Messages.RegisterFormSuccess'));
                return $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
        }
        catch(Exception $e)
        {
            $this->myFlashError($e, Configure::read('Config.Messages.Failed'));
        }
    }
    
    public function activate($idUser, $activatingHash)
    {
        $this->request->allowMethod(['get']);
        $this->autoRender = false;
        try
        {
            $users = FactoryLocator::get('Table')->get('Users');
            $user = $users->find()
                ->where(array('id' => $idUser))
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
        return $this->redirect(array('controller' => 'users', 'action' => 'login'));
    }
    
    public function reset()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        if ($result->isValid() == true)
        {
            $target = $this->Authentication->getLoginRedirect() ?? '/users/results';
            return $this->redirect($target);
        }
        //BEGIN: bodyClass
        $this->set('bodyClass', 'login');
        //END: bodyClass
        $form = new ResetForm();
        $this->set('form', $form);
        try
        {
            if ($this->request->is('post'))
            {
                if ($form->execute($this->request->getData()) == false) throw new Exception();
                $users = FactoryLocator::get('Table')->get('Users');
                $user = $users->find()
                    ->where(array('email' => $this->request->getData()['email']))
                    ->first();
                if($user != null)
                {
                    $newPassword = substr(sha1(rand()), 0, 20);
                    $user->password = (new DefaultPasswordHasher())->hash($newPassword);
                    if ($users->save($user) == false) throw new Exception();
                    //BEGIN: sendEmail
                    $this->EmailProvider->sendAboutReset($user, $newPassword);
                    //END: sendEmail
                }
                $this->myFlashSuccess(Configure::read('Config.Messages.ResetFormSuccess'));
                return $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
        }
        catch(Exception $e)
        {
            $this->myFlashError($e, Configure::read('Config.Messages.Failed'));
        }
    }
    
    public function logout()
    {
        $this->request->allowMethod(['get']);
        $this->myFlashSuccess(Configure::read('Config.Messages.UserLogout'));
        $result = $this->Authentication->getResult();
        if ($result->isValid() == true) 
        {
            $this->Authentication->logout();
            return $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
    }
    
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        if ($result->isValid() == true)
        {
            $target = $this->Authentication->getLoginRedirect() ?? '/users/results';
            return $this->redirect($target);
        }
        //BEGIN: bodyClass
        $this->set('bodyClass', 'login');
        //END: bodyClass
        $form = new LoginForm();
        $this->set('form', $form);
        try
        {
            if ($this->request->is('post'))
            {
                if($form->execute($this->request->getData()) == false) throw new Exception();
                $users = FactoryLocator::get('Table')->get('Users');
                $user = $users->find()
                    ->where(array('email' => $this->request->getData()['email']))
                    ->first();
                if($user['is_account_active'] == false) throw new Exception(Configure::read('Config.Messages.UserBlocked'));
                if($user['is_email_confirmation'] == false) throw new Exception(Configure::read('Config.Messages.UserBlocked'));
                if($user['is_blocked'] == true) throw new Exception(Configure::read('Config.Messages.UserBlocked'));                
                if((new DefaultPasswordHasher)->check($this->request->getData()['password'], $user->password) == false) throw new Exception(Configure::read('Config.Messages.LoginFormFailed'));
                $this->Authentication->setIdentity($user);
                return $this->redirect(array('controller' => 'users', 'action' => 'results'));
            }
        }
        catch (Exception $e)
        {
            $this->myFlashError($e, Configure::read('Config.Messages.Failed'));
        }
    }
    
    public function settings()
    {
        $this->request->allowMethod(['get', 'post']);
        $form = new SettingsForm();
        $this->set('form', $form);
        try
        {
            if ($this->request->is('post'))
            {
                $data = $this->request->getData();
                $data['id'] = $this->user['id'];
                if ($form->execute($data) == false) throw new Exception();
                $users = FactoryLocator::get('Table')->get('Users');
                $user = $users->find()
                    ->where(array('id' => $this->user['id']))
                    ->first();
                $dataToUpdated = array(
                    'is_email_notification' => $data['is_email_notification'],
                    'email' => $data['email']
                );
                $userChangeEmail = $user->email != $dataToUpdated['email'];
                if($userChangeEmail == true)
                {
                    $dataToUpdated['is_email_confirmation'] = 0;
                }
                $userChangePassword = empty($data['password_new']) == false;
                if($userChangePassword == true)
                {
                    $dataToUpdated['password'] = (new DefaultPasswordHasher)->hash($data['password_new']);
                }
                $users->patchEntity($user, $dataToUpdated);
                if($users->save($user) == false) throw new Exception();
                $result = $this->Authentication->getResult();
                if($userChangeEmail == true)
                {
                    $this->EmailProvider->sendAboutChangeEmail($user);
                    $this->myFlashSuccess(Configure::read('Config.Messages.UserMustUnblock'));
                    if ($result->isValid() == true)
                    {
                        $this->Authentication->logout();
                    }
                    return $this->redirect(array('controller' => 'users', 'action' => 'login'));
                }
                else if($userChangePassword)
                {
                    $this->myFlashSuccess(Configure::read('Config.Messages.UserMustUseNewPassword'));
                    if ($result->isValid() == true)
                    {
                        $this->Authentication->logout();
                    }
                    return $this->redirect(array('controller' => 'users', 'action' => 'login'));
                }
                else
                {
                    $this->myFlashSuccess(Configure::read('Config.Messages.SettingsSuccess'));
                }
            }
            else
            {
                $users = FactoryLocator::get('Table')->get('Users');
                $user = $users->find()
                ->where(array('id' => $this->user['id']))
                ->first();
                $form->setData([
                    'is_email_notification' => $user->is_email_notification,
                    'email' => $user->email
                ]);
            }
        }
        catch (Exception $e)
        {
            $this->myFlashError($e, Configure::read('Config.Messages.Failed'));
        }
    }
    
    public function tickets()
    {
        $this->request->allowMethod(['get']);
        try
        {
            $tickets = FactoryLocator::get('Table')->get('Tickets');
            $ticketsOfUser = $tickets->find()
                ->where(array('id_user' => $this->user['id']))
                ->all();
            $this->set('tickets', $ticketsOfUser);
        }
        catch (Exception $e)
        {
            $this->myFlashError($e, Configure::read('Config.Messages.Failed'));
        }
    }
    
    public function results($page = null)
    {
        $this->request->allowMethod(['get']);
        try
        {
            $page = $page ?? 1;
            $page = $page < 1 ? 1 : $page;
            $results = FactoryLocator::get('Table')->get('Results');
            $params = $this->request->getQueryParams();
            if(isset($params['numbers_of_user']))
            {
                $params['numbers_of_user'] = trim($params['numbers_of_user']);
                $params['numbers_of_user'] = preg_replace('/\s+/', ' ', $params['numbers_of_user']);
                $params['numbers_of_user'] = preg_replace('/[^0-9]/', ';', $params['numbers_of_user']);
            }
            $query = $results->find('search', array('search' => $params))
                ->where(array('Results.id_user' => $this->user['id']))
                ->order('Results.id DESC')
                ->page($page, 10)
                ->contain(['Emails']);
            $resultsOfUser = $this->paginate($query, array('limit' => 10, 'page' => $page));
            $this->set('resultsOfUser', $resultsOfUser);
            $this->set('paginate', $this->Paginator->getPaginator()->getPagingParams()['Results']);
        }
        catch (Exception $e)
        {
            $this->myFlashError($e, Configure::read('Config.Messages.Failed'));
        }
    }
}