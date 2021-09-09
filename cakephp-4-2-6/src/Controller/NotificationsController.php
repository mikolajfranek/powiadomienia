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
            foreach(Configure::read('Config.Games') as $id => $game)
            {
                if(in_array(date('N'), $game['dayOfWeek']))
                {
                    $activeGames[] = $id;
                }
            }
            //active tickets
            $tickets = FactoryLocator::get('Table')->get('Tickets');
            $activeTickets = $tickets->find('all')
                ->where([
                    'Tickets.id_game IN' => $activeGames,
                    'Tickets.date_begin <= CAST(CURDATE() as date)',
                    'Tickets.date_end >= CAST(CURDATE() as date)',
                    'Users.is_account_active' => true,
                    'Users.is_email_confirmation' => true,
                    'Users.is_blocked' => false
                ])
                ->contain(['Users']);
            if($activeTickets->count() == 0)
            {
                throw new Exception(Configure::read('Config.Messages.NoneOfActiveTickets'));
            }
            //prepare variables before download results
            $gameTickets = array();
            $users = array();
            foreach ($activeTickets as $ticket) 
            {
                $users[$ticket->user['id']] = $ticket->user;
                $gameTickets[$ticket['id_game']][$ticket->user['id']][] = $ticket;
                if($ticket['id_game'] == Configure::read('Config.GameToId.LottoAndLottoPlus'))
                {
                    $additionalTicket = $tickets->newEntity($ticket->toArray());
                    $additionalTicket['id_game'] = Configure::read('Config.GameToId.Lotto');
                    $gameTickets[$additionalTicket['id_game']][$additionalTicket->user['id']][] = $additionalTicket;
                }
            }
            //download results
            $gameResults = array();
            foreach(array_keys($gameTickets) as $idGame)
            {
                $url = Configure::read('Config.NotificationsUrl') . Configure::read('Config.Game')[$idGame]['queryParameter'];
                $content = file_get_contents($url);
                if(empty($content)) 
                {
                    throw new Exception(Configure::read('Config.Messages.CannotDownloadResults'));
                }
                $lastLotteryDate = $this->getLastLotteryDate($idGame);
                $content = explode("\n", trim($content, "\n"));
                if($lastLotteryDate == null || $content[0] != $lastLotteryDate)
                {
                    throw new Exception(Configure::read('Config.Messages.InvalidDayOfLottery'));
                }
                unset($content[0]);
                $gameResults[$idGame] = $content;
            }
            
            
            
            
            
            
            //TODO
            
            //compare results and sending email
            $emails = FactoryLocator::get('Table')->get('Emails');
            $resultsToSave = array();
            foreach($gameResults as $idGame => $winnerNumbers)
            {
                foreach($gameTickets[$idGame] as $idUser => $tickets)
                {
                    $idEmail = null;
                    
                    
                    //zapisz email w bazie danych
                    //spróbuj wysłać
                    
                    $results = $this->compareResultWithTicketsOfUser(Configure::read('Config.Game')[$idGame]['numbersToWin'], $winnerNumbers, $tickets, $idEmail);
                    $resultsToSave = array_merge($resultsToSave, $results['wins'], $results['loses']);

                    
                    
                    
                    
                    
                    
                    
                    
                    if($users[$idUser]['is_email_notification'] == 1)
                    {
                        try{
                            $email = $emails->newEmptyEntity();
                            $email->id_game = $idGame;
                            $email->id_user = $idUser;
                            $email->address = $users[$idUser]['email'];
                            $email->content = (empty($results['wins']) == false ? "Wygrałeś" : "Przegrałeś")  . " - najlepsze trafienie to " . $results['winLevel'];
                            $email->lottery_date = date('Y-m-d', time());
                            if ($emails->save($email) == false) {
                                throw new Exception('Nie udało się zapisać emailu.');
                            }
                            $this->EmailProvider->sendNotification($users[$idUser], $results, Configure::read('Config.Game')[$idGame]['nameStatistic'], $email->id);
                            $email->sent = date('Y-m-d H:i:s', time());
                            if ($emails->save($email) == false) {
                                throw new Exception('Nie udało się zaktualizować emailu.');
                            }
                        }catch (Exception $e){
                            //log exception
                        }
                    }
                    
                    
                    
                    
                }
            }
            
            
            
            
        }
        catch (Exception $e)
        {
            $this->myFlashError($e, Configure::read('Config.Messages.Failed'));
        }
    }
    
    protected function getLastLotteryDate($idGame){
        switch($idGame)
        {
            case Configure::read('Config.GameToId.MiniLotto'):
                return date('Y-m-d',  time());
            case Configure::read('Config.GameToId.Lotto'):
            case Configure::read('Config.GameToId.LottoAndLottoPlus'):
                $dayOfWeek = date('D', time());
                switch($dayOfWeek)
                {
                    case 'Tue':
                    case 'Thu':
                    case 'Sat':
                        return date('Y-m-d', time());
                    case 'Mon':
                    case 'Sun':
                        return date('Y-m-d', strtotime('last Saturday'));
                    case 'Fri':
                        return date('Y-m-d', strtotime('last Thursday'));
                    case 'Wed':
                        return date('Y-m-d', strtotime('last Tuesday'));
                }
        }
        return null;
    }

    protected function compareResultWithTicketsOfUser($numbersToWin, $winnerNumbers, $tickets, $idEmail)
    {
        $lotteryDate = date('Y-m-d',  time());
        $compare = [
            'wins' => [],
            'loses' => [],
            'winLevel' => 0
        ];
        foreach($tickets as $ticket)
        {
            foreach(json_decode($ticket->numbers) as $numbers)
            {
                $numbers = explode(' ', $numbers);
                $wins = array_intersect($winnerNumbers, $numbers);
                $winLevel = count($wins);
                if($winLevel > $compare['winLevel'])
                {
                    $compare['winLevel'] = $winLevel;
                }
                $type = ($winLevel >= $numbersToWin) ? 'wins' : 'loses';
                sort($winnerNumbers);
                sort($numbers);
                sort($wins);
                $result = array();
                $result['id_game'] = $ticket->id_game;
                $result['id_user'] = $ticket->id_user;
                $result['id_email'] = $idEmail;
                $result['date_lottery'] = $lotteryDate;
                $result['numbers_lottery'] = implode(';', $winnerNumbers);
                $result['numbers_of_user'] = implode(';', $numbers);
                $result['numbers_winning'] =  implode(';', $wins);
                $result['amount_winning'] = $winLevel;
                $compare[$type][] = $result;
            }
        }
        return $compare;
    }
}