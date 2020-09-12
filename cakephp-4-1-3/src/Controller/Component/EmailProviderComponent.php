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
        $hash = DigestAuthenticate::password($user->login, ($user->login . $user->email), env('SERVER_NAME'));
        $url =  Router::fullBaseUrl() . '/users/activate/' . $user->id . '/' . $hash;
        $mailer->deliver(
            '<p>Witaj ' . $user->login . ' w serwisie ' . Configure::read('Config.WebName') . '!</p>' .
            '<p>Oto link aktywujący Twoje konto <a href="'. $url .'">'. $url .'</a>.</p>'
        );
    }
    
    public function sendAboutChangeEmail($user){
        $mailer = new Mailer('default');
        $mailer
            ->setTo($user->email)
            ->setSubject('['. (date('Y-m-d', time())) . '] Odblokowanie dostępu')
            ->setEmailFormat('html');
        $hash = DigestAuthenticate::password($user->login, ($user->login . $user->email), env('SERVER_NAME'));
        $url =  Router::fullBaseUrl() . '/users/activate/' . $user->id . '/' . $hash;
        $mailer->deliver(
            '<p>Witaj ' . $user->login . '!</p>' .
            '<p>Oto link odblokowujący Twoje konto <a href="'. $url .'">'. $url .'</a>.</p>'
            );
    }
    
    public function sendNotifications($message){
        
        $mailer = new Mailer('default');
        $mailer
            ->setTo(Configure::read('Config.Email.admin'))
            ->setSubject('['. (date('Y-m-d', time())) . ']')
            ->setEmailFormat('html');
        $mailer->deliver($message);
    }
}