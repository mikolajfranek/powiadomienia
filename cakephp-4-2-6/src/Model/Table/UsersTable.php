<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setPrimaryKey('id');
        $this->setTable('users');
    }
    
    public function findAuth(Query $query, array $options)
    {
        $query->where(['Users.is_email_confirmation' => 1]);
        return $query;
    }
}