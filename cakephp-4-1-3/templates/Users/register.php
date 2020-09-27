<!-- Register -->
<div class="section section-padding theme-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12">
                <h3 class="section-title">Rejestracja</h3>
                <p>Po wysłaniu poprawnego formularza rejestracji otrzymasz email, w którym będzie znajdował się link aktywujący konto.</p><br/>
            </div>
            <div class="col-md-6 col-12">
            	<?php
            	   echo $this->Form->create($form);
            	   echo $this->Form->control('login', array("placeholder" => 'Twój login', "autocomplete" => "new-password"));
            	   echo $this->Form->control('email', array("label" => "Adres email", "placeholder" => 'Twój adres email', "autocomplete" => "new-password"));            	   
            	   echo $this->Form->control('password', array("type" => "password", "label" => "Hasło", "placeholder" => 'Twoje hasło', "autocomplete" => "new-password"));
            	   echo $this->Form->control('password_confirm', array("type" => "password", "label" => "Powtórz hasło", "placeholder" => 'Twoje hasło', "autocomplete" => "new-password"));
            	   echo "<br/>" . $this->Form->button('Zarejestruj', array("class" => "btn btn-border btn-white"));
            	   echo $this->Form->end();
            	?>
            </div>
        </div>
    </div>
</div>
<!-- Register -->