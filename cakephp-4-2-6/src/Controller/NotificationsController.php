<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Datasource\FactoryLocator;
use Cake\Event\EventInterface;
use Exception;

class NotificationsController extends AppController
{  
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['send', 'delivered']);
    }
    
    public function send()
    {
        $this->request->allowMethod(['get']);
        $this->autoRender = false;
        try
        {
            //ip
            $ip = trim($this->request->clientIp());
            if(in_array($ip, Configure::read('Config.Localhost')) == false)
            {
                throw new Exception(Configure::read('Config.Messages.UnknowHost') . ' (' . $ip . ')');
            }
            //active games
            $activeGames = array();
            foreach(Configure::read('Config.Games') as $id => $game){
                if(in_array(date('N'), $game['dayOfWeek'])){
                    $activeGames[] = $id;
                }
            }
            //active tickets
            $tickets = FactoryLocator::get('Table')->get('Tickets');
            $activeTickets = $tickets->find('all')
                ->where(array(
                    'Tickets.id_game IN' => $activeGames,
                    'Tickets.date_begin <= CAST(CURDATE() as date)',
                    'Tickets.date_end >= CAST(CURDATE() as date)',
                    'Users.is_account_active' => true,
                    'Users.is_email_confirmation' => true,
                    'Users.is_blocked' => false
                ))
                ->contain(['Users']);
            if($activeTickets->count() == 0)
            {
                throw new Exception(Configure::read('Config.Messages.NoneOfActiveTickets'));
            }
            
            
            
            
            //TODO
            
            
            //prepare variables before download results
            $gameTickets = array();
            $users = array();
            foreach ($activeTickets as ) 
            {
                $users[$ticket->user['id']] = $ticket->user;
                
                $gameTickets[$ticket['id_game']][$ticket->user['id']][] = $ticket;
                if($ticket['id_game'] == Configure::read('Config.GameToId.LottoAndLottoPlus')){
                    $additionalTicket = $tickets->newEntity($ticket->toArray());
                    $additionalTicket['id_game'] = Configure::read('Config.GameToId.Lotto');
                    $gameTickets[$additionalTicket['id_game']][$additionalTicket->user['id']][] = $additionalTicket;
                }
            }
            
            
            
        }
        catch (Exception $e)
        {
            $this->myFlashError($e, Configure::read('Config.Messages.Failed'));
        }
    }
}