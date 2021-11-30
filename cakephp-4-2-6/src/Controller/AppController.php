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
use Exception;
use Cake\Log\Log;

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
        $this->loadComponent('Authentication.Authentication');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        $this->loadComponent('FormProtection');
        $this->loadComponent('Paginator');
        
        $this->loadComponent('EmailProvider');
    }
    
    protected $user = null;
    
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        //BEGIN: bodyClass
        $this->set('bodyClass', 'main');
        //END: bodyClass
        date_default_timezone_set('Europe/Warsaw');
        //get 
        $this->set('menuside', Configure::read('Config.MenuSide'));
        $this->user = $this->Authentication->getIdentity();
    }
    
    public function beforeRender($event)
    {
        parent::beforeRender($event);
        if($this->user != null)
        {
            $this->set('user', $this->user);
        }
    }
    
    public static function myLogger(Exception $e)
    {
        try
        {
            Log::write('error', isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "");
            Log::write('error', isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "");
            Log::write('error', $e->__toString());
        }
        catch(Exception $e)
        {
            //nothing            
        }
    }
    
    protected function myFlashError(Exception $e, $messageIfExceptionHasEmptyMessage)
    {
        $this->myLogger($e);
        $this->Flash->error(empty($e->getMessage()) == true ? $messageIfExceptionHasEmptyMessage : $e->getMessage(), ['key' => 'notification']);
    }
    
    protected function myFlashSuccess($message)
    {
        $this->Flash->success($message, ['key' => 'notification']);
    }
}
