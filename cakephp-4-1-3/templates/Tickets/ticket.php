<!-- Ticket -->
<div class="subscription-area section-padding top-0 theme-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="left-style">
                    <h3 class="section-title">Nowy kupon</h3>
                    <p>.</p>                    
                </div>
            </div>
            <div class="col-md-6">
            	<?php
            	   echo $this->Form->create($form);
            	   
            	   
            	   echo $this->Form->control('id_game', array('options' => $games, 'empty' => '-- wybierz grę -- ', 'label' => false, "autocomplete" => "new-password"));
            	   
            	   echo $this->Form->control("date_begin", array('type' => 'date', 'label' => 'Ważny od', "autocomplete" => "new-password"));
            	   echo $this->Form->control("date_end", array('type' => 'date', 'label' => 'Ważny do', "autocomplete" => "new-password"));            
            	   
            	   
            	   echo "<br/>" . $this->Form->button('Dodaj zakład?', array("class" => "btn btn-white"));
            	   
            	   echo "<br/><br/>" . $this->Form->button('Zarejestruj', array("class" => "btn btn-white"));
            
            	   echo $this->Form->end();
            	?>
            </div>
        </div>
    </div>
</div>
<!-- Ticket -->