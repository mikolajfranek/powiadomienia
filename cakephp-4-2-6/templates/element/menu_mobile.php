<?php

use Cake\Core\Configure;

?>
<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="/dist/images/logo.svg">
            <span class="xl:block text-white text-lg ml-3"><?= Configure::read("Config.WebName") ?></span>
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>    
    <ul class="border-t border-theme-29 py-5 hidden">        
        <li>
        	<?php
                echo $this->Html->link('<div class="menu__icon"><i data-feather="box"></i></div><div class="menu__title">Lista gier</div>',
                    array("controller" => "games", "action" => "list"),
                    array( "escape" => false, "class" => "menu"));
        	?>
        </li>
        <li>
        	<?php
                echo $this->Html->link('<div class="menu__icon"><i data-feather="edit"></i></div><div class="menu__title">Rejestracja kuponu</div>',
                    array("controller" => "tickets", "action" => "register"),
                    array( "escape" => false, "class" => "menu"));
        	?>
        </li>
        <li>
        	<?php
                echo $this->Html->link('<div class="menu__icon"><i data-feather="dollar-sign"></i></div><div class="menu__title">Dotacja</div>',
                    array("controller" => "pages", "action" => "donate"),
                    array( "escape" => false, "class" => "menu"));
        	?>
        </li>
    </ul>
</div>
<!-- END: Mobile Menu -->