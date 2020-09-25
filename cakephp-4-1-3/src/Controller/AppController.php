<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\EventInterface;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('FormProtection');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'login',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'users',
                'action' => 'login'
            ],
            'loginRedirect' => array(
                'controller' => 'pages',
                'action' => 'donate'
            ),
            'logoutRedirect' => array(
                'controller' => 'pages',
                'action' => 'donate',
            ),
            'unauthorizedRedirect' => $this->referer(),
            'authError' => 'Nie masz uprawnień dostępu do tej lokalizacji.'
        ]);
    }
    
    public function beforeRender($event){
        parent::beforeRender($event);
        $requestController = $this->request->getParam('controller');
        $requestAction = $this->request->getParam('action');
        if($requestController == 'Pages' && $requestAction == 'home'){
            $this->viewBuilder()->setLayout('mxtonz_slider');
        }else{
            $this->viewBuilder()->setLayout('mxtonz');
        }
    }
    
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $navigationBar = array();
        $requestController = $this->request->getParam('controller');
        $requestAction = $this->request->getParam('action');
        foreach(Configure::read('Config.NavigationBar') as $controller => $actions){
            foreach($actions as $action => $v){
                $v['isActive'] = $requestController == $controller && $requestAction == $action;
                if($this->Auth->user() != null){
                    if($v['isLogged']){
                        $navigationBar[$v['id']] = $v;
                    }
                }else{
                    if($v['isNotLogged']){
                        $navigationBar[$v['id']] = $v;
                    }
                }
            }
        }
        ksort($navigationBar);
        $this->set('navigationBar', $navigationBar);
    }
}
