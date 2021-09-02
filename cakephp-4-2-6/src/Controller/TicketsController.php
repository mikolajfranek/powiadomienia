<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Datasource\FactoryLocator;
use Cake\Event\EventInterface;
use Exception;
use App\Form\TicketForm;

class TicketsController extends AppController
{  
    protected function sortCollection($collectionString)
    {
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
        try
        {
            if ($this->request->is('post'))
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
                if($countActive > 9)
                {
                    throw new Exception('Config.Messages.LimitAmountOfTickets');
                }
                $ticket->id_game = $data['id_game'];
                $ticket->id_user = $this->user['id'];
                $ticket->date_begin = date('Y-m-d H:i:s',strtotime($data['date_begin']));
                $ticket->date_end = date('Y-m-d H:i:s',strtotime($data['date_end']));
                $ticket->numbers = json_encode($numbers);
                if ($tickets->save($ticket) == false) 
                {
                    throw new Exception();
                }
                $this->myFlashSuccess(Configure::read('Config.Messages.TicketRegisterSucess'));
                return $this->redirect(array('action' => 'register', $ticket->id));
            }
            else
            {
                if($id != null)
                {
                    $tickets = FactoryLocator::get('Table')->get('Tickets');
                    $ticket = $tickets->find()
                        ->where(array('id' => $id, 'id_user' => $this->user['id']))
                        ->first();
                    if($ticket != null) 
                    {
                        $this->set('selectedGameId', $ticket->id_game);
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
                    }
                }
                else
                {
                    $game = $this->request->getQuery('game');
                    if(array_key_exists($game, Configure::read('Config.Games'))){
                        $this->set('selectedGameId', $game);
                    }
                }
            }
        }
        catch (Exception $e)
        {
            $this->myFlashError($e, Configure::read('Config.Messages.Failed'));
        }
    }

    public function delete($id)
    {
        $this->request->allowMethod(['post']);
        $this->autoRender = false;
        try
        {
            $tickets = FactoryLocator::get('Table')->get('Tickets');
            $ticket = $tickets->find()
                ->where(array('id' => $id, 'id_user' => $this->Auth->user()['id']))
                ->first();
            if($ticket != null) 
            {                
                if($tickets->delete($ticket) == false) throw new Exception(Configure::read('Config.Messages.CannotDeleteTicket'));
                $this->myFlashSuccess(Configure::read('Config.Messages.DeleteTicketSuccess'));
            }
        }
        catch (Exception $e)
        {
            $this->myFlashError($e, Configure::read('Config.Messages.Failed'));
        }
        return $this->redirect(array('controller' => 'users', 'action' => 'tickets'));
    }
}