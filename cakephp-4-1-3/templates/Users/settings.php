<!-- Register -->
<div class="section section-padding theme-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12">
            	<h3 class="section-title">Ustawienia</h3>
                <p>Korzystając z formularza istnieje możliwość zaktualizowania danych użytkownika. Każda zmiana wymaga podania aktualnego hasła do konta użytkownika.</p>
                <p>* Po zmianie adresu email Twoje konto zostanie zablokowane. Na nowy adres email zostanie wysłany link odblokowujący konto.</p>                                    
                <p>** Pole nieobowiązkowe, hasło użytkownika zostanie zaktualizowane w przypadku, gdy wartość w polu wprowadzania danych pozostanie niepusta. Po zaktualizowaniu hasła użytkownik zostanie wylogowany.</p>                
            </div>
            <div class="col-md-6 col-12">
            	<?php
            	   echo $this->Form->create($form);
            	   echo $this->Form->control('is_email_notification', array("type" => "checkbox", "label" => ' Odbieranie powiadomień email', "autocomplete" => "new-password"));
            	   echo $this->Form->control('email', array('label' => '* Adres email', "placeholder" => 'Twój adres email', "autocomplete" => "new-password"));
            	   echo $this->Form->control('password', array("type" => "password", "label" => "Hasło", "placeholder" => 'Twoje hasło', "autocomplete" => "new-password"));
            	   echo $this->Form->control('password_new', array("type" => "password", "label" => "** Nowe hasło", "placeholder" => 'Twoje nowe hasło', "autocomplete" => "new-password"));
            	   echo "<br/>" . $this->Form->button('Aktualizuj', array("class" => "btn btn-border btn-white"));
            	   echo $this->Form->end();
            	?>
            </div>
        </div>
    </div>
</div>
<!-- Register -->