<?php

use Cake\Core\Configure;

?>

<?php echo $this->element('menu_mobile'); ?>
<div class="flex">
    <?php echo $this->element('menu_side', array('menuside' => $menuside)); ?>
    <!-- BEGIN: Content -->
    <div class="content">
        <?php echo $this->element('top_bar', array('breadcrumbPart1' => Configure::read("Config.Breadcrumb.User"), 'breadcrumbPart2' => 'Ustawienia')); ?>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Ustawienia
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
           <div class="intro-y col-span-12 lg:col-span-6">       
            	<?php
               	   echo $this->Form->create($form);
    	   	    ?>
                <div class="intro-x box p-5">
                
                
                
                
                
                
                
                    <!-- TODO 
                        tylko ten środek
                        dodać togle (checkbox)
                    -->
                
                
                    <?php
            	       echo $this->Form->control("email", array(
            	           "placeholder" => "Email",
            	           "label" => false,
            	           "class" => "intro-x login__input form-control py-3 px-4 border-gray-300 block"
            	       ));
            	       echo $this->Form->control("password", array(
            	           "type" => "password",
            	           "placeholder" => "Hasło",
            	           "label" => false,
            	           "class" => "intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4",
            	       ));
            	       echo $this->Form->control("password_confirm", array(
            	           "type" => "password",
            	           "placeholder" => "Powtórz hasło",
            	           "label" => false,
            	           "class" => "intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4",
            	       ));
            	   	?>
            	   	
            	   	
            	   	
            	   	
            	   	
            	   	
            	   	
            	   	
            	   	
            	   	
                </div>
                <div class="text-right mt-5">
                	<?php
                        echo $this->Form->button("Zapisz", array(
                            "class" => "btn btn-primary w-24"
                        ));
                        echo $this->Form->end();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content -->
</div>