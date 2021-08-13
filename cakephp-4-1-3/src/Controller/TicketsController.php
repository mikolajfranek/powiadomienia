<?php

namespace App\Controller;

use App\Form\TicketForm;
use Cake\Core\Configure;
use Cake\Core\Exception\Exception;
use Cake\Datasource\FactoryLocator;
use Cake\Log\Log;

class TicketsController extends AppController
{
    public function ticket($id = null){
        $this->set('game', null);
        $form = new TicketForm();
        
        
        
        
        
        
        
        
        
        if ($this->request->is('post')) {
            //done
        }
        if ($this->request->is('get')) {
            
            
            if($id != null)
            {
                
                $tickets = FactoryLocator::get('Table')->get('Tickets');
                $ticket = $tickets->find()
                    ->where(array('id' => $id, 'id_user' => $this->Auth->user()['id']))
                    ->first();
                if($ticket != null) {
                    $this->set('game', $ticket->id_game);
                    
                    $decoded = json_decode($ticket->numbers);
                    $form->setData([
                        'date_begin' => $ticket->date_begin,
                        'date_end' => $ticket->date_end,
                        'collection1' => isset($decoded[0]) ? $decoded[0] : '',
                        'collection2' => isset($decoded[1]) ? $decoded[1] : '',
                        'collection3' => isset($decoded[2]) ? $decoded[2] : '',
                        'collection4' => isset($decoded[3]) ? $decoded[3] : '',
                        'collection5' => isset($decoded[4]) ? $decoded[4] : '',
                        'collection6' => isset($decoded[5]) ? $decoded[5] : '',
                        'collection7' => isset($decoded[6]) ? $decoded[6] : '',
                        'collection8' => isset($decoded[7]) ? $decoded[7] : '',
                    ]);
                }else{
                    $this->Flash->error('Nie znaleziono kuponu.');
                    $this->redirect(array('action' => 'ticket'));
                }
            }
            else
            {
                //po co to było??
                
                $game = $this->request->getQuery('game');
                if(array_key_exists($game, Configure::read('Config.Game'))){
                    $this->set('game', $game);
                }
            }
            
            
            
        }
        $this->set('form', $form);
    }

    
    public function delete($id){
        $this->autoRender = false;
        if ($this->request->is('post')) {
            try{
                $tickets = FactoryLocator::get('Table')->get('Tickets');
                $ticket = $tickets->find()
                    ->where(array('id' => $id, 'id_user' => $this->Auth->user()['id']))
                    ->first();
                if($ticket != null) {
                    $ticket->is_deleted = 1;
                    if($tickets->save($ticket) == false) throw new Exception('Nie usunięto kuponu poprawnie.');
                }else{
                    $this->Flash->error('Nie znaleziono kuponu');
                }
            }catch(Exception $e){
                Log::write('error', isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "");
                Log::write('error', isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "");
                Log::write('error', $e->getMessage());
                Log::write('error', $e->getTraceAsString());
                $this->Flash->error(empty($e->getMessage()) ? 'Wystąpił błąd, spóbuj ponownie.' : $e->getMessage());
            }
        }
        return $this->redirect(array('action' => 'list'));
    }
    
    public function list(){
        $tickets = FactoryLocator::get('Table')->get('Tickets');
        $ticketsOfUser = $tickets->find()
            ->where(array('id_user' => $this->Auth->user()['id'], 'is_deleted' => false))
            ->all();
        $this->set('ticketsOfUser', $ticketsOfUser);
    }
}