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
            ->addField('id', 'integer')
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
            ->email('email', false, "Nieprawidłowy email")
            ->maxLength('email', 100, 'Maksymalnie 100 znaki długości')
            ->add('email', 'unique', array(
                'rule' => array($this, 'isUniqueEmail'),
                'message' => 'Email jest już w użyciu'
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
                'message' => 'Hasła nie pasują do siebie'
            ))
        //password_confirm
            ->requirePresence('password_new')
            ->notEmptyString('password_new', 'To pole nie może być puste')
            ->lengthBetween('password_new', array(6, 22), 'Wymagane minimalnie 6, maksymalnie 22 znaki długości')
            ->add('password_new', 'custom', array(
                'rule' => array('custom', '/^[A-Za-z0-9]*$/i'),
                'message' => 'Zawiera nieodpowiednie znaki'
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
    
    //TODO
    
    //$2y$10$T38dy/nmAMvOual.gPt1cuFWUASV4Y.Ohh2gs0LEnWrYfTJWGgNdC
    public function isPasswordMatched($password) {
        $users = FactoryLocator::get('Table')->get('Users');
        $user = $users->find()
            ->where(array('id' => $this->getData('id')))
            ->first();
        $password = (new DefaultPasswordHasher())->hash($password);
        if ($password == $user->password){
            return true;
        }
        return false;
    }
    
    protected function _execute(array $data): bool
    {
        return true;
    }
}