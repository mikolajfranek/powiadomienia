<?php

namespace App\Form;

use Cake\Datasource\FactoryLocator;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class SettingsForm extends Form
{
    protected function _buildSchema(Schema $schema): Schema
    {
        return $schema
            ->addField('is_email_notification', 'bool')
            ->addField('email', 'string')
            ->addField('password', 'password')
            ->addField('password_new', 'password');
    }
 
    public function validationDefault(Validator $validator): Validator
    {
        $validator
        //email
            ->requirePresence('email')
            ->notEmptyString('email', 'To pole nie może być puste')
            ->email('email', false, "Nieprawidłowy adres email")
            ->maxLength('email', 100, 'Maksymalnie 100 znaki długości')
            ->add('email', 'unique', array(
                'rule' => array($this, 'isUniqueEmail'),
                'message' => 'Adres email jest już w użyciu'
            ))
        //password
            ->requirePresence('password')
            ->notEmptyString('password', 'To pole nie może być puste')
            ->lengthBetween('password', array(6, 22), 'Wymagane minimalnie 6, maksymalnie 22 znaki długości')
            ->add('password', 'custom', array(
                'rule' => array('custom', '/^[A-Za-z0-9]*$/i'),
                'message' => 'Zawiera nieodpowiednie znaki'
            ))
            ->add('password', 'match_passwords', array(
                'rule' => array($this, 'isPasswordMatched'),
                'message' => 'Hasło użytkownika jest niepoprawne'
            ))  
        //password_new   
            ->allowEmptyString('password_new')
            ->add('password_new', 'custom', array(
                'rule' => array('custom', '/^[A-Za-z0-9]*$/i'),
                'message' => 'Zawiera nieodpowiednie znaki'
            ))
            ->add('password_new', 'length_password', array(
                'rule' => array($this, 'isPasswordNewLength'),
                'message' => 'Wymagane minimalnie 6, maksymalnie 22 znaki długości'
            ))
            ->add('password_new', 'match_passwords', array(
                'rule' => array($this, 'isPasswordNewMatched'),
                'message' => 'Nowe hasło użytkownika nie może być takie samo jak aktualne'
            ));
        return $validator;
    }
    
    public function isUniqueEmail($check) {
        $users = FactoryLocator::get('Table')->get('Users');
        $count = $users->find()
            ->where(array('email' => $check, 'id IS NOT' => $this->getData('id')))
            ->count('*');
        return $count == 0;
    }
    
    public function isPasswordMatched($check) {
        $users = FactoryLocator::get('Table')->get('Users');
        $user = $users->find()
            ->where(array('id' => $this->getData('id')))
            ->first();
        return (new DefaultPasswordHasher)->check($check, $user->password);
    }
    
    public function isPasswordNewLength($check) {
        if(empty($check)) return true;
        return strlen($check) >= 6 && strlen($check) <= 22;
    }
    
    public function isPasswordNewMatched($check) {
        if(empty($check)) return true;
        $users = FactoryLocator::get('Table')->get('Users');
        $user = $users->find()
            ->where(array('id' => $this->getData('id')))
            ->first();
        return (new DefaultPasswordHasher)->check($check, $user->password) == false;
    }
    
    protected function _execute(array $data): bool
    {
        return true;
    }
}