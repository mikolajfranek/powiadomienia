<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class EmailsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setPrimaryKey('id');
        $this->setTable('emails');
    }
}