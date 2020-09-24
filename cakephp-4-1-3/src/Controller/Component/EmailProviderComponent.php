<?php

namespace App\Controller\Component;

use Cake\Auth\DigestAuthenticate;
use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Mailer\Mailer;
use Cake\Routing\Router;

class EmailProviderComponent extends Component {
    
    public function sendAboutRegistration($user){
        $mailer = new Mailer('default');
        $mailer
            ->setTo($user->email)
            ->setBcc(Configure::read('Config.Email.admin'))
            ->setSubject('['. (date('Y-m-d', time())) . '] Rejestracja')
            ->setEmailFormat('html');    
        $hash = DigestAuthenticate::password($user->login, ($user->id . $user->login . $user->email), env('SERVER_NAME'));
        $url =  Router::fullBaseUrl() . '/users/activate/' . $user->id . '/' . $hash;
        $mailer->deliver(
            '<h3>Witaj ' . $user->login . ' w serwisie ' . Configure::read('Config.WebName') . '!</h3>' .
            '<p>Oto link aktywujący Twoje konto <a href="'. $url .'">'. $url .'</a>.</p>'
        );
    }
    
    public function sendAboutChangeEmail($user){
        $mailer = new Mailer('default');
        $mailer
            ->setTo($user->email)
            ->setSubject('['. (date('Y-m-d', time())) . '] Odblokowanie dostępu')
            ->setEmailFormat('html');
        $hash = DigestAuthenticate::password($user->login, ($user->id . $user->login . $user->email), env('SERVER_NAME'));
        $url =  Router::fullBaseUrl() . '/users/activate/' . $user->id . '/' . $hash;
        $mailer->deliver(
            '<h3>Witaj ' . $user->login . '!</h3>' .
            '<p>Oto link odblokowujący Twoje konto <a href="'. $url .'">'. $url .'</a>.</p>'
            );
    }
    
    
    
    
    
    
    
    
    
    
    //TODO
    
    
    public function sendNotification($email, $results, $nameOfGame){
        $mailer = new Mailer('default');
        $mailer
            ->setTo($email)
            ->setSubject('['. (date('Y-m-d', time())) . '][' . $nameOfGame . '] ' . (empty($results['wins']) == false ? "Wygrałeś - najlepsze trafienie to " . $results['winLevel'] : "Przegrałeś"))
            ->setEmailFormat('html');
        $content = '<p>' . $nameOfGame . ' oraz Twoje wyniki.</p><br/>';
        if(empty($results['wins']) == false){
            $content .= "<p>Zwycięskie zakłady:</p>";
            foreach($results['wins'] as $item){
                $content .= '<p>Zakład ' . $item['collection'] .  ' trafił "' . $item['winning_amount']  . '" (' .  $item['winning_numbers']  . ') w losowaniu ' . $item['lottery_numbers'] . '</p>';
            }
        }
        if(empty($results['loses']) == false){
            $content .= "<p>Przegrane zakłady:</p>";
            foreach($results['loses'] as $item){
                $content .= '<p>Zakład ' . $item['collection'] .  ' trafił "' . $item['winning_amount']  . '" (' .  $item['winning_numbers']  . ') w losowaniu ' . $item['lottery_numbers'] . '</p>';
            }
        }
        $mailer->deliver($content);
    }
    
    public function sendMessageToAdmin($title, $message){
        
        $mailer = new Mailer('default');
        $mailer
            ->setTo(Configure::read('Config.Email.admin'))
            ->setSubject('['. (date('Y-m-d', time())) . '] ' . $title)
            ->setEmailFormat('html');
        $mailer->deliver($message);
    }
}