<?php

use Cake\Core\Configure;

?>
<!-- BEGIN: Top Bar -->
<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <div class="-intro-x breadcrumb mr-auto sm:flex">
    	<?= $breadcrumbPart1 ?>
    	<i data-feather="chevron-right" class="breadcrumb__icon"></i>
    	<span class="breadcrumb--active"><?= $breadcrumbPart2 ?></span>
    </div>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Account Menu -->
    <div class="intro-x dropdown w-8 h-8 ml-auto">
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in btn-primary-soft" role="button" aria-expanded="false">
             <i data-feather="user" class="w-4 h-4 ml-2 mt-2"></i> 
        </div>        
        
        <div class="dropdown-menu w-56">
            <div class="dropdown-menu__content box bg-theme-26 dark:bg-dark-6 text-white">
                <div class="p-4 border-b border-theme-27 dark:border-dark-3">
                    <div class="font-medium"><?= $user['name'] ?></div>
                </div>
                <div class="p-2">
                	 <?php
                        echo $this->Html->link('<i data-feather="copy" class="w-4 h-4 mr-2"></i>Kupony',
                            array("controller" => "users", "action" => "tickets"),
                            array( "escape" => false, "class" => "flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"));
                	 ?>
                	 <?php
                        echo $this->Html->link('<i data-feather="clipboard" class="w-4 h-4 mr-2"></i>Wyniki',
                            array("controller" => "users", "action" => "results"),
                            array( "escape" => false, "class" => "flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"));
                	 ?>
                    <?php
                        echo $this->Html->link('<i data-feather="settings" class="w-4 h-4 mr-2"></i>Ustawienia',
                            array("controller" => "users", "action" => "settings"),
                            array( "escape" => false, "class" => "flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"));
                	 ?>
                </div>            
                <div class="p-2 border-t border-theme-27 dark:border-dark-3">
                     <?php
                        echo $this->Html->link('<i data-feather="log-out" class="w-4 h-4 mr-2"></i>Wyloguj',
                            array("controller" => "users", "action" => "logout"),
                            array( "escape" => false, "class" => "flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"));
                	 ?>    
                </div>
            </div>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->