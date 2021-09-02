<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class DeleteTicketForm extends Form
{
    protected function _buildSchema(Schema $schema): Schema
    {
        return $schema;
    }
    
    public function validationDefault(Validator $validator): Validator
    {
        return $validator;
    }
}