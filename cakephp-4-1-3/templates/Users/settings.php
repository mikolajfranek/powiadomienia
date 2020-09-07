<!-- Register -->
<div class="subscription-area section-padding top-0 theme-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="left-style">
                    <h3 class="section-title">Ustawienia</h3>
                    <p>Korzystająć z formularza istnieje możliwość zaktualizowania danych użytkownika.</p>                    
                </div>
            </div>
            <div class="col-md-6">
            	<?php
            	   echo $this->Form->create($form);
            	   echo $this->Form->control('id', array("type" => "hidden"));
            	   echo $this->Form->control('is_email_notification', array("type" => "checkbox", "label" => ' Wysyłanie powiadomień email', "autocomplete" => "new-password"));
            	   echo $this->Form->control('email', array("placeholder" => 'Twój email', "autocomplete" => "new-password"));
            	   echo $this->Form->control('password', array("type" => "password", "label" => "Hasło", "placeholder" => 'Twoje hasło', "autocomplete" => "new-password"));
            	   echo $this->Form->control('password_new', array("type" => "password", "label" => "Powtórz hasło", "placeholder" => 'Twoje nowe hasło', "autocomplete" => "new-password"));
            	   echo "<br/>" . $this->Form->button('Aktualizuj', array("class" => "btn btn-white"));
            	   echo $this->Form->end();
            	?>
            </div>
        </div>
    </div>
</div>
<!-- Register -->