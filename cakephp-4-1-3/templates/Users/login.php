<!-- Login -->
<div class="subscription-area section-padding top-0 theme-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="left-style">
                    <h3 class="section-title">Logowanie</h3>
                    <p>Konto pozwala na zarządzanie kuponami do gier hazardowych, takich jak Lotto, Lotto Plus, Mini Lotto.</p>                    
                </div>
            </div>
            <div class="col-md-6">
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