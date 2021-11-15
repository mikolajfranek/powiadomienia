<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\Core\Configure;

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
            ->notEmptyString('id_game', Configure::read('Config.Validations.CannotBeEmpty'))
            ->add('id_game', 'game_exists', array(
                'rule' => array($this, 'isGameExists'),
                'message' => Configure::read('Config.Validations.GameNotFound')
            ))
        //date_begin
            ->requirePresence('date_begin')
            ->notEmptyString('date_begin', Configure::read('Config.Validations.CannotBeEmpty'))
            ->add('date_begin', 'properly_date_begin', array(
                'rule' => array($this, 'isProperlyDateBegin'),
                'message' => Configure::read('Config.Validations.DateInvalid')
            ))
        //date_end
            ->requirePresence('date_end')
            ->notEmptyString('date_end', Configure::read('Config.Validations.CannotBeEmpty'))
            ->add('date_end', 'properly_date_end', array(
                'rule' => array($this, 'isProperlyDateEnd'),
                'message' => Configure::read('Config.Validations.DateInvalid')
            ))
        //collection1
            ->allowEmptyString('collection1')
            ->add('collection1', 'properly_format_collection', array(
                'rule' => array($this, 'isProperlyFormatCollection'),
                'message' => Configure::read('Config.Validations.NumbersOfTicketInvalid')
            ))
        //collection2
            ->allowEmptyString('collection2')
            ->add('collection2', 'properly_format_collection', array(
                'rule' => array($this, 'isProperlyFormatCollection'),
                'message' => Configure::read('Config.Validations.NumbersOfTicketInvalid')
            ))
        //collection3
            ->allowEmptyString('collection3')
            ->add('collection3', 'properly_format_collection', array(
                'rule' => array($this, 'isProperlyFormatCollection'),
                'message' => Configure::read('Config.Validations.NumbersOfTicketInvalid')
            ))
        //collection4
            ->allowEmptyString('collection4')
            ->add('collection4', 'properly_format_collection', array(
                'rule' => array($this, 'isProperlyFormatCollection'),
                'message' => Configure::read('Config.Validations.NumbersOfTicketInvalid')
            ))
        //collection5
            ->allowEmptyString('collection5')
            ->add('collection5', 'properly_format_collection', array(
                'rule' => array($this, 'isProperlyFormatCollection'),
                'message' => Configure::read('Config.Validations.NumbersOfTicketInvalid')
            ))
        //collection6
            ->allowEmptyString('collection6')
            ->add('collection6', 'properly_format_collection', array(
                'rule' => array($this, 'isProperlyFormatCollection'),
                'message' => Configure::read('Config.Validations.NumbersOfTicketInvalid')
            ))
        //collection7
            ->allowEmptyString('collection7')
            ->add('collection7', 'properly_format_collection', array(
                'rule' => array($this, 'isProperlyFormatCollection'),
                'message' => Configure::read('Config.Validations.NumbersOfTicketInvalid')
            ))
        //collection8
            ->allowEmptyString('collection8')
            ->add('collection8', 'properly_format_collection', array(
                'rule' => array($this, 'isProperlyFormatCollection'),
                'message' => Configure::read('Config.Validations.NumbersOfTicketInvalid')
            ));
        return $validator;
    }
    
    public function isGameExists($check) {
        if(empty($check) == true) return false;
        return array_key_exists($check, Configure::read('Config.Games'));
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
        if(empty($check) == true) return true;
        $games = Configure::read('Config.Games');
        $gameId = $this->getData('id_game');
        if(array_key_exists($gameId, $games) == false) return false;
        $game = $games[$gameId];
        $check = preg_replace('/\s{2,}/i', ' ', trim($check));
        $numbers = explode(' ', $check);
        if(sizeof($numbers) != $game['numbersInCollection']) return false;
        $temporary = array();
        foreach($numbers as $number){
            if(ctype_digit(strval($number)) == false) return false;
            if((int)$number < 1 || (int)$number > $game['theGreatestNumber']) return false;
            $temporary[(int)$number] = '';
        }
        if(sizeof($temporary) != $game['numbersInCollection']) return false;
        return true;
    }
}