<?php

namespace App\Controller;

use Cake\Core\Configure;
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
                
                //TODO teraz
                //przy pustym formularzu, id_game blokuje formularz
                
                
                
                
                $this->myFlashSuccess(Configure::read('Config.Messages.TicketRegisterSucess'));
                //return $this->redirect(array('action' => 'ticket', $ticket->id));
            }
            catch (Exception $e)
            {
                $this->myFlashError($e, Configure::read('Config.Messages.Failed'));
            }
        }
        else
        {
            
        }
    }
}