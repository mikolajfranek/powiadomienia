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

    /*
     public function login(){
     if($this->Auth->user() != null){
     return $this->redirect($this->Auth->redirectUrl());
     }
     $form = new LoginForm();
     if ($this->request->is('post')) {
     try{
     if($form->validate($this->request->getData()) == false) throw new Exception('Wystąpił błąd w przetwarzaniu formularza logowania.');
     $user = $this->Auth->identify();
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
     */
    
 
    public function settings(){
        $form = new SettingsForm();
        $this->set('form', $form);
        
        if ($this->request->is('post')) {
          
                //dodanie id do 'data'
                $data = $this->request->getData();
                $data['id'] = $this->Auth->user()['id'];
                if ($form->execute($data) == false) throw new Exception('Wystąpił błąd w przetwarzaniu formularza ustawień.');
                
                
                
                
                
                
                
                
                
                
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
                    $this->Flash->success('Pomyślnie zaktualizowano dane użytkownika, zaloguj się ponownie korzystając z nowego hasła.');
                    return $this->redirect($this->Auth->logout());
                }else{
                    $this->Flash->success('Pomyślnie zaktualizowano dane użytkownika.');
                }
                
                
                
        }
        
        
        
        
       
    }
}