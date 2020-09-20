<?php

namespace App\Controller;

use Cake\Core\Exception\Exception;
use Cake\Event\EventInterface;
use Cake\Core\Configure;
use Cake\Datasource\FactoryLocator;
use Cake\Log\Log;

class NotificationsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('EmailProvider');
    }
    
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['send']);
    }

    private function getLastLotteryDate($idGame){
        switch($idGame){
            case Configure::read('Config.GameToId.MiniLotto'):
                return date('Y-m-d',  time());
            case Configure::read('Config.GameToId.Lotto'):
            case Configure::read('Config.GameToId.LottoAndLottoPlus'):
                $dayOfWeek = date('D', time());
                switch($dayOfWeek){
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
   
    private function compareResultWithTicketsOfUser($numbersToWin, $winnerNumbers, $tickets){
        $compare = array(
            'wins' => array(),
            'loses' => array(),
            'winLevel' => 0
        );
        $results = FactoryLocator::get('Table')->get('Results');
        foreach($tickets as $ticket){
            foreach(json_decode($ticket->numbers) as $numbers){
                $numbers = explode(' ', $numbers);
                $wins = array_intersect($winnerNumbers, $numbers);
                $winLevel = count($wins);
                if($winLevel > $compare['winLevel']){
                    $compare['winLevel'] = $winLevel;
                }
                $type = ($winLevel >= $numbersToWin) ? 'wins' : 'loses';
                sort($numbers);
                sort($winnerNumbers);
                sort($wins);
                $result = array();
                $result['id_game'] = $ticket->id_game;
                $result['id_user'] = $ticket->id_user;
                $result['lottery_date'] = date('Y-m-d',  time());
                $result['lottery_numbers'] = implode(';', $winnerNumbers);
                $result['collection'] = implode(';', $numbers);
                $result['winning_numbers'] =  implode(';', $wins);
                $result['winning_amount'] = $winLevel;
                $compare[$type][] = $result;   
            }
        }
        return $compare;
    }
    
    public function send(){
        $this->autoRender = false;
        try{
            //ip
            $ip = $this->request->clientIp();
            if(in_array($ip, Configure::read('Config.Localhost')) == false){
                throw new Exception('Nieznany adres IP ' . $ip . ', wywołujący rozsyłkę powiadomień.');
            }
           
            //active games
            $activeGames = array();
            foreach(Configure::read('Config.Game') as $id => $game){
                if(in_array(date('N'), $game['dayOfWeek'])){
                    $activeGames[] = $id;
                }
            }
            
            //active tickets
            $ticketsOfUser = FactoryLocator::get('Table')->get('Tickets');
            $activeTickets = $ticketsOfUser->find('all')     
                ->where(array(
                    'Tickets.id_game IN' => $activeGames,
                    'Tickets.is_deleted' => 0,
                    'Tickets.date_begin <= CAST(CURDATE() as date)',
                    'Tickets.date_end >= CAST(CURDATE() as date)',
                    'Users.is_account_active' => 1,
                    'Users.is_email_confirmation' => 1,
                    'Users.is_email_notification' => 1,
                ))
                ->contain(['Users']);
            if($activeTickets->count() == 0){
                throw new Exception("Brak aktywnych kuponów");    
            }
            
            //prepare variables before download results
            $gameTickets = array();
            foreach ($activeTickets as $ticket) {
                $gameTickets[$ticket['id_game']][$ticket['id_user']][] = $ticket;
                if($ticket['id_game'] == Configure::read('Config.GameToId.LottoAndLottoPlus')){
                    $ticket['id_game'] = Configure::read('Config.GameToId.Lotto');
                    $gameTickets[$ticket['id_game']][$ticket['id_user']][] = $ticket;
                }
            }

            //download results
            $gameResults = array();
            foreach(array_keys($gameTickets) as $idGame){
                $url = Configure::read('Config.Notifications.url') . Configure::read('Config.Game')[$idGame]['shortcut'];
                $content = file_get_contents($url);
                if(empty($content)) throw new Exception("Nie pobrano wyników loterii.");
                $lastLotteryDate = $this->getLastLotteryDate($idGame);
                $content = explode("\n", trim($content, "\n"));
                //if($lastLotteryDate == null || $content[0] != $lastLotteryDate){
                    //throw new Exception("Dzień loterii jest nieprawidłowy.");
                //}
                unset($content[0]);
                $gameResults[$idGame] = $content;
            }
            
            //compare results and sending email
            $resultsToSave = array();
            foreach($gameResults as $idGame => $winnerNumbers){
                foreach($gameTickets[$idGame] as $ticketsOfUser){
                    $results = $this->compareResultWithTicketsOfUser(Configure::read('Config.Game')[$idGame]['numbersToWin'], $winnerNumbers, $ticketsOfUser);
                    $resultsToSave = array_merge($resultsToSave, $results['wins'], $results['loses']);
                    
                    
                    //if($this->EmailProvider->notifications($games[$game_id], $users[$user_id], $winnerNumbers, $win_numbers, $this->language) == false){
                        //throw new Exception(Configure::read("AppConfig.Web." . $this->language . ".controller_notifications_failure_notsent"));
                    //}
                }
            }
            
            //save in results table
            $results = FactoryLocator::get('Table')->get('Results');
            $entities = $results->newEntities($resultsToSave);
            $result = $results->saveMany($entities);
            if(count($resultsToSave) != count($result)){
                throw new Exception("Nie zapisano wszystkich kuponów w bazie danych.");
            }
         
            
            
            
        
            //send email about success of process
            //$this->EmailProvider->sendNotifications("Cron działa");
            
        }catch(Exception $e){
            Log::write('error', $e->getMessage());
            Log::write('error', $e->getTraceAsString());
            //$this->EmailProvider->sendNotifications($e->getMessage());
            ob_start();
            echo "Krytyczny błąd - wyrzuony " . $e->getMessage();
            ob_end_flush();
            exit;
        }
        ob_start();
        echo "Ok";
        ob_end_flush();
        exit;
    }
}