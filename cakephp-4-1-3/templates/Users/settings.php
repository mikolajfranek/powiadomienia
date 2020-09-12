<!-- Register -->
<div class="subscription-area section-padding top-0 theme-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="left-style">
                    <h3 class="section-title">Ustawienia</h3>
                    <p>Korzystając z formularza istnieje możliwość zaktualizowania danych użytkownika. Każda zmiana wymaga podania aktualnego hasła do konta użytkownika.</p>
                    <p>* Po zmianie adresu email Twoje konto zostanie zablokowane oraz otrzymasz email, w którym będzie znajdował się link odblokowujący konto.</p>                    
                    <p>** Pole nieobowiązkowe, hasło użytkownika zostanie zaktualizowane w przypadku, gdy wartość w polu wprowadzania danych pozostanie niepusta. Po zaktualizowaniu hasła użytkownik zostanie wylogowany.</p>                    
                </div>
            </div>
            <div class="col-md-6">
            	<?php
            	   echo $this->Form->create($form);
            	   echo $this->Form->control('is_email_notification', array("type" => "checkbox", "label" => ' Odbieranie powiadomień email', "autocomplete" => "new-password"));
            	   echo $this->Form->control('email', array('label' => '* Email', "placeholder" => 'Twój email', "autocomplete" => "new-password"));
            	   echo $this->Form->control('password', array("type" => "password", "label" => "Aktualne hasło", "placeholder" => 'Twoje hasło', "autocomplete" => "new-password"));
            	   echo $this->Form->control('password_new', array("type" => "password", "label" => "** Nowe hasło", "placeholder" => 'Twoje nowe hasło', "autocomplete" => "new-password"));
            	   echo "<br/>" . $this->Form->button('Aktualizuj', array("class" => "btn btn-white"));
            	   echo $this->Form->end();
            	?>
            </div>
        </div>
    </div>
</div>
<!-- Register -->