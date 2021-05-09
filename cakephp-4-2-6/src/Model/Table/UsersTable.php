<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setPrimaryKey('id');
        $this->setTable('users');
    }
    
    //protected function _setPassword($value)
    //{
        //if (strlen($value)) {
            //return (new DefaultPasswordHasher())->hash($value);
        //}
    //}
}