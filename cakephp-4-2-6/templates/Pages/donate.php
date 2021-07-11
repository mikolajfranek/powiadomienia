<?php

use Cake\Core\Configure;

?>

<?php echo $this->element('menu_mobile'); ?>
<div class="flex">
    <?php echo $this->element('menu_side', array('menuside' => $menuside)); ?>
    <!-- BEGIN: Content -->
    <div class="content">
        <?php echo $this->element('top_bar', array('breadcrumbPart1' => Configure::read("Config.Breadcrumb.Web"), 'breadcrumbPart2' => 'Dotacja')); ?>
      	<div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Dotacja
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
           <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-x box p-5">
                	<div class="intro-y text-justify leading-relaxed mt-6">
        				<p class="mb-5">Przekazanie dobrowolnej dotacji na numer konta 78 1090 1274 0000 0001 2328 9003 wesprze rozwój serwisu.</p>
    				</div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content -->
</div>