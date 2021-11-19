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
            ->value('numbers_of_user')
            ->add('search', 'Search.Callback', [
                'callback' => function (\Cake\ORM\Query $query, array $args, \Search\Model\Filter\Base $filter) {
                // Modify $query as required
                    
                }
            ]);
           
    }
}