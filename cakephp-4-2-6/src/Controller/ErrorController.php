<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

class ErrorController extends AppController
{
    public function initialize(): void
    {
        $this->loadComponent('RequestHandler');
    }

    public function beforeRender(EventInterface $event)
    {
        $this->viewBuilder()->setTemplatePath('Error');
    }
}
