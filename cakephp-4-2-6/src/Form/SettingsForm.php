<?php

namespace App\Form;

use Cake\Core\Configure;
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
            ->addField('is_email_notification', 'string')
            ->addField('email', 'string')
            ->addField('password', 'password')
            ->addField('password_new', 'password');
    }
    
    public function validationDefault(Validator $validator): Validator
    {
        $validator
        //is_email_notification
        ->allowEmptyString('is_email_notification')
        ->add('is_email_notification', 'custom', array(
            'rule' => array('custom', '/^[01]*$/i'),
            'message' => Configure::read('Config.Validations.FailedCharacters')
        ))
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
                'message' => Configure::read('Config.Validations.PasswordInvalid')
            ))
        //password_new
            ->allowEmptyString('password_new')
            ->add('password_new', 'length_password', array(
                'rule' => array($this, 'isPasswordNewLength'),
                'message' => Configure::read('Config.Validations.Min6Max22Characters')
            ))
            ->add('password_new', 'custom', array(
                'rule' => array('custom', '/^[A-Za-z0-9]*$/i'),
                'message' => Configure::read('Config.Validations.FailedCharacters')
            ))
            ->add('password_new', 'match_passwords', array(
                'rule' => array($this, 'isPasswordNewMatched'),
                'message' => Configure::read('Config.Validations.PasswordIsTheSame')
            ));
        return $validator;
    }
    
    public function isUniqueEmail($check) 
    {
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
        return (new DefaultPasswordHasher)->check($check, $user->password) == true;
    }
    
    public function isPasswordNewLength($check) {
        return strlen($check) >= 6 && strlen($check) <= 22;
    }
    
    public function isPasswordNewMatched($check) {
        $users = FactoryLocator::get('Table')->get('Users');
            $user = $users->find()
            ->where(array('id' => $this->getData('id')))
            ->first();
        return (new DefaultPasswordHasher)->check($check, $user->password) == false;
    }
}