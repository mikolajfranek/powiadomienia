<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class TicketForm extends Form
{
    protected function _buildSchema(Schema $schema): Schema
    {
        return $schema
            ->addField('id_game', 'integer');
    }
    
    public function validationDefault(Validator $validator): Validator
    {
        return $validator;
    }
}