<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\Core\Configure;
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
            ->notEmptyString('email', Configure::read('Config.Validations.CannotBeEmpty'))
            ->email('email', false, Configure::read('Config.Validations.EmailFormatFailed'))
            ->maxLength('email', 100, Configure::read('Config.Validations.Max100Characters'))
            ->add('email', 'unique', array(
                'rule' => array($this, 'isUniqueEmail'),
                'message' => Configure::read('Config.Validations.IsInUse')
            ))
        //password
            ->requirePresence('password')
            ->notEmptyString('password', Configure::read('Config.Validations.CannotBeEmpty'))
            ->lengthBetween('password', array(6, 22), Configure::read('Config.Validations.Min6Max22Characters'))
            ->add('password', 'custom', array(
                'rule' => array('custom', '/^[A-Za-z0-9]*$/i'),
                'message' => Configure::read('Config.Validations.FailedCharacters')
            ))
            ->add('password', 'match_passwords', array(
                'rule' => array($this, 'isPasswordMatched'),
                'message' => Configure::read('Config.Validations.PasswordsNotMached')
            ))
        //password_confirm
            ->requirePresence('password_confirm')
            ->notEmptyString('password_confirm', Configure::read('Config.Validations.CannotBeEmpty'))
            ->lengthBetween('password_confirm', array(6, 22), Configure::read('Config.Validations.Min6Max22Characters'))
            ->add('password_confirm', 'custom', array(
                'rule' => array('custom', '/^[A-Za-z0-9]*$/i'),
                'message' => Configure::read('Config.Validations.FailedCharacters')
            ))
            ->add('password_confirm', 'match_passwords', array(
                'rule' => array($this, 'isPasswordConfirmMatched'),
                'message' => Configure::read('Config.Validations.PasswordsNotMached')
            ));
        return $validator;
    }
    
    public function isUniqueEmail($check) 
    {
        $users = FactoryLocator::get('Table')->get('Users');
        $count = $users->find()
            ->where(array('email' => $check))
            ->count('*');
        return $count == 0;
    }
    
    public function isPasswordMatched($check) 
    {
        return $check == $this->getData('password_confirm');
    }
    
    public function isPasswordConfirmMatched($check) 
    {
        return $check == $this->getData('password');
    }
    
    protected function _execute(array $data): bool
    {
        $users = FactoryLocator::get('Table')->get('Users');
        $user = $users->newEmptyEntity();
        $user->email = $data['email'];
        $user->password = (new DefaultPasswordHasher())->hash($data['password']);
        $user->date_activate = date('Y-m-d H:i:s', time());
        if ($users->save($user))
        {
            return true;
        }
        return false;
    }
}