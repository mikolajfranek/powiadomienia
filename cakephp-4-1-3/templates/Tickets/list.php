<?php

use Cake\Core\Configure;

?>
<!-- List -->
<div class="section section-padding theme-bg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header text-center">
                    <h3 class="section-title">Moje kupony</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table-borderless show-table">
                        <?php foreach($ticketsOfUser as $ticket): ?>
                            <tr>
                            	<td class="show-date">
                                    <span class="date"><?= (Configure::read('Config.Game'))[$ticket['id_game']]['name'] . ($ticket['is_lotto_plus'] ? ' (+ Lotto Plus)' : '') ?></span>
                                    <span class="day">Ważny od <?= date("d-m-Y", date_timestamp_get($ticket['date_begin'])) ?> do <?= date("d-m-Y", date_timestamp_get($ticket['date_end'])) ?></span>
                                </td>
                                <td class="show-ticket">
                                    <?php 
                                        echo $this->Html->link('Edytuj', array('controller' => 'tickets', 'action' => 'ticket', $ticket['id']), array('class' => "btn btn-border btn-white"));
                                    ?>
                                </td>
                                <td class="show-ticket">                                
                                    <?php 
                                        echo $this->Form->postlink('Usuń', array('controller' => 'tickets', 'action' => 'delete', $ticket['id']), array('class' => "btn btn-border btn-white", 'confirm' => 'Czy na pewno chcesz usunąć wybrany kupon?'));
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- List -->