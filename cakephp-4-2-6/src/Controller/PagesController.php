<?php

namespace App\Controller;

use Cake\Core\Configure;

class PagesController extends AppController
{
    public function donate()
    {
        $menuside = Configure::read('Config.MenuSide');
        $menuside['PagesDonate'] = true;
        $this->set('menuside',$menuside);
    }
}
