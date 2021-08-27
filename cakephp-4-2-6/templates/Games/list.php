<?php

use Cake\Core\Configure;

?>

<?php echo $this->element('menu_mobile'); ?>
<div class="flex">
    <?php echo $this->element('menu_side', array('menuside' => $menuside)); ?>
    <!-- BEGIN: Content -->
    <div class="content">
        <?php echo $this->element('top_bar', array('breadcrumbPart1' => Configure::read("Config.Breadcrumb.Web"), 'breadcrumbPart2' => 'Lista gier')); ?>
      	<div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Lista gier
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
                    	<?php foreach(Configure::read('Config.Games') as $id => $game): ?>
                            <tr class="intro-x">
                                <td>
                                    <span class="font-medium whitespace-nowrap"><?= $game['name'] ?></span> 
                                    <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5"><?= $game['description'] ?></div>
                                </td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <?php 
                                            echo $this->Html->link('<i data-feather="play" class="w-4 h-4 mr-1"></i> Zagraj', 
                                                array("controller" => "tickets", "action" => "register?game=" . $id), 
                                                array("escape" => false, "class" => "flex items-center mr-3"));
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