<?php

namespace App\Controller;

use Cake\Auth\DigestAuthenticate;
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
        $this->request->allowMethod(['put']);
        $this->autoRender = false;
        try
        {
            //critical section
            $syncFile = fopen("sync_file", 'r');
            $notificationsId = null;
            $notifications = FactoryLocator::get('Table')->get('Notifications');
            try
            {
                //hour
                $todayHour = date('H:i:s');
                if($todayHour < '23:00:00')
                {
                    throw new \InvalidArgumentException();   
                }
                //ip
                $ip = trim($this->request->clientIp());
                if(in_array($ip, Configure::read('Config.Localhost')) == false) throw new \InvalidArgumentException(Configure::read('Config.Messages.UnknowHost') . ' (' . $ip . ')');
                //check amount of notifications send  
                if (flock($syncFile, LOCK_EX)) 
                {   
                    try
                    {   
                        $today = date('Y-m-d');
                        $notification = $notifications->find()
                            ->where(array('date' => $today))
                            ->first();
                        if($notification != null)
                        {
                            throw new \InvalidArgumentException();  
                        }
                        $newOne = $notifications->newEmptyEntity();
                        $newOne->date = $today;
                        if ($notifications->save($newOne) == false) throw new Exception();  
                        $notificationsId = $newOne->id;
                    }
                    finally
                    {
                        flock($syncFile, LOCK_UN);
                    }
                }
                else 
                {
                    throw new \InvalidArgumentException();  
                }
            }
            finally
            {
                fclose($syncFile);
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
                    'CAST(Tickets.date_begin as date) <= CAST(CURDATE() as date)',
                    'CAST(Tickets.date_end as date) >= CAST(CURDATE() as date)',
                    'Users.date_email_confirmation IS NOT NULL',
                    'Users.is_blocked' => false
                ])
                ->contain(['Users']);
            if($activeTickets->count() == 0) throw new \InvalidArgumentException(Configure::read('Config.Messages.NoneOfActiveTickets'));
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
                $url = Configure::read('Config.NotificationsUrl') . Configure::read('Config.Games')[$idGame]['queryParameter'];
                $content = file_get_contents($url);
                if(empty($content)) throw new Exception(Configure::read('Config.Messages.CannotDownloadResults'));
                $lastLotteryDate = $this->getLastLotteryDate($idGame);
                $content = explode("\n", trim($content, "\n"));
                if($lastLotteryDate == null || $content[0] != $lastLotteryDate) throw new Exception(Configure::read('Config.Messages.InvalidDayOfLottery'));
                unset($content[0]);
                $gameResults[$idGame] = $content;
            }
            //compare results and sending email
            $emails = FactoryLocator::get('Table')->get('Emails');
            $resultsToSave = array();
            foreach($gameResults as $idGame => $winnerNumbers)
            {
                foreach($gameTickets[$idGame] as $idUser => $tickets)
                {
                    $idEmail = null;
                    if($users[$idUser]['is_email_notification'] == true)
                    {
                        try
                        {
                            $email = $emails->newEmptyEntity();
                            $email->id_game = $idGame;
                            $email->id_user = $idUser;
                            $email->email = $users[$idUser]['email'];
                            if ($emails->save($email) == false) throw new Exception();
                            $idEmail = $email->id;
                        }
                        catch (Exception $e)
                        {
                            $this->myLogger($e);
                        }
                    }
                    $compare = $this->compareResultWithTicketsOfUser(Configure::read('Config.Games')[$idGame]['numbersToWin'], $winnerNumbers, $tickets, $idEmail);
                    $resultsToSave = array_merge($resultsToSave, $compare['wins'], $compare['loses']);
                    if($idEmail != null)
                    {
                        try
                        {
                            $this->EmailProvider->sendNotification($users[$idUser], $compare, Configure::read('Config.Games')[$idGame]['nameStatistic'], $idEmail);                            
                            $email = $emails->find()
                                ->where(array('id' => $idEmail))
                                ->first();
                            if($email != null)
                            {
                                $email->date_sent = date('Y-m-d H:i:s', time());
                                if ($emails->save($email) == false) throw new Exception();
                            }
                        }
                        catch (Exception $e)
                        {
                            $this->myLogger($e);
                        }
                    }
                }
            }
            //save in results table
            $results = FactoryLocator::get('Table')->get('Results');
            $entitiesResults = $results->newEntities($resultsToSave);
            if(count($results->saveMany($entitiesResults)) != count($resultsToSave)) throw new Exception();
            //save flag success
            if($notificationsId != null)
            {
                $notification = $notifications->find()
                    ->where(array('id' => $notificationsId))
                    ->first();
                $notification->success = 1;
                if ($notifications->save($notification) == false) throw new Exception();
            }
        }
        catch (\InvalidArgumentException $e)
        {
            $this->myLogger($e);
        }
        catch (Exception $e)
        {
            $this->myLogger($e);
            try
            {
                $this->EmailProvider->sendMessageToAdmin("Exception", $e->getMessage());
            }
            catch(Exception $e)
            {
                //nothing
            }
        }
        finally
        {
            ob_clean();
            ob_start();
            ob_end_flush();
            exit;
        }
    }
    
    public function delivered($idUser, $idEmail, $inputHash)
    {
        $this->request->allowMethod(['get']);
        $this->autoRender = false;
        try
        {
            $users = FactoryLocator::get('Table')->get('Users');
            $user = $users->find()
                ->where(array('id' => $idUser))
                ->first();
            if($user == null) throw new Exception(Configure::read('Config.Messages.UserNotFound'));
            $hash = DigestAuthenticate::password($user->id, $user->date_registration, env('SERVER_NAME'));
            if($inputHash != $hash) throw new Exception(Configure::read('Config.Messages.UserNotFound'));
            $emails = FactoryLocator::get('Table')->get('Emails');
            $email = $emails->find()
                ->where(array('id' => $idEmail, 'id_user' => $idUser, 'date_delivered IS NULL'))
                ->first();
            if($email != null) 
            {
                $email->date_delivered = date('Y-m-d H:i:s', time());
                if ($emails->save($email) == false) throw new Exception();
            }
        }
        catch (Exception $e)
        {
            $this->myLogger($e);
        }
        finally
        {
            ob_clean();
            ob_start();
            ob_end_flush();
            exit;
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