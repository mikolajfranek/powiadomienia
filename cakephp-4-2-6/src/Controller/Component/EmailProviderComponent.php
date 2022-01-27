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
            ->setSubject('['. (date('Y-m-d', time())) . '] Rejestracja')
            ->setEmailFormat('html');
        $hash = DigestAuthenticate::password($user->id, $user->date_registration, env('SERVER_NAME'));
        $url =  Router::fullBaseUrl() . '/users/activate/' . $user->id . '/' . $hash;
        $htmlContent = '<h4>Witaj ' . $user->name . ' w serwisie ' . Configure::read('Config.WebName') . '!</h4>';
        $htmlContent .= '<p>Oto link aktywujący Twoje konto <a href="'. $url .'">'. $url .'</a>.</p>';
        $mailer->deliver($htmlContent);
    }
    
    public function sendAboutReset($user, $newPassword)
    {
        $mailer = new Mailer('default');
        $mailer
            ->setTo($user->email)
            ->setSubject('['. (date('Y-m-d', time())) . '] Reset hasła')
            ->setEmailFormat('html');
        $htmlContent = '<h4>Witaj ' . $user->name . '!</h4>';
        $htmlContent .= '<p>Resetowanie hasła zakończyło się pomyślnie! Oto Twoje nowe hasło: <b>'. $newPassword .'</b>.</p>';
        $mailer->deliver($htmlContent);
    }
    
    public function sendAboutChangeEmail($user)
    {
        $mailer = new Mailer('default');
        $mailer
            ->setTo($user->email)
            ->setSubject('['. (date('Y-m-d', time())) . '] Zmiana adresu email')
            ->setEmailFormat('html');
        $hash = DigestAuthenticate::password($user->id, $user->date_registration, env('SERVER_NAME'));
        $url =  Router::fullBaseUrl() . '/users/activate/' . $user->id . '/' . $hash;
        $htmlContent = '<h4>Witaj ' . $user->name . '!</h4>';
        $htmlContent .= '<p>Oto link odblokowujący Twoje konto <a href="'. $url .'">'. $url .'</a>.</p>';
        $mailer->deliver($htmlContent);
    }
  
    public function sendNotification($user, $results, $nameOfGame, $idEmail)
    {
        $mailer = new Mailer('default');
        $mailer
            ->setTo($user->email)
            ->setSubject('['. (date('Y-m-d', time())) . '][' . $nameOfGame . '] ' . (empty($results['wins']) == false ? "Wygrałeś - najlepsze trafienie to " . $results['winLevel'] : "Przegrałeś"))
            ->setEmailFormat('html');
        $hash = DigestAuthenticate::password($user->id, $user->date_registration, env('SERVER_NAME'));
        $url =  Router::fullBaseUrl() . '/notifications/delivered/' . $user->id . '/' . $idEmail . '/' . $hash;
        $htmlContent = '<img width="0" height="0" alt="" src="'. $url .'"/>';
        $htmlContent .= '<h4>Witaj ' . $user->name . '!</h4>';
        $htmlContent .= '<h5>' . $nameOfGame . ' oraz Twoje wyniki.</h5><br/>';
        if(empty($results['wins']) == false)
        {
            $htmlContent .= '<h6>Zwycięskie zakłady:</h6>';
            foreach($results['wins'] as $item)
            {
                $htmlContent .= '<p>Zakład ' . $item['numbers_of_user'] . ' trafił "' . $item['amount_winning']  . '" (' .  $item['numbers_winning'] . ') w losowaniu ' . $item['numbers_lottery'] . '</p>';
            }
        }
        if(empty($results['loses']) == false)
        {
            if(empty($results['wins']) == false)
            {
                $htmlContent .= '<br/>';
            }
            $htmlContent .= '<h6>Przegrane zakłady:</h6>';
            foreach($results['loses'] as $item)
            {
                $htmlContent .= '<p>Zakład ' . $item['numbers_of_user'] . ' trafił "' . $item['amount_winning']  . '" (' .  $item['numbers_winning'] . ') w losowaniu ' . $item['numbers_lottery'] . '</p>';
            }
        }
        $mailer->deliver($htmlContent);
    } 
    
    public function sendMessageToAdmin($title, $message)
    {        
        $mailer = new Mailer('default');
        $mailer
            ->setTo(Configure::read('Config.AdminEmail'))
            ->setSubject('['. (date('Y-m-d', time())) . '] ' . $title)
            ->setEmailFormat('html');    
        $htmlContent = '<h4>Witaj!</h4>';
        $htmlContent .= '<p>' . $message . '</p>';
        $mailer->deliver($htmlContent);
    }
}