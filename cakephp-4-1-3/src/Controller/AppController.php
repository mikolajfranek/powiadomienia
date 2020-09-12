<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\EventInterface;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');

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
            // If unauthorized, return them to page they were just on
            'unauthorizedRedirect' => $this->referer(),
            'authError' => 'Nie masz uprawnień dostępu do tej lokalizacji.'
        ]);
    }
    
    public function beforeRender($event){
        parent::beforeRender($event);       
        
        //change layout, with slider or not
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
        
        //navigationBar
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
