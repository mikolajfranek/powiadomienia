<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use const False\MyClass\true;

class LoginForm extends Form
{
    protected function _buildSchema(Schema $schema): Schema
    {
        return $schema
            ->addField('login', 'string')
            ->addField('password', 'password');
    }
 
    public function validationDefault(Validator $validator): Validator
    {
        $validator
        //login
            ->requirePresence('login')
            ->notEmptyString('login', 'To pole nie może być puste') 
            ->lengthBetween('login', array(6, 40), 'Wymagane minimalnie 6, maksymalnie 40 znaki długości')
            ->add('login', 'custom', array(
                'rule' => array('custom', '/^[A-Za-z0-9,\.\-]*$/i'),
                'message' => 'Zawiera nieodpowiednie znaki'
            ))
        //password
            ->requirePresence('password')
            ->notEmptyString('password', 'To pole nie może być puste')
            ->lengthBetween('password', array(6, 22), 'Wymagane minimalnie 6, maksymalnie 22 znaki długości')
            ->add('password', 'custom', array(
                'rule' => array('custom', '/^[A-Za-z0-9,\.\-]*$/i'),
                'message' => 'Zawiera nieodpowiednie znaki'
            ));
        return $validator;
    }
    
    protected function _execute(array $data): bool
    {
        return true;
    }
}