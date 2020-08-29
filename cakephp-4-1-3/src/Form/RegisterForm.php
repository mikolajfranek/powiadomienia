<?php

namespace App\Form;

use Cake\Auth\DigestAuthenticate;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class RegisterForm extends Form
{
    protected function _buildSchema(Schema $schema): Schema
    {
        return $schema
            ->addField('login', 'string')
            ->addField('email', 'string')
            ->addField('password', 'password')
            ->addField('password_confirm', 'password');
    }
 
    public function validationDefault(Validator $validator): Validator
    {
        $validator
        //login
            ->requirePresence('login')
            ->notEmptyString('login', 'To pole nie może być puste') 
            ->lengthBetween('login', array(6, 22), 'Wymagane minimalnie 6, maksymalnie 22 znaki długości')
            ->add('login', 'custom', array(
                'rule' => array('custom', '/^[A-Za-z0-9,\.\-]*$/i'),
                'message' => 'Zawiera nieodpowiednie znaki'
            ))
            ->add('login', 'unique', array(
                'rule' => array($this, 'isUniqueLogin'),
                'message' => 'Login jest już w użyciu'
            ))  
        //email
            ->requirePresence('email')
            ->notEmptyString('email', 'To pole nie może być puste')
            ->email('email', false, "Nieprawidłowy email")
            ->add('email', 'unique', array(
                'rule' => array($this, 'isUniqueEmail'),
                'message' => 'Email jest już w użyciu'
            ))  
        //password
            ->requirePresence('password')
            ->notEmptyString('password', 'To pole nie może być puste')
            ->lengthBetween('password', array(6, 22), 'Wymagane minimalnie 6, maksymalnie 22 znaki długości')
            ->add('password', 'custom', array(
                'rule' => array('custom', '/^[A-Za-z0-9,\.\-]*$/i'),
                'message' => 'Zawiera nieodpowiednie znaki'
            ))
            ->add('password', 'match_passwords', array(
                'rule' => array($this, 'isPasswordMatched'),
                'message' => 'Hasła nie pasują do siebie'
            ))
        //password_confirm
            ->requirePresence('password_confirm')
            ->notEmptyString('password_confirm', 'To pole nie może być puste')
            ->lengthBetween('password_confirm', array(6, 22), 'Wymagane minimalnie 6, maksymalnie 22 znaki długości')
            ->add('password_confirm', 'custom', array(
                'rule' => array('custom', '/^[A-Za-z0-9,\.\-]*$/i'),
                'message' => 'Zawiera nieodpowiednie znaki'
            ))
            ->add('password_confirm', 'match_passwords', array(
                'rule' => array($this, 'isPasswordConfirmMatched'),
                'message' => 'Hasła nie pasują do siebie'
            ));
        return $validator;
    }
    
    public function isUniqueLogin($check) {
        return true;
        //$conditions = array($this->name . '.login' => $check['login']);
        //$user = $this->find('count', array('conditions' => $conditions));
        //if (empty($user)) {
        //return true;
        //}
        //return false;
    }
    
    public function isUniqueEmail($check) {
        return true;
        //$conditions = array($this->name . '.email' => $check['email']);
        //$user = $this->find('count', array('conditions' => $conditions));
        //if (empty($user)) {
            //return true;
        //}
        //return false;
    }
    
    public function isPasswordMatched($password) {
        if ($password == $this->getData('password_confirm')) {
            return true;
        }
        return false;
    }
    
    public function isPasswordConfirmMatched($password) {
        if ($password == $this->getData('password')) {
            return true;
        }
        return false;
    }
    
    protected function _execute(array $data): bool
    {
        //save to database
        
        //redirect
        
        
        unset($data['password_confirm']);
        $data['password'] = DigestAuthenticate::password($data['login'], $data['password'], env('SERVER_NAME'));   
        
        return true;
    }
}