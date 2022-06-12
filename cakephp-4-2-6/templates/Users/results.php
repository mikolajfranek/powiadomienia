<?php
use Cake\Core\Configure;
$games = Configure::read('Config.Games');
$options = [];
foreach($games as $key => $game){
    $options[$key] = $game['name'];
}

function colorNumbersOfUser($numbers, $intersect)
{
    $result = "";
    $numbers = explode(';', $numbers);
    $intersect = explode(';', $intersect);
    foreach($numbers as $number)
    {    
        if(in_array($number, $intersect))
        {
            $result .= "<span style='color: green;'>" . $number . "</span>";
        }
        else
        {
            $result .= "<span>" . $number . "</span>";
        }
        $result .= '#';
    }
    return str_replace('#', '&nbsp;', $result);
}
?>

<?php echo $this->element('menu_mobile'); ?>
<div class="flex">
    <?php echo $this->element('menu_side', array('menuside' => $menuside)); ?>
    <!-- BEGIN: Content -->
	<div class="content">
        <?php echo $this->element('top_bar', array('breadcrumbPart1' => Configure::read("Config.Breadcrumb.User"), 'breadcrumbPart2' => 'Wyniki')); ?>
      	<div class="intro-y flex items-center mt-8">
			<h2 class="text-lg font-medium mr-auto">Wyniki</h2>
		</div>
		<div class="intro-y box p-5 mt-5">
			<div class="overflow-x-auto scrollbar-hidden">
				<div
					class="tabulator mt-5 table-report table-report--tabulator tabulator"
					role="grid" tabulator-layout="fitColumns">
					<!-- BEGIN: Filter -->
					<div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
    					<?php
    					   echo $this->Form->create(null, array("valueSources" => "query", "class" => "xl:flex sm:mr-auto"));
                        ?>
						<div class="sm:flex items-center sm:mr-4">
							<label class="w-22 flex-none xl:w-auto mr-2">Gra hazardowa</label>
							<?php
               		 		    echo $this->Form->control("id_game", array(
               		 		        "label" => false,
               		 		        "options" => $options, 
               		 		        "empty" => Configure::read('Config.Combobox.Empty'),
               		 		        "class" => "form-select w-full sm:w-32 xxl:w-full mt-2 sm:mt-0 sm:w-auto",
               		 		    ));
           		 		    ?>
						</div>
						<div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
							<label class="w-22 flex-none xl:w-auto xl:flex-initial mr-2">Stopień wygranej</label>
							<?php
               		 		    echo $this->Form->control("amount_winning", array(
               		 		        "label" => false,
               		 		        "options" => Configure::read('Config.WinningDegree'), 
               		 		        "empty" => Configure::read('Config.Combobox.Empty'),
               		 		        "class" => "form-select w-full mt-2 sm:mt-0 sm:w-auto",
               		 		    ));
           		 		    ?>
            			</div>
            				<div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
							<label class="w-22 flex-none xl:w-auto xl:flex-initial mr-2">Wygrana</label>
							<?php
               		 		    echo $this->Form->control("amount_winning_yes_or_no", array(
               		 		        "label" => false,
               		 		        "options" => Configure::read('Config.YesOrNo'), 
               		 		        "empty" => Configure::read('Config.Combobox.Empty'),
               		 		        "class" => "form-select w-full mt-2 sm:mt-0 sm:w-auto",
               		 		    ));
           		 		    ?>
            			</div>
            			<div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
            				<label class="w-22 flex-none xl:w-auto xl:flex-initial mr-2">Zakład</label>			
	           		 		<?php
               		 		    echo $this->Form->control("numbers_of_user", array(
               		 		        "placeholder" => "Zakład",
               		 		        "label" => false,
               		 		        "class" => "form-control sm:w-40 xxl:w-full mt-2 sm:mt-0"
               		 		    ));
           		 		    ?>
            			</div>
            			<div class="mt-2 xl:mt-0">
    				    	<?php
                                echo $this->Form->button("Filtruj", array(
                                    "class" => "btn btn-primary w-full sm:w-16"
                                ));
                                echo $this->Html->link('Resetuj', 
                                    array("controller" => "users", "action" => "results"),
                                    array("escape" => false, "class" => "btn btn-secondary w-full sm:w-16 mt-2 sm:mt-0 sm:ml-1"));
                                echo $this->Form->end();
                            ?>
            			</div>
                	</div>
					<div class="mt-5 text-gray-600 text-xs whitespace-nowrap">
					<?php
						if(sizeof($resultsOfUser) == 0)
						{
						    echo "Wyświetlono 0 pozycji";
						}
						else
						{
						    echo "Wyświetlono od " . $paginate['start'] . " do " . $paginate['end'] . " na " . $paginate['count'] . " pozycji";
						}
				    ?>
    				</div>
                    <!-- END: Filter -->
					<?php
					if(isset($paginate))
					{
					    echo $this->element('pagination', array('paginate' => $paginate));
					}
					?>
					<!-- BEGIN: Content table-->
					<div class="tabulator-tableHolder" tabindex="0">
						<div class="tabulator-table" style="padding-top: 20px; padding-bottom: 0px; display: grid;">
                            <!-- BEGIN: Header -->
							<div class="tabulator-header noClick" style="padding-right: 0px; margin-left: 0px;">
								<div class="tabulator-headers" style="margin-left: 0px;">
									<div class="tabulator-col" role="columnheader" 
									style="height: 44px; width: 120px;" title="">
										<div class="tabulator-col-content">
											<div class="tabulator-col-title-holder">
												<div class="tabulator-col-title">Wynik</div>
											</div>
										</div>
									</div>
									<div class="tabulator-col md:inline-flex textAlignCenter" role="columnheader"
									style="height: 44px; width: 200px;" title="">
										<div class="tabulator-col-content">
											<div class="tabulator-col-title-holder">
												<div class="tabulator-col-title">Zakład</div>
											</div>
										</div>
									</div>
									<div class="tabulator-col md:inline-flex textAlignCenter" role="columnheader"
									style="height: 44px; width: 200px;" title="">
										<div class="tabulator-col-content">
											<div class="tabulator-col-title-holder">
												<div class="tabulator-col-title">Losowanie</div>
											</div>
										</div>
									</div>
									<div class="tabulator-col md:inline-flex textAlignCenter" role="columnheader"
									style="height: 44px; width: 400px;" title="">
										<div class="tabulator-col-content">
											<div class="tabulator-col-title-holder">
												<div class="tabulator-col-title">Mail</div>
											</div>
										</div>
									</div>
								</div>
							</div>
                            <!-- END: Header -->
							<?php $rowOdd = true; ?>
        					<?php foreach($resultsOfUser as $result): ?>
        					<div class="tabulator-row tabulator-selectable noClick <?php echo ($rowOdd ? "tabulator-row-odd" : "tabulator-row-even"); ?>" role="row" style="padding-left: 0px;">
								<div class="tabulator-cell" role="gridcell" style="width: 120px; display: inline-flex; align-items: center; height: 64px;">
									<div>
										<div class="font-medium whitespace-nowrap">
										<?= $result['amount_winning'] . '-ka' ?>
										</div>
										<div class="text-gray-600 text-xs whitespace-nowrap">
										<?= $games[$result['id_game']]['name'] ?>
										</div>
										<div class="text-gray-600 text-xs whitespace-nowrap">
										<?= date("d-m-Y", date_timestamp_get($result['date_lottery'])) ?>
										</div>
									</div>
								</div>
						        <!-- BEGIN: noMobile -->
								<div class="tabulator-cell md:inline-flex" role="gridcell" style="width: 200px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;">
									<div class="flex lg:justify-center">
										<?= colorNumbersOfUser($result['numbers_of_user'], $result['numbers_winning']) ?>
									</div> 
								</div>
								<div class="tabulator-cell md:inline-flex" role="gridcell" style="width: 200px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;">
									<div class="flex lg:justify-center">
										<?= colorNumbersOfUser($result['numbers_lottery'], $result['numbers_winning']) ?>
									</div>
								</div>
								<div class="tabulator-cell md:inline-flex" role="gridcell" style="width: 400px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;">
									<div>
										<div class="font-medium whitespace-nowrap">
										<?= $result->email['email'] ?>
										</div>
										<div class="text-gray-600 text-xs whitespace-nowrap">
										<?= "Wysłano: ". (empty($result->email['date_sent']) ? "Nie" : date('d-m-Y H:i:s', date_timestamp_get($result->email['date_sent']))) ?>
										</div>
										<div class="text-gray-600 text-xs whitespace-nowrap">
										<?= "Doręczono: ". (empty($result->email['date_delivered']) ? "Nie" : date('d-m-Y H:i:s', date_timestamp_get($result->email['date_delivered']))) ?>
										</div>
									</div>
								</div>
                                <!-- END: noMobile -->
								<!-- BEGIN: Mobile -->
								<div class="tabulator-responsive-collapse md:hidden">
									<table>
										<tr>
											<td><strong>Zakład</strong></td>
											<td><div class="flex lg:justify-center">
												<?= colorNumbersOfUser($result['numbers_of_user'], $result['numbers_winning']) ?>
											</div></td>
										</tr>
										<tr>
											<td><strong>Losowanie</strong></td>
											<td><div class="flex lg:justify-center">
												<?= colorNumbersOfUser($result['numbers_lottery'], $result['numbers_winning']) ?>
											</div></td>
										</tr>
										<tr>
											<td><strong>Mail</strong></td>
											<td><div class="flex lg:justify-center">
													<div>
														<div class="font-medium whitespace-nowrap">
															<?= $result->email['email'] ?>
														</div>
														<div class="text-gray-600 text-xs whitespace-nowrap">
															<?= "Wysłano: ". (empty($result->email['date_sent']) ? "Nie" : date('d-m-Y H:i:s', date_timestamp_get($result->email['date_sent']))) ?>
														</div>
														<div class="text-gray-600 text-xs whitespace-nowrap">
															<?= "Doręczono: ". (empty($result->email['date_delivered']) ? "Nie" : date('d-m-Y H:i:s', date_timestamp_get($result->email['date_delivered']))) ?>
														</div>
													</div>
											</div></td>
										</tr>
									</table>
								</div>
								<!-- END: Mobile -->
							</div>
							<?php $rowOdd = $rowOdd ? false : true; ?>
							<?php endforeach; ?>
						</div>
					</div>
					<!-- END: Content table-->
					<?php
					if(isset($paginate))
					{
					    echo $this->element('pagination', array('paginate' => $paginate));
					}
					?>					
				</div>
			</div>
		</div>
	</div>
	<!-- END: Content -->
</div>