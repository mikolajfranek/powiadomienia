<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Datasource\FactoryLocator;
use Cake\Event\EventInterface;
use Exception;
use App\Form\TicketForm;

class TicketsController extends AppController
{  
    protected function sortCollection($collectionString){
        $array = explode(' ', $collectionString);
        sort($array);
        return trim(implode(" ", $array));
    }
    
    public function register($id = null)
    {
        $this->request->allowMethod(['get', 'post']);
        $form = new TicketForm();
        $this->set('form', $form);
        $menuside = Configure::read('Config.MenuSide');
        $menuside['TicketsRegister'] = true;
        $this->set('menuside',$menuside);
        
        
        $this->set('selectedGameId', null);
        //???
        
        
        if ($this->request->is('post'))
        {
            try
            {
                $data = $this->request->getData();
                if ($form->execute($data) == false) throw new Exception();
                $numbers = array();
                $emptyElements = 0;
                for($i = 1; $i < 9; $i++)
                {
                    if(empty($data['collection' . $i]) == true)
                    {
                        $emptyElements += 1;
                    }
                    else
                    {
                        $numbers[] = $this->sortCollection($data['collection' . $i]);
                    }
                }
                if($emptyElements == 8) throw new Exception(Configure::read('Config.Messages.CannotRegisterEmptyTicket'));
                $tickets = FactoryLocator::get('Table')->get('Tickets');
                $ticket = $tickets->newEmptyEntity();
                if($id != null)
                {
                    $count = $tickets->find()
                        ->where(array('id' => $id, 'id_user' => $this->user['id']))
                        ->count('*');
                    if($count == 1) 
                    {
                        $ticket->id = $id;
                    }
                    else
                    {
                        $this->myFlashError(null, Configure::read('Config.Messages.CannotFindTicket'));
                        return $this->redirect(array('action' => 'register'));
                    }
                }
                $countActive = $tickets->find()
                    ->where(array('id_user' => $this->user['id']))
                    ->count('*');
                if($countActive > 4)
                {
                    throw new Exception('Config.Messages.LimitAmountOfTickets');
                }
                $ticket->id_game = $data['id_game'];
                $ticket->id_user = $this->user['id'];
                $ticket->date_begin = $data['date_begin'];
                $ticket->date_end = $data['date_end'];
                $ticket->numbers = json_encode($numbers);
                if ($tickets->save($ticket) == false) 
                {
                    throw new Exception();
                }
                $this->myFlashSuccess(Configure::read('Config.Messages.TicketRegisterSucess'));
                return $this->redirect(array('action' => 'register', $ticket->id));
            }
            catch (Exception $e)
            {
                $this->myFlashError($e, Configure::read('Config.Messages.Failed'));
            }
        }
        else
        {
            
            
            
            if($id != null)
            {
                
            }
            else
            {
                $game = $this->request->getQuery('id_game');
                debug($game);
                
            }
            
            
            
        }
    }
}