<?php

use Cake\Core\Configure;

?>
<!-- Gry -->
<div class="section section-padding  theme-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-12">
                <div class="section-header text-center">
                    <h3 class="section-title">Zarejestrowne gry</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table show-table table-borderless">
                        <?php foreach(Configure::read('Config.Game') as $id => $game): ?>
                            <tr>
                                <td class="show-hall show-date">
                                    <span class="date"><?= $game['name'] ?></span>
                                    <span class="hall-name"><?= $game['description'] ?></span>
                                </td>
                                <td class="show-ticket">
                                    <?php 
                                    echo $this->Html->link('Dodaj nowy kupon', array('controller' => 'tickets', 'action' => 'ticket'. '?game=' . $id), array('class' => "btn btn-border btn-white"));
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
<!-- Gry -->