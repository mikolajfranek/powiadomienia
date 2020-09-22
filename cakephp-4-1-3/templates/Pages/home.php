<?php

use Cake\Core\Configure;

?>
<!-- Home -->
<div class="section section-padding">
    <div class="container">
		<div class="row">
			<div class="col-12">  
                <h3 class="concert-title">Czym są <?= Configure::read('Config.WebName') ?>?</h3>
                <p><?= Configure::read('Config.WebName') ?> to serwis, w którym istnieje możliwość zadeklarowania kupionych kuponów dla poniższych gier hazardowych:</p>
                <article class="concert-single">   
                    <div class="concert-entry">    	
                    	<div class="row">
                    		<div class="col-12">
                                <div class="schedules">
                                    <div class="schedule-item">
                                        <h5 class="schedule-title">Lotto</h5>
                                        <h5 class="schedule-title">Lotto Plus</h5>
                                        <h5 class="schedule-title">Mini Lotto.</h5>
                                    </div>
                                </div>
                        	</div>
                        </div>
                    </div>
            	</article>
            	<p>Serwis <?= Configure::read('Config.WebName') ?> w dniu losowania dla danej gry hazardowej pobiera wyniki losowania oraz wykonuje porównanie z zadeklarowanymi zakładami, operacja ta jest wykonywana o godzinie 22:34. Jeśli użytkownik posiada aktywne (ważne) zakłady dla danej gry hazardowej, wtedy zostaje do niego wysłane powiadomienie email o rezultacie porównania.</p>  
        	</div>   
    	</div>
    </div>
</div>
<!-- Home -->