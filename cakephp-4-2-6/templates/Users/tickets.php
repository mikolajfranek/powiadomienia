<?php

use Cake\Core\Configure;
$games = Configure::read('Config.Games');

?>

<?php echo $this->element('menu_mobile'); ?>
<div class="flex">
    <?php echo $this->element('menu_side', array('menuside' => $menuside)); ?>
    <!-- BEGIN: Content -->
    <div class="content">
        <?php echo $this->element('top_bar', array('breadcrumbPart1' => Configure::read("Config.Breadcrumb.User"), 'breadcrumbPart2' => 'Kupony')); ?>
      	<div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Kupony
            </h2>
        </div>
        <!-- BEGIN: Delete Confirmation Modal -->
        <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                            <div class="text-3xl mt-5">Czy na pewno?</div>
                            <div class="text-gray-600 mt-2">
                                Czy na pewno chcesz usunąć wybrany element? 
                                <br>
                                Tego procesu nie można cofnąć.
                            </div>
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <?php
                                echo $this->Form->create(null, array("url" => array("controller" => "tickets", "action" => "delete")));
                            ?>
                            <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Anuluj</button>
                            <?php                                
                                echo $this->Form->control("id", array("templates" => array("inputContainer" => "<div class='hidden'>{{content}}</div>")));
                                echo $this->Form->button("Usuń", array("escape" => false, "class" => "btn btn-danger w-24"));
                                echo $this->Form->end();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Delete Confirmation Modal -->
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
                                    <span class="font-medium whitespace-nowrap">Kupon ważny <br/>od <?= date("d-m-Y", date_timestamp_get($ticket['date_begin'])) ?> <br/>do <?= date("d-m-Y", date_timestamp_get($ticket['date_end'])) ?></span>
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
<script type="text/javascript">
    $(document).ready(function() 
    {
    	modal = function (id) 
    	{
    		$("input[name='id']").val(id);
        }
    });
</script>