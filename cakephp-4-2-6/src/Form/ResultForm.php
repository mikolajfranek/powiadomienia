<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class ResultForm extends Form
{
    protected function _buildSchema(Schema $schema): Schema
    {
        return $schema
            ->addField('id_game', 'integer')
            ->addField('winning_degree', 'integer')
            ->addField('numbers_filter', 'string');
    }
 
    public function validationDefault(Validator $validator): Validator
    {
        $validator
        //id_game
        ->allowEmptyString('id_game')
        ->add('id_game', 'game_exists', array(
            'rule' => array($this, 'isGameExists'),
            'message' => Configure::read('Config.Validations.GameNotFound')
        ));
        return $validator;
    }
    
    //TODO
    //filtr
    //napis ile rekordów jest aktualnie wyświetlane
    
    
    
    
    public function isGameExists($check) {
        return array_key_exists($check, Configure::read('Config.Games'));
    }
}