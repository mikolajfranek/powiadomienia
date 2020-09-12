<?php

use Cake\Core\Configure;

?>
<!-- Games -->
<div class="section section-padding  theme-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-12">
                <div class="section-header text-center">
                    <h3 class="section-title">Zarejestrowane kupony</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table show-table table-borderless">
                        <?php foreach($ticketsOfUser as $ticket): ?>
                            <tr>
                                <td class="show-hall show-date">
                                    <span class="date"><?= (Configure::read('Config.Game'))[$ticket['id_game']]['name'] . ($ticket['is_lotto_plus'] ? ' (+ Lotto Plus)' : '') ?></span>
                                    <span class="hall-name">Ważny od <?= $ticket['date_begin'] ?> do <?= $ticket['date_end'] ?></span>
                                </td>
                                <td class="show-ticket">
                                    <a class="btn btn-border btn-white" href="#">Edytuj</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Games -->