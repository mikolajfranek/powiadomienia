<?php

use Cake\Core\Configure;

?>
<!-- BEGIN: Side Menu -->
<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="/dist/images/logo.svg">
        <span class="xl:block text-white text-lg ml-3 md:hidden"><?= Configure::read("Config.WebName") ?></span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
        	<?php
        	    $class = "side-menu";
        	    if($menuside["GamesList"] == true)
        	    {
        	        $class .= " side-menu--active";
        	    }
                echo $this->Html->link('<div class="side-menu__icon"><i data-feather="box"></i></div><div class="side-menu__title">Lista gier</div>',
                    array("controller" => "games", "action" => "list"),
                    array( "escape" => false, "class" => $class));
        	?>
        </li>
        <li>
        	<?php
            	$class = "side-menu";
            	if($menuside["TicketsRegister"] == true)
            	{
            	    $class .= " side-menu--active";
            	}
                echo $this->Html->link('<div class="side-menu__icon"><i data-feather="edit"></i></div><div class="side-menu__title">Rejestracja kuponu</div>',
                    array("controller" => "tickets", "action" => "register"),
                    array( "escape" => false, "class" => $class));
        	?>
        </li>
        <li>
        	<?php
            	$class = "side-menu";
            	if($menuside["PagesDonate"] == true)
            	{
            	    $class .= " side-menu--active";
            	}
                echo $this->Html->link('<div class="side-menu__icon"><i data-feather="dollar-sign"></i></div><div class="side-menu__title">Dotacja</div>',
                    array("controller" => "pages", "action" => "donate"),
                    array( "escape" => false, "class" => $class));
        	?>
        </li>	 
    </ul>
</nav>
<!-- END: Side Menu -->