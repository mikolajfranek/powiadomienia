<?php

use Cake\Core\Configure;

?>
<!-- Statistic -->
<div class="section section-padding theme-bg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header text-center">
                    <h3 class="section-title">Statystyki</h3>
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
                                    <?php foreach($statistics[$idGame] as $level => $statistic) : ?>
                                    	<span><?=$statistic?> trafień w "<?=$level ?>"</span><br/>
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
<!-- Statistic -->