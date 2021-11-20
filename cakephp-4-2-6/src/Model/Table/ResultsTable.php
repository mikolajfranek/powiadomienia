<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ResultsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setPrimaryKey('id');
        $this->setTable('results');
        $this->belongsTo('Emails')->setForeignKey('id_email');
        
        $this->addBehavior('Search.Search');
        
        $this->searchManager()
            ->value('id_game')
            ->value('amount_winning')
            ->add('numbers_of_user', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fields' => ['numbers_of_user']
            ]);
    }
}