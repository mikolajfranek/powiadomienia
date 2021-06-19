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
                <!-- BEGIN: Form Layout -->   
                <div class="intro-x box p-5">
                	<?php
                       echo $this->Form->create($form);
                    ?>
                  	<div>
                        <label>Odbieranie powiadomień email</label>
                        <div class="mt-2">
                        	<?php
               		 		    echo $this->Form->control("is_email_notification", array(
               		 		        "type" => "checkbox",
               		 		        "label" => false,
               		 		        "class" => "form-check-switch"
               		 		    ));
           		 		    ?>
                        </div>
                    </div>
                    <div class="mt-3">
                   		<label for="crud-form-1" class="form-label">Email</label>
           		 		<?php
           		 		    echo $this->Form->control("email", array(
           		 		        "placeholder" => "Email",
           		 		        "label" => false,
           		 		        "class" => "form-control w-full",
           		 		        "id" => "crud-form-1"
           		 		    ));
       		 		    ?>
                   	</div>
                   	<div class="mt-3">
                   		<label for="crud-form-2" class="form-label">Hasło</label>
           		 		<?php
           		 		    echo $this->Form->control("password", array(
           		 		        "type" => "password",
           		 		        "placeholder" => "Hasło",
           		 		        "label" => false,
           		 		        "class" => "form-control w-full",
           		 		        "id" => "crud-form-2"
           		 		    ));
       		 		    ?>
                   	</div>
               	 	<div class="mt-3">
                   		<label for="crud-form-3" class="form-label">Nowe hasło</label>
           		 		<?php
           		 		    echo $this->Form->control("password_new", array(
           		 		        "type" => "password",
           		 		        "placeholder" => "Nowe hasło",
           		 		        "label" => false,
           		 		        "class" => "form-control w-full",
           		 		        "id" => "crud-form-3"
           		 		    ));
       		 		    ?>
                   	</div>
                    <div class="text-right mt-5">
                    	<?php
                            echo $this->Form->button("Aktualizuj", array(
                                "class" => "btn btn-primary w-24"
                            ));
                            echo $this->Form->end();
                        ?>
                    </div>
                </div>
                <!-- END: Form Layout -->
            </div>
        </div>
    </div>
    <!-- END: Content -->
</div>