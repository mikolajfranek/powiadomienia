<?php

namespace App\Controller;

use Cake\Datasource\FactoryLocator;
use Cake\Log\Log;
use App\Form\TicketForm;
use Cake\Core\Configure;
use Cake\Core\Exception\Exception;

class TicketsController extends AppController
{
    public function ticket($id = null){
        $this->set('game', null);
        $form = new TicketForm();
        if ($this->request->is('post')) {
            try{
                $data = $this->request->getData();
                if ($form->execute($data) == false) throw new Exception('Wystąpił błąd w przetwarzaniu formularza rejestracji kuponu.');
                if(((isset($data['collection1']) && empty($data['collection1']) == false) || (isset($data['collection2']) && empty($data['collection2']) == false) || (isset($data['collection3']) && empty($data['collection3']) == false) || (isset($data['collection4']) && empty($data['collection4']) == false) || (isset($data['collection5']) && empty($data['collection5']) == false) || (isset($data['collection6']) && empty($data['collection6']) == false) || (isset($data['collection7']) && empty($data['collection7']) == false) || (isset($data['collection8']) && empty($data['collection8']) == false) ) == false) {
                    throw new Exception('Do zarejestrowania kuponu wymagana jest deklaracja minimalnie jednego zakładu.');
                }
                $numbers = array();
                if((isset($data['collection1']) && empty($data['collection1']) == false)) $numbers[] = $this->sortCollection($data['collection1']);
                if((isset($data['collection2']) && empty($data['collection2']) == false)) $numbers[] = $this->sortCollection($data['collection2']);
                if((isset($data['collection3']) && empty($data['collection3']) == false)) $numbers[] = $this->sortCollection($data['collection3']);
                if((isset($data['collection4']) && empty($data['collection4']) == false)) $numbers[] = $this->sortCollection($data['collection4']);
                if((isset($data['collection5']) && empty($data['collection5']) == false)) $numbers[] = $this->sortCollection($data['collection5']);
                if((isset($data['collection6']) && empty($data['collection6']) == false)) $numbers[] = $this->sortCollection($data['collection6']);
                if((isset($data['collection7']) && empty($data['collection7']) == false)) $numbers[] = $this->sortCollection($data['collection7']);
                if((isset($data['collection8']) && empty($data['collection8']) == false)) $numbers[] = $this->sortCollection($data['collection8']);
                $tickets = FactoryLocator::get('Table')->get('Tickets');
                $ticket = $tickets->newEmptyEntity();
                if($id != null){
                    $count = $tickets->find()
                        ->where(array('id' => $id, 'id_user' => $this->Auth->user()['id']))
                        ->count('*');
                    if($count == 1) {
                        $ticket->id = $id;
                    }else{
                        $this->Flash->error('Nie znaleziono kuponu.');
                        $this->redirect(array('action' => 'ticket'));
                    }
                }
                $ticket->id_game = $data['id_game'];
                $ticket->id_user = $this->Auth->user()['id'];
                $ticket->date_begin = $data['date_begin'];
                $ticket->date_end = $data['date_end'];
                $ticket->numbers = json_encode($numbers);
                $ticket->is_deleted = false;
                if ($tickets->save($ticket) == false) {
                    throw new Exception('Nie udało się zapisać kuponu.');
                }
                $this->Flash->success('Pomyślnie zarejestrowano kupon.');
                return $this->redirect(array('action' => 'ticket', $ticket->id));
            }catch(Exception $e){
                Log::write('error', isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "");
                Log::write('error', isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "");
                Log::write('error', $e->getMessage());
                Log::write('error', $e->getTraceAsString());
                $this->Flash->error(empty($e->getMessage()) ? 'Wystąpił błąd w wysyłaniu formularza, spóbuj ponownie.' : $e->getMessage());
            }
        }
        if ($this->request->is('get')) {
            if($id != null){
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
            }else{
                $game = $this->request->getQuery('game');
                if(array_key_exists($game, Configure::read('Config.Game'))){
                    $this->set('game', $game);
                }
            }
        }
        $this->set('form', $form);
    }
    
    protected function sortCollection($collectionString){
        $array = explode(' ', $collectionString);
        sort($array);
        return trim(implode(" ", $array));
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