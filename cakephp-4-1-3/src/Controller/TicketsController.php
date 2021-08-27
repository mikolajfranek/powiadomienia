<?php

namespace App\Controller;

use App\Form\TicketForm;
use Cake\Core\Configure;
use Cake\Core\Exception\Exception;
use Cake\Datasource\FactoryLocator;
use Cake\Log\Log;

class TicketsController extends AppController
{
 

    
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