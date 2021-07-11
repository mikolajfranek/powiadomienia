<?php

use Cake\Core\Configure;

$games = Configure::read('Config.Games');
$options = [];
foreach($games as $key => $game){
    $options[$key] = $game['name'];
}
?>

<?php echo $this->element('menu_mobile'); ?>
<div class="flex">
    <?php echo $this->element('menu_side', array('menuside' => $menuside)); ?>
    <!-- BEGIN: Content -->
    <div class="content">
        <?php echo $this->element('top_bar', array('breadcrumbPart1' => Configure::read("Config.Breadcrumb.Web"), 'breadcrumbPart2' => 'Rejestracja kuponu',)); ?>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Rejestracja kuponu
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
                        <label for="crud-form-combobox" class="form-label">Gra hazardowa</label>
                    	<?php
           		 		    echo $this->Form->control("id_game", array(
           		 		        "label" => false,
           		 		        "options" => $options, 
           		 		        "default" => $selectedGameId,
           		 		        "empty" => Configure::read('Config.Combobox.Empty'),
           		 		        "class" => "tail-select w-full",
           		 		        "id" => "crud-form-combobox"
           		 		    ));
       		 		    ?>
                    </div>
                  	<div class="mt-3">
                        <label for="crud-form-date-begin" class="form-label">Ważny od</label>
                    	<?php
           		 		    echo $this->Form->control("date_begin", array(
           		 		        "label" => false,
           		 		        "type" => "text",
           		 		        "class" => "datepicker form-control",
           		 		        "data-single-mode" => true,   
           		 		        "id" => "crud-form-date-begin"
           		 		    ));
       		 		    ?>
                    </div>
                	<div class="mt-3">
                        <label for="crud-form-date-end" class="form-label">Ważny do</label>
                    	<?php
           		 		    echo $this->Form->control("date_end", array(
           		 		        "label" => false,
           		 		        "type" => "text",
           		 		        "class" => "datepicker form-control",
           		 		        "data-single-mode" => true,
           		 		        "id" => "crud-form-date-end"
           		 		    ));
       		 		    ?>
                    </div>
                    <div class="mt-3">
                   		<label for="crud-form-1" class="form-label">Zakład 1</label>
           		 		<?php
           		 		    echo $this->Form->control("collection1", array(
           		 		        "placeholder" => "Zakład 1",
           		 		        "label" => false,
           		 		        "class" => "form-control w-full",
           		 		        "id" => "crud-form-1"
           		 		    ));
       		 		    ?>
                   	</div>
           	       	<div class="mt-3">
                   		<label for="crud-form-2" class="form-label">Zakład 2</label>
           		 		<?php
           		 		    echo $this->Form->control("collection2", array(
           		 		        "placeholder" => "Zakład 2",
           		 		        "label" => false,
           		 		        "class" => "form-control w-full",
           		 		        "id" => "crud-form-2"
           		 		    ));
       		 		    ?>
                   	</div>
                   	<div class="mt-3">
                   		<label for="crud-form-3" class="form-label">Zakład 3</label>
           		 		<?php
           		 		    echo $this->Form->control("collection3", array(
           		 		        "placeholder" => "Zakład 3",
           		 		        "label" => false,
           		 		        "class" => "form-control w-full",
           		 		        "id" => "crud-form-3"
           		 		    ));
       		 		    ?>
                   	</div>
                   	<div class="mt-3">
                   		<label for="crud-form-4" class="form-label">Zakład 4</label>
           		 		<?php
           		 		    echo $this->Form->control("collection4", array(
           		 		        "placeholder" => "Zakład 4",
           		 		        "label" => false,
           		 		        "class" => "form-control w-full",
           		 		        "id" => "crud-form-4"
           		 		    ));
       		 		    ?>
                   	</div>
                   	<div class="mt-3">
                   		<label for="crud-form-5" class="form-label">Zakład 5</label>
           		 		<?php
           		 		    echo $this->Form->control("collection5", array(
           		 		        "placeholder" => "Zakład 5",
           		 		        "label" => false,
           		 		        "class" => "form-control w-full",
           		 		        "id" => "crud-form-5"
           		 		    ));
       		 		    ?>
                   	</div>
                   	<div class="mt-3">
                   		<label for="crud-form-6" class="form-label">Zakład 6</label>
           		 		<?php
           		 		    echo $this->Form->control("collection6", array(
           		 		        "placeholder" => "Zakład 6",
           		 		        "label" => false,
           		 		        "class" => "form-control w-full",
           		 		        "id" => "crud-form-6"
           		 		    ));
       		 		    ?>
                   	</div>
                   	<div class="mt-3">
                   		<label for="crud-form-7" class="form-label">Zakład 7</label>
           		 		<?php
           		 		    echo $this->Form->control("collection7", array(
           		 		        "placeholder" => "Zakład 7",
           		 		        "label" => false,
           		 		        "class" => "form-control w-full",
           		 		        "id" => "crud-form-7"
           		 		    ));
       		 		    ?>
                   	</div>
                   	<div class="mt-3">
                   		<label for="crud-form-8" class="form-label">Zakład 8</label>
           		 		<?php
           		 		    echo $this->Form->control("collection8", array(
           		 		        "placeholder" => "Zakład 8",
           		 		        "label" => false,
           		 		        "class" => "form-control w-full",
           		 		        "id" => "crud-form-8"
           		 		    ));
       		 		    ?>
                   	</div>
                    <div class="text-right mt-5">
                    	<?php
                            echo $this->Form->button("Rejestruj", array(
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