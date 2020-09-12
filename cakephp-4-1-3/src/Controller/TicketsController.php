<?php

namespace App\Controller;

use Cake\Datasource\FactoryLocator;
use App\Form\TicketForm;
use Cake\Core\Configure;

class TicketsController extends AppController
{
    public function ticket($id = null){
        $form = new TicketForm();
        if ($this->request->is('post')) {
           
        }
        if ($this->request->is('get')) {
            
        }
        $this->set('form', $form);
        $result = Configure::read('Config.Game');
        
        $games = array();
        foreach($result as $key => $game){
            $games[$key] = $game['name'];
        }
        $this->set('games', $games);
    }
    
    public function list(){
        $tickets = FactoryLocator::get('Table')->get('Tickets');
        $ticketsOfUser = $tickets->find()
            ->where(array('id_user' => $this->Auth->user()['id'], 
                'is_deleted' => false
            ))
            ->all();
        $this->set('ticketsOfUser', $ticketsOfUser);
    }
}