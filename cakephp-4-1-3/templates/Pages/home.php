<?php

use Cake\Core\Configure;

?>
<!-- Home -->
<div class="subscription-area section-padding-additional ">
    <div class="container">
        <div class="row">         	
     	 	<article class="concert-single">     
                <h3 class="concert-title">Czym są <?= Configure::read('Config.WebName') ?>?</h3>         
                <div class="concert-entry">
                	<p>To serwis, w którym istnieje możliwość zadeklarowania kupionych kuponów dla poniższych gier hazardowych:</p>
                    <div class="schedules">
                        <div class="schedule-item">
                            <h5 class="schedule-title">Lotto</h5>
                            <h5 class="schedule-title">Lotto Plus</h5>
                            <h5 class="schedule-title">Mini Lotto.</h5>
                        </div>
                    </div>
                  	<p>Serwis <?= Configure::read('Config.WebName') ?> w dniu losowania dla danej gry hazardowej pobiera wyniki losowania oraz wykonuje porównanie z zadeklarowanymi kuponami, co oznacza, że po każdym losowaniu zostają wysłane powiadomienia email o rezultacie wygrania. Powiadomienia są wysyłane o godzinie 22:34.</p>
                </div>
            </article>     
        </div>
    </div>
</div>
<!-- Home -->