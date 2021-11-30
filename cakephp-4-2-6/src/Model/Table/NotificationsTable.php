<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class NotificationsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setPrimaryKey('id');
        $this->setTable('notifications');
    }
}