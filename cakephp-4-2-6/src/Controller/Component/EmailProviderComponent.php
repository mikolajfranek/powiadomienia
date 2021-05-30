<?php

namespace App\Controller\Component;

use Cake\Auth\DigestAuthenticate;
use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Mailer\Mailer;
use Cake\Routing\Router;

class EmailProviderComponent extends Component 
{
    public function sendAboutRegistration($user)
    {
        $mailer = new Mailer('default');
        $mailer
            ->setTo($user->email)
            ->setBcc(Configure::read('Config.AdminEmail'))
            ->setSubject(Configure::read('Config.WebName') . ' ['. (date('Y-m-d', time())) . '] Rejestracja')
            ->setEmailFormat('html');
        $hash = DigestAuthenticate::password($user->email, $user->password, env('SERVER_NAME'));
        $url =  Router::fullBaseUrl() . '/users/activate/' . $user->id . '/' . $hash;
        $htmlContent = '<h4>Witaj w serwisie ' . Configure::read('Config.WebName') . '!</h4>';
        $htmlContent .= '<p>Oto link aktywujący Twoje konto <a href="'. $url .'">'. $url .'</a>.</p>';
        $mailer->deliver($htmlContent);
    }
    
    public function sendAboutReset($user, $newPassword)
    {
        $mailer = new Mailer('default');
        $mailer
            ->setTo($user->email)
            ->setSubject(Configure::read('Config.WebName') . ' ['. (date('Y-m-d', time())) . '] Reset hasła')
            ->setEmailFormat('html');
        $htmlContent = '<h4>Resetowanie hasła zakończyło się pomyślnie!</h4>';
        $htmlContent .= '<p>Oto Twoje nowe hasło: <b>'. $newPassword .'</b>.</p>';
        $mailer->deliver($htmlContent);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function sendAboutChangeEmail($user){
        $mailer = new Mailer('default');
        $mailer
            ->setTo($user->email)
            ->setSubject(Configure::read('Config.WebName') . ' ['. (date('Y-m-d', time())) . '] Odblokowanie dostępu')
            ->setEmailFormat('html');
        $hash = DigestAuthenticate::password($user->login, ($user->id . $user->login . $user->email), env('SERVER_NAME'));
        $url =  Router::fullBaseUrl() . '/users/activate/' . $user->id . '/' . $hash;
        $mailer->deliver(
            '<h3>Witaj ' . $user->login . '!</h3>' .
            '<p>Oto link odblokowujący Twoje konto <a href="'. $url .'">'. $url .'</a>.</p>'
            );
    }
    
    public function sendMessageToAdmin($title, $message){        
        $mailer = new Mailer('default');
        $mailer
            ->setTo(Configure::read('Config.Email.admin'))
            ->setSubject(Configure::read('Config.WebName') . ' ['. (date('Y-m-d', time())) . '] ' . $title)
            ->setEmailFormat('html');
        $mailer->deliver('<p>' . $message . '</p>');
    }
    
    public function sendNotification($user, $results, $nameOfGame, $emailId){
        $mailer = new Mailer('default');
        $mailer
            ->setTo($user['email'])           
            ->setSubject(Configure::read('Config.WebName') . ' ['. (date('Y-m-d', time())) . '][' . $nameOfGame . '] ' . (empty($results['wins']) == false ? "Wygrałeś - najlepsze trafienie to " . $results['winLevel'] : "Przegrałeś"))
            ->setEmailFormat('html');
       
        $url =  Router::fullBaseUrl() . '/notifications/delivered/' . $user['id'] . '/' . $emailId;
        $content = "<img width='0' height='0' alt='' src='". $url ."'/>";
        $content .= '<h3>Witaj ' . $user['login'] . '!</h3>' . '<p>' . $nameOfGame . ' oraz Twoje wyniki.</p><br/>';        
        if(empty($results['wins']) == false){
            $content .= "<p>Zwycięskie zakłady:</p>";
            foreach($results['wins'] as $item){
                $content .= '<p>Zakład ' . $item['collection'] .  ' trafił "' . $item['winning_amount']  . '" (' .  $item['winning_numbers']  . ') w losowaniu ' . $item['lottery_numbers'] . '</p>';
            }
        }
        if(empty($results['loses']) == false){
            if(empty($results['wins']) == false){
                $content .= "<br/>";
            }
            $content .= "<p>Przegrane zakłady:</p>";
            foreach($results['loses'] as $item){
                $content .= '<p>Zakład ' . $item['collection'] .  ' trafił "' . $item['winning_amount']  . '" (' .  $item['winning_numbers']  . ') w losowaniu ' . $item['lottery_numbers'] . '</p>';
            }
        }
        $mailer->deliver($content);
    }  
}