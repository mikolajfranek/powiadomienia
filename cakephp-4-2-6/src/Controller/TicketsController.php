<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\EventInterface;
use Exception;
use App\Form\TicketForm;

class TicketsController extends AppController
{  
    public function register()
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
                
                //TODO ticket form i tutaj
                
                
                
                
                
                
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