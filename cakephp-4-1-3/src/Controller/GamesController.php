<?php

namespace App\Controller;

use Cake\Datasource\FactoryLocator;
use Cake\Core\Configure;

class GamesController extends AppController
{
    public function statistic(){
        $statistics = array(
            Configure::read('Config.GameToId.MiniLotto') => array(0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0),
            Configure::read('Config.GameToId.Lotto') => array(0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0),
            Configure::read('Config.GameToId.LottoAndLottoPlus') => array(0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0)
        );
        $results = FactoryLocator::get('Table')->get('Results');
        foreach($results->find()->where(array('id_user' => $this->Auth->user()['id']))->all() as $result){
            $statistics[$result['id_game']][$result['winning_amount']] += 1;
        }            
        $this->set('statistics', $statistics);
    }
    
    public function list(){}
    
    public function last(){
        $limit = 5;
        $emails = FactoryLocator::get('Table')->get('Emails');
        $lasts = array(
            Configure::read('Config.GameToId.MiniLotto') => $emails
                ->find()
                ->where(array('id_game' => Configure::read('Config.GameToId.MiniLotto'), 'id_user' => $this->Auth->user()['id']))
                ->order(array('id DESC'))
                ->limit($limit)
                ->all(),
            Configure::read('Config.GameToId.Lotto') => $emails
                ->find()
                ->where(array('id_game' => Configure::read('Config.GameToId.Lotto'), 'id_user' => $this->Auth->user()['id']))
                ->order(array('id DESC'))
                ->limit($limit)
                ->all(),
            Configure::read('Config.GameToId.LottoAndLottoPlus') => $emails
                ->find()
                ->where(array('id_game' => Configure::read('Config.GameToId.LottoAndLottoPlus'), 'id_user' => $this->Auth->user()['id']))
                ->order(array('id DESC'))
                ->limit($limit)
                ->all(),
        );
        $this->set('lasts', $lasts);
    }
}