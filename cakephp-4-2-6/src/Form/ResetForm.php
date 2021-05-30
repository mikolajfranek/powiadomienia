<?php

namespace App\Form;

use Cake\Core\Configure;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class ResetForm extends Form
{   
    protected function _buildSchema(Schema $schema): Schema
    {
        return $schema
            ->addField('email', 'string');
    }
    
    public function validationDefault(Validator $validator): Validator
    {
        $validator
        //email
            ->requirePresence('email')
            ->notEmptyString('email', Configure::read('Config.Validations.CannotBeEmpty'))
            ->email('email', false, Configure::read('Config.Validations.EmailFormatFailed'))
            ->maxLength('email', 100, Configure::read('Config.Validations.Max100Characters'));
        return $validator;
    }
}