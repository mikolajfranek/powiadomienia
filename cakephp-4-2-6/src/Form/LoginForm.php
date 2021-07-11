<?php

namespace App\Form;

use Cake\Core\Configure;
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
            ->notEmptyString('email', Configure::read('Config.Validations.CannotBeEmpty'))
            ->email('email', false, Configure::read('Config.Validations.EmailFormatFailed'))
            ->maxLength('email', 100, Configure::read('Config.Validations.Max100Characters'))
        //password
            ->requirePresence('password')
            ->notEmptyString('password', Configure::read('Config.Validations.CannotBeEmpty'))
            ->lengthBetween('password', array(6, 22), Configure::read('Config.Validations.Min6Max22Characters'))
            ->add('password', 'custom', array(
                'rule' => array('custom', '/^[A-Za-z0-9]*$/i'),
                'message' => Configure::read('Config.Validations.FailedCharacters')
            ));
        return $validator;
    }
}