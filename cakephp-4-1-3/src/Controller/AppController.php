<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\EventInterface;

class AppController extends Controller
{
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
