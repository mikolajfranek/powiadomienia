<?php

use Cake\Core\Configure;

?>
<!-- Last -->
<div class="section section-padding theme-bg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header text-center">
                    <h3 class="section-title">Ostatnie</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table-borderless show-table">
                        <?php foreach(Configure::read('Config.Game') as $idGame => $game): ?>
                            <tr>
                                <td class="show-date">
                                    <span class="date"><?= $game['nameStatistic'] ?></span>
                                    <span class="day"><?= $game['description'] ?></span>
                                </td>
                                <td class="show-ticket">
                                    <?php foreach($lasts[$idGame] as $last) : ?>
                                    	<span>                                    	
                                        	Losowanie dnia: <?=date('d-m-Y', date_timestamp_get($last['lottery_date']))?><br/>
                                        	Wysłano email: <?=empty($last['sent']) ? "Nie" : date('d-m-Y H:i:s', date_timestamp_get($last['sent'])) ?><br/>
                                        	Dostarczono email: <?=empty($last['delivered']) ? "Nie" : date('d-m-Y H:i:s', date_timestamp_get($last['delivered']))?><br/>
                                        	Treść email: <?=$last['content'] ?>
                                    	</span><br/><br/>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Last -->