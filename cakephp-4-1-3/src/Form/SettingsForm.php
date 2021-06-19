<?php

namespace App\Form;

use Cake\Datasource\FactoryLocator;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class SettingsForm extends Form
{

    public function validationDefault(Validator $validator): Validator
    {
        $validator
    

        //password_new   
      
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
    
 
    
   
    

    
}