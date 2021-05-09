<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\Datasource\FactoryLocator;
use Cake\Auth\DefaultPasswordHasher;

class RegisterForm extends Form
{   
    protected function _buildSchema(Schema $schema): Schema
    {
        return $schema
            ->addField('email', 'string')
            ->addField('password', 'password')
            ->addField('password_confirm', 'password');
    }
 
    public function validationDefault(Validator $validator): Validator
    {
        $validator
        //email
            ->requirePresence('email')
            ->notEmptyString('email', 'Nie może być puste')
            ->email('email', false, 'Nieprawidłowy adres e-mail')
            ->maxLength('email', 100, 'Długość przekracza 100 znaków długości')
            ->add('email', 'unique', array(
                'rule' => array($this, 'isUniqueEmail'),
                'message' => 'E-mail jest już w użyciu'
            ))  
        //password
            ->requirePresence('password')
            ->notEmptyString('password', 'Nie może być puste')
            ->lengthBetween('password', array(6, 22), 'Długość nie jest w przedziale <6;22> znaków długości')
            ->add('password', 'custom', array(
                'rule' => array('custom', '/^[A-Za-z0-9]*$/i'),
                'message' => 'Zawiera nieodpowiednie znaki'
            ))
            ->add('password', 'match_passwords', array(
                'rule' => array($this, 'isPasswordMatched'),
                'message' => 'Hasła nie pasują do siebie'
            ))
        //password_confirm
            ->requirePresence('password_confirm')
            ->notEmptyString('password_confirm', 'Nie może być puste')
            ->lengthBetween('password_confirm', array(6, 22), 'Długość nie jest w przedziale <6;22> znaków długości')
            ->add('password_confirm', 'custom', array(
                'rule' => array('custom', '/^[A-Za-z0-9]*$/i'),
                'message' => 'Zawiera nieodpowiednie znaki'
            ))
            ->add('password_confirm', 'match_passwords', array(
                'rule' => array($this, 'isPasswordConfirmMatched'),
                'message' => 'Hasła nie pasują do siebie'
            ));
        return $validator;
    }
    
    public function isUniqueEmail($check) {
        $users = FactoryLocator::get('Table')->get('Users');
        $count = $users->find()
            ->where(array('email' => $check))
            ->count('*');
        return $count == 0;
    }
    
    public function isPasswordMatched($check) {
        return $check == $this->getData('password_confirm');
    }
    
    public function isPasswordConfirmMatched($check) {
        return $check == $this->getData('password');
    }
    
    protected function _execute(array $data): bool
    {
        $users = FactoryLocator::get('Table')->get('Users');
        $user = $users->newEmptyEntity();
        $user->email = $data['email'];
        $user->password = (new DefaultPasswordHasher())->hash($data['password']);        
        if ($users->save($user)) {
            return true;
        }
        return false;
    }
}