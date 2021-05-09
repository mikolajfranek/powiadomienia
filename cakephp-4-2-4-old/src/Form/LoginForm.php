<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class LoginForm extends Form
{
    protected function _buildSchema(Schema $schema): Schema
    {
        return $schema
            ->addField('email', 'string')
            ->addField('password', 'password');
    }
 
    public function validationDefault(Validator $validator): Validator
    {
        $validator
        //email
            ->requirePresence('email')
            ->notEmptyString('email', 'Nie może być puste')
            ->email('email', false, 'Nieprawidłowy adres e-mail')
            ->maxLength('email', 100, 'Długość przekracza 100 znaków długości')
        //password
            ->requirePresence('password')
            ->notEmptyString('password', 'Nie może być puste')
            ->lengthBetween('password', array(6, 22), 'Długość nie jest w przedziale <6;22> znaków długości')
            ->add('password', 'custom', array(
                'rule' => array('custom', '/^[A-Za-z0-9]*$/i'),
                'message' => 'Zawiera nieodpowiednie znaki'
            ));
        return $validator;
    }
}