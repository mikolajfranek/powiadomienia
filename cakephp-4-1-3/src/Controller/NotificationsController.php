<?php

namespace App\Controller;

use Cake\Core\Exception\Exception;
use Cake\Event\EventInterface;
use Cake\Log\Log;
use Cake\Core\Configure;
use Cake\Datasource\FactoryLocator;

class NotificationsController extends AppController
{

    

    public function delivered($userId, $emailId){
        $this->autoRender = false;
        date_default_timezone_set("Europe/Warsaw");
        try{
            $emails = FactoryLocator::get('Table')->get('Emails');
            $email = $emails->find()
                ->where(array('id' => $emailId, 'id_user' => $userId, 'delivered IS' => null))
                ->first();
            if($email != null) {
                $email->delivered = date('Y-m-d H:i:s', time());
                if ($emails->save($email) == false) {
                    throw new Exception('Nie udało się zaktualizować emailu.');
                }
            }
        }catch(Exception $e){
            Log::write('error', isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "");
            Log::write('error', isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "");
            Log::write('error', $e->getMessage());
            Log::write('error', $e->getTraceAsString());
        }finally{
            ob_clean();
            ob_start();
            echo "";
            ob_end_flush();
            exit;
        }
    }
    
    public function send(){

        try{
       
            
      
            
            
            
       
            
         
            
         

       
            
            
            
            
            
            
            
            

            //save in results table
            $results = FactoryLocator::get('Table')->get('Results');
            $entitiesResults = $results->newEntities($resultsToSave);
            $result = $results->saveMany($entitiesResults);
            if(count($resultsToSave) != count($result)){
                throw new Exception("Nie zapisano wszystkich kuponów w bazie danych.");
            }
            
            //send email about success of process
            $this->EmailProvider->sendMessageToAdmin("Success", "Cron działa, powiadomienia zostały wysłane.");
            
            
            
        }catch(Exception $e){
            Log::write('error', isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "");
            Log::write('error', isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "");
            Log::write('error', $e->getMessage());
            Log::write('error', $e->getTraceAsString());
            $this->EmailProvider->sendMessageToAdmin("Exception", $e->getMessage());
            ob_clean();
            ob_start();
            echo "Krytyczny błąd";
            ob_end_flush();
            exit;
        }
        ob_clean();
        ob_start();
        echo "Ok";
        ob_end_flush();
        exit;
    }
    

    
}