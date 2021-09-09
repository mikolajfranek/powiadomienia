<?php

use Cake\Core\Configure;

?>

<?php echo $this->element('menu_mobile'); ?>
<div class="flex">
    <?php echo $this->element('menu_side', array('menuside' => $menuside)); ?>
    <!-- BEGIN: Content -->
    <div class="content">
        <?php echo $this->element('top_bar', array('breadcrumbPart1' => Configure::read("Config.Breadcrumb.User"), 'breadcrumbPart2' => 'Wyniki')); ?>
      	<div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Wyniki
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            
            
            
            
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">Nazwa</th>
                            <th class="text-center whitespace-nowrap">Akcja</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php foreach($tickets as $ticket): ?>
                            <tr class="intro-x">
                                <td>
                                    <span class="font-medium whitespace-nowrap">Kupon ważny <br/>od <?= date("d-m-y", date_timestamp_get($ticket['date_begin'])) ?> <br/>do <?= date("d-m-y", date_timestamp_get($ticket['date_end'])) ?></span>
                                    <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5"><?= $games[$ticket['id_game']]['name'] ?></div>
                                </td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <?php 
                                            echo $this->Html->link('<i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edytuj', 
                                                array("controller" => "tickets", "action" => "register/" . $ticket['id']), 
                                                array("escape" => false, "class" => "flex items-center mr-3"));
                                        ?>
                                        <?php 
                                            echo $this->Html->link('<i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Usuń',
                                                "javascript:modal(" . $ticket['id'] . ");",
                                                array("escape" => false, "class" => "flex items-center text-theme-6",
                                                      "data-toggle" => "modal", "data-target" => "#delete-confirmation-modal"
                                                ));
                                        ?>                       
                                    </div>
                                </td>
                            </tr>
                		<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- END: Data List -->
        </div>
    </div>
    <!-- END: Content -->
</div>