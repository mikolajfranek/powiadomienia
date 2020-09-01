<!-- Register -->
<div class="subscription-area section-padding top-0 theme-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="left-style">
                    <h3 class="section-title">Rejestracja</h3>
                    <p>Po wysłaniu poprawnego formularza rejestracji otrzymasz email, w którym będzie znajdował się link aktywujący konto.</p>                    
                </div>
            </div>
            <div class="col-md-6">
            	<?php
            	   echo $this->Form->create($form);
            	   echo $this->Form->control('login', array("placeholder" => 'Twój login', "autocomplete" => "new-password"));
            	   echo $this->Form->control('email', array("placeholder" => 'Twój email', "autocomplete" => "new-password"));
            	   echo $this->Form->control('password', array("type" => "password", "label" => "Hasło", "placeholder" => 'Twoje hasło', "autocomplete" => "new-password"));
            	   echo $this->Form->control('password_confirm', array("type" => "password", "label" => "Powtórz hasło", "placeholder" => 'Twoje hasło', "autocomplete" => "new-password"));
            	   echo "<br/>" . $this->Form->button('Zarejestruj', array("class" => "btn btn-white"));
            	   echo $this->Form->end();
            	?>
            </div>
        </div>
    </div>
</div>
<!-- Register -->