<?php

use Cake\Core\Configure;

?>
<!-- Ticket -->
<div class="section section-padding theme-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12">
                <h3 class="section-title">Rejestracja kuponu</h3>
                <p>Do zarejestrowania kuponu wymagane jest wybranie gry hazardowej, określenie ważności kuponu oraz zadeklarowania minimalnie jednego zakładu. W polach wprowadzania danych dla deklaracji zakładów, liczby należy podawać po białym znaku.</p><br/>
            </div>
            <div class="col-md-6 col-12">
            	<?php
            	   echo $this->Form->create($form);
            	   echo $this->Form->label('id_game', "Gra hazardowa");
            	   echo $this->Form->control('id_game', 
            	       
            	       
            	       array('options' => Configure::read('Config.IdToGame'), 
            	           
            	           
            	           'default' => $game, 
            	           
            	           'empty' => '-- wybierz grę -- ', "autocomplete" => "new-password"));
            	   echo $this->Form->control("date_begin", array('type' => 'date', 'label' => 'Ważny od', "autocomplete" => "new-password"));
            	   echo $this->Form->control("date_end", array('type' => 'date', 'label' => 'Ważny do', "autocomplete" => "new-password"));
            	   
            	   
            	   echo $this->Form->control("collection1", array('label' => 'Zakład 1', "placeholder" => 'Zakład 1',  "autocomplete" => "new-password"));
            	   echo $this->Form->control("collection2", array('label' => 'Zakład 2', "placeholder" => 'Zakład 2',  "autocomplete" => "new-password"));
            	   echo $this->Form->control("collection3", array('label' => 'Zakład 3', "placeholder" => 'Zakład 3',  "autocomplete" => "new-password"));
            	   echo $this->Form->control("collection4", array('label' => 'Zakład 4', "placeholder" => 'Zakład 4',  "autocomplete" => "new-password"));
            	   echo $this->Form->control("collection5", array('label' => 'Zakład 5', "placeholder" => 'Zakład 5',  "autocomplete" => "new-password"));
            	   echo $this->Form->control("collection6", array('label' => 'Zakład 6', "placeholder" => 'Zakład 6',  "autocomplete" => "new-password"));
            	   echo $this->Form->control("collection7", array('label' => 'Zakład 7', "placeholder" => 'Zakład 7',  "autocomplete" => "new-password"));
            	   echo $this->Form->control("collection8", array('label' => 'Zakład 8', "placeholder" => 'Zakład 8',  "autocomplete" => "new-password"));
            	   echo "<br/>" . $this->Form->button('Zarejestruj kupon', array("class" => "btn btn-border btn-white"));
            	   echo $this->Form->end();
            	?>
            </div>
        </div>
    </div>
</div>
<!-- Ticket -->
