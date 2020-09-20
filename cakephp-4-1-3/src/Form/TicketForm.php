<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\Core\Configure;
use Cake\Datasource\FactoryLocator;

class TicketForm extends Form
{
    protected function _buildSchema(Schema $schema): Schema
    {
        return $schema
            ->addField('id_game', 'integer')
            ->addField('date_begin', 'date')
            ->addField('date_end', 'date')
            ->addField('collection1', 'string')
            ->addField('collection2', 'string')
            ->addField('collection3', 'string')
            ->addField('collection4', 'string')
            ->addField('collection5', 'string')
            ->addField('collection6', 'string')
            ->addField('collection7', 'string')
            ->addField('collection8', 'string');
    }
    
    public function validationDefault(Validator $validator): Validator
    {
        $validator
        //id_game
        ->requirePresence('id_game')
        ->notEmptyString('id_game', 'To pole nie może być puste')
        ->add('id_game', 'isGameExists', array(
            'rule' => array($this, 'isGameExists'),
            'message' => 'Gra nie istnieje w systemie'
        ))
        //date_begin
        ->requirePresence('date_begin')
        ->notEmptyString('date_begin', 'To pole nie może być puste')
        ->add('date_begin', 'isProperlyDateBegin', array(
            'rule' => array($this, 'isProperlyDateBegin'),
            'message' => 'Data początkowa jest niepoprawna'
        ))
        //date_end
        ->requirePresence('date_end')
        ->notEmptyString('date_end', 'To pole nie może być puste')
        ->add('date_end', 'isProperlyDateBegin', array(
            'rule' => array($this, 'isProperlyDateEnd'),
            'message' => 'Data końcowa jest niepoprawna'
        ))
        //collection1
        ->allowEmptyString('collection1')
        ->add('collection1', 'isProperlyFormatCollection', array(
            'rule' => array($this, 'isProperlyFormatCollection'),
            'message' => 'Format deklaracji zakładu jest niepoprawny'
        ))
        //collection2
        ->allowEmptyString('collection2')
        ->add('collection2', 'isProperlyFormatCollection', array(
            'rule' => array($this, 'isProperlyFormatCollection'),
            'message' => 'Format deklaracji zakładu jest niepoprawny'
        ))
        //collection3
        ->allowEmptyString('collection3')
        ->add('collection3', 'isProperlyFormatCollection', array(
            'rule' => array($this, 'isProperlyFormatCollection'),
            'message' => 'Format deklaracji zakładu jest niepoprawny'
        ))
        //collection4
        ->allowEmptyString('collection4')
        ->add('collection4', 'isProperlyFormatCollection', array(
            'rule' => array($this, 'isProperlyFormatCollection'),
            'message' => 'Format deklaracji zakładu jest niepoprawny'
        ))
        //collection5
        ->allowEmptyString('collection5')
        ->add('collection5', 'isProperlyFormatCollection', array(
            'rule' => array($this, 'isProperlyFormatCollection'),
            'message' => 'Format deklaracji zakładu jest niepoprawny'
        ))
        //collection6
        ->allowEmptyString('collection6')
        ->add('collection6', 'isProperlyFormatCollection', array(
            'rule' => array($this, 'isProperlyFormatCollection'),
            'message' => 'Format deklaracji zakładu jest niepoprawny'
        ))
        //collection7
        ->allowEmptyString('collection7')
        ->add('collection7', 'isProperlyFormatCollection', array(
            'rule' => array($this, 'isProperlyFormatCollection'),
            'message' => 'Format deklaracji zakładu jest niepoprawny'
        ))
        //collection8
        ->allowEmptyString('collection8')
        ->add('collection8', 'isProperlyFormatCollection', array(
            'rule' => array($this, 'isProperlyFormatCollection'),
            'message' => 'Format deklaracji zakładu jest niepoprawny'
        ));
        return $validator;
    }
    
    public function isGameExists($check) {
        return array_key_exists($check, Configure::read('Config.Game'));
    }
    
    public function isProperlyDateBegin($check) {
        if($check == null) return false;
        if($check > $this->getData('date_end')) return false;
        return true;
    }
    
    public function isProperlyDateEnd($check) {
        if($check == null) return false;
        if($check < $this->getData('date_begin')) return false;
        return true;
    }
    
    public function isProperlyFormatCollection($check) {
        if(empty($check)) return true;
        $games = Configure::read('Config.Game');
        if(array_key_exists($this->getData('id_game'), $games) == false) return false;
        $check = preg_replace('/\s{2,}/i', ' ', trim($check));
        $array = explode(' ', $check);
        if(sizeof($array) != $games[$this->getData('id_game')]['numbersInCollection']) return false;
        $temporary = array();
        foreach($array as $number){
            if(ctype_digit(strval($number)) == false) return false;
            if((int)$number < 1 || (int)$number > $games[$this->getData('id_game')]['theGreatestNumber']) return false;
            $temporary[(int)$number] = '';
        }
        if(sizeof($temporary) != $games[$this->getData('id_game')]['numbersInCollection']) return false;
        return true;
    }
    
    protected function _execute(array $data): bool
    {
        if( (
            (isset($data['collection1']) && empty($data['collection1']) == false)
            ||
            (isset($data['collection2']) && empty($data['collection2']) == false)
            ||
            (isset($data['collection3']) && empty($data['collection3']) == false)
            ||
            (isset($data['collection4']) && empty($data['collection4']) == false)
            ||
            (isset($data['collection5']) && empty($data['collection5']) == false)
            ||
            (isset($data['collection6']) && empty($data['collection6']) == false)
            ||
            (isset($data['collection7']) && empty($data['collection7']) == false)
            ||
            (isset($data['collection8']) && empty($data['collection8']) == false)
        ) == false) return false;
        return true;
    }
}