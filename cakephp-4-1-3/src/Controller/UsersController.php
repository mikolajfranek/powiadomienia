<?php

namespace App\Controller;

use App\Form\LoginForm;
use App\Form\RegisterForm;
use Cake\Auth\DigestAuthenticate;
use Cake\Core\Exception\Exception;
use Cake\Datasource\FactoryLocator;
use Cake\Event\EventInterface;
use Cake\Core\Configure;
use Cake\Log\Log;
use App\Form\SettingsForm;
use Cake\Auth\DefaultPasswordHasher;

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
                if($user['is_account_active'] != 1 || $user['is_email_confirmation'] != 1) throw new Exception("Konto jest zablokowane.");
                $this->Auth->setUser($user);
                $this->Flash->success('Witamy w serwisie ' . Configure::read('Config.WebName') . '.');
                return $this->redirect($this->Auth->redirectUrl());
            }catch(Exception $e){
                Log::write('error', $e->getMessage());
                Log::write('error', $e->getTraceAsString());
                $this->Flash->error(empty($e->getMessage()) ? 'Wystąpił błąd w wysyłaniu formularza, spóbuj ponownie.' : $e->getMessage());
            }
        }
        $this->set('form', $form);
    }
    
    public function register(){
        $form = new RegisterForm();
        if($this->Auth->user() != null){
            return $this->redirect($this->Auth->redirectUrl());
        }
        if ($this->request->is('post')) {
            try{
                if ($form->execute($this->request->getData()) == false) throw new Exception('Wystąpił błąd w przetarzaniu formularza rejestracji.');
                $users = FactoryLocator::get('Table')->get('Users');
                $user = $users->find()
                    ->where(array('login' => $this->request->getData()['login']))
                    ->first();
                $this->EmailProvider->sendAboutRegistration($user);
                $this->Flash->success('Aktywuj konto za pomocą linku aktywacyjnego znajdującego się na Twojej poczcie elektrocznej.');
                $this->redirect(array('action' => 'login'));
            }catch(Exception $e){
                Log::write('error', $e->getMessage());
                Log::write('error', $e->getTraceAsString());
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
            if($user == null) throw new Exception('Nie znaleziono zarejestrowanego użytkownika.');
            $hash = DigestAuthenticate::password($user->login, ($user->login . $user->email), env('SERVER_NAME'));
            if($activating_hash != $hash) throw new Exception('Podany hash się nie zgadza.');
            if($user->is_email_confirmation == 1) throw new Exception('Konto użytkownika zostało wcześniej aktywowane.');
            $user->is_account_active = 1;
            $user->is_email_confirmation = 1;
            if($users->save($user) == false) throw new Exception('Nie aktywowano poprawnie użytkownika.');
            $this->Flash->success('Pomyślnie aktywowano konto!');
            $this->redirect(array('action' => 'login'));
        }catch(Exception $e){
            Log::write('error', $e->getMessage());
            Log::write('error', $e->getTraceAsString());
            $this->Flash->error(empty($e->getMessage()) ? 'Wystąpił błąd w procesie aktywacji konta.' : $e->getMessage());
            $this->redirect(array('action' => 'login'));
        }
    }
    
    public function logout(){
        $this->Flash->success('Nastąpiło wylogowanie, będziemy oczekiwać Twojego powrotu!');
        return $this->redirect($this->Auth->logout());
    }
    
    public function settings(){
        $form = new SettingsForm();
        if ($this->request->is('post')) {
            try{
                $data = $this->request->getData();
                $data['id'] = $this->Auth->user()['id'];
                if ($form->execute($data) == false) throw new Exception('Wystąpił błąd w przetarzaniu formularza ustawień.');
                $users = FactoryLocator::get('Table')->get('Users');
                $user = $users->find()
                    ->where(array('id' => $this->Auth->user()['id']))
                    ->first();
                $dataToUpdated = array(
                    'is_email_notification' => $data['is_email_notification'],
                    'email' => $data['email']
                );
                $userChangeEmail = $user->email != $data['email'];
                if($userChangeEmail){
                    $dataToUpdated['is_email_confirmation'] = 0;
                }
                $userChangePassword = empty($data['password_new']) == false;
                if($userChangePassword){
                    $dataToUpdated['password'] = (new DefaultPasswordHasher)->hash($data['password_new']);
                }
                $users->patchEntity($user, $dataToUpdated);
                $this->Users->save($user);
                if($userChangeEmail){
                    $this->EmailProvider->sendAboutChangeEmail($user);
                    $this->Flash->success('Adres email został zmieniony, odblokuj konto za pomocą linku odblokowującego znajdującego się na Twojej poczcie elektronicznej.');
                    return $this->redirect($this->Auth->logout());
                }else if($userChangePassword){
                    $this->Flash->success('Pomyślnie zaktualizowane dane użytkownika, zaloguj się ponownie korzystając z nowego hasła.');
                    return $this->redirect($this->Auth->logout());
                }else{
                    $this->Flash->success('Pomyślnie zaktualizowane dane użytkownika.');
                }
            }catch(Exception $e){
                Log::write('error', $e->getMessage());
                Log::write('error', $e->getTraceAsString());
                $this->Flash->error(empty($e->getMessage()) ? 'Wystąpił błąd w wysyłaniu formularza, spóbuj ponownie.' : $e->getMessage());
            }
        }
        if ($this->request->is('get')) {
            $users = FactoryLocator::get('Table')->get('Users');
            $user = $users->find()
                ->where(array('id' => $this->Auth->user()['id']))
                ->first();
            $form->setData([
                'is_email_notification' => $user['is_email_notification'],
                'email' => $user['email']
            ]);
        }
        $this->set('form', $form);
    }
}