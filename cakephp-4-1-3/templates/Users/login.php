<?php

use Cake\Core\Configure;

?>
<!-- Login -->
<div class="section section-padding theme-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12">
            	<h3 class="section-title">Logowanie</h3>    
                <p>Konto w serwisie <?= Configure::read('Config.WebName') ?> pozwala na zarządzanie kuponami do gier hazardowych, takich jak Lotto, Lotto Plus, Mini Lotto.</p>
                <p>Zapomniałeś hasła? Skontaktuj się z nami poprzez pocztę elektroniczą.</p>     
                <p class="email"><i class="fa fa-envelope-o"></i> <?= Configure::read('Config.Email.web') ?></p>
            </div>
            <div class="col-md-6 col-12">
            	<?php
            	   echo $this->Form->create($form);
            	   echo $this->Form->control('login', array("placeholder" => 'Twój login', "autocomplete" => "new-password"));
            	   echo $this->Form->control('password', array("type" => "password", "label" => "Hasło", "placeholder" => 'Twoje hasło', "autocomplete" => "new-password"));
            	   echo "<br/>" . $this->Form->button('Zaloguj', array("class" => "btn btn-white"));
            	   echo $this->Form->end();
            	?>
            </div>
        </div>
    </div>
</div>
<!-- Login -->