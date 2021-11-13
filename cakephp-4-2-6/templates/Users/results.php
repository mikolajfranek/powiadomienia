<?php
use Cake\Core\Configure;
$games = Configure::read('Config.Games');

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
					<?php echo $this->element('pagination', array('paginate' => $paginate)); ?>
					<!-- TODO: top ok -->
					<!-- TODO: move pagination under filter? -->







					<!-- BEGIN: Filter -->
					<div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
						<form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto">
							<div class="sm:flex items-center sm:mr-4">
								<label class="w-22 flex-none xl:w-auto mr-2">Gra hazardowa</label>
								<select id="tabulator-html-filter-field"
									class="form-select w-full sm:w-32 xxl:w-full mt-2 sm:mt-0 sm:w-auto">
									<option value="name">Name</option>
									<option value="category">Category</option>
									<option value="remaining_stock">Remaining Stock</option>
								</select>
							</div>
							<div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
								<label class="w-22 flex-none xl:w-auto xl:flex-initial mr-2">Stopień wygranej</label>
								<select id="tabulator-html-filter-type"
									class="form-select w-full mt-2 sm:mt-0 sm:w-auto">
									<option value="like" selected="">like</option>
									<option value="=">=</option>
                					<option value=">">&gt;</option>
                					<option value=">=">&gt;=</option>
                					<option value="!=">!=</option>
                				</select>
                			</div>
                			<div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                				<label class="w-22 flex-none xl:w-auto xl:flex-initial mr-2">Zakład</label>
                				<input id="tabulator-html-filter-value" type="text"
                									class="form-control sm:w-40 xxl:w-full mt-2 sm:mt-0"
                									placeholder="Search...">
                			</div>
                			<div class="mt-2 xl:mt-0">
                				<button id="tabulator-html-filter-go" type="button"
                									class="btn btn-primary w-full sm:w-16">Filtruj</button>
                				<button id="tabulator-html-filter-reset" type="button"
                									class="btn btn-secondary w-full sm:w-16 mt-2 sm:mt-0 sm:ml-1">Resetuj</button>
                			</div>
                		</form>
                	</div>
                    <!-- END: Filter -->







										<!-- BEGIN: Content table-->
					<div class="tabulator-tableHolder" tabindex="0">
						<div class="tabulator-table"
												style="padding-top: 20px; padding-bottom: 0px; display: grid;">




                            <!-- BEGIN: Header -->
							<div class="tabulator-header noClick"
													style="padding-right: 0px; margin-left: 0px;">
								<div class="tabulator-headers" style="margin-left: 0px;">

									<div class="tabulator-col" role="columnheader" aria-sort="asc"
															tabulator-field="name"
															style="min-width: 100px; height: 44px; width: 121px;"
															title="">
										<div class="tabulator-col-content">
											<div class="tabulator-col-title-holder">
												<div class="tabulator-col-title">0000</div>
											</div>
										</div>
									</div>

									<div class="tabulator-col md:inline-flex textAlignCenter"
															role="columnheader" aria-sort="none"
															tabulator-field="images"
															style="min-width: 200px; height: 44px; width: 421px;"
															title="">
										<div class="tabulator-col-content">
											<div class="tabulator-col-title-holder">
												<div class="tabulator-col-title">1111</div>
											</div>
										</div>
									</div>

									<div class="tabulator-col md:inline-flex textAlignCenter"
															role="columnheader" aria-sort="none"
															tabulator-field="remaining_stock"
															style="min-width: 200px; height: 44px; width: 421px;"
															title="">
										<div class="tabulator-col-content">
											<div class="tabulator-col-title-holder">
												<div class="tabulator-col-title">2222</div>
											</div>
										</div>
									</div>

									<div class="tabulator-col md:inline-flex textAlignCenter"
															role="columnheader" aria-sort="none"
															tabulator-field="status"
															style="min-width: 200px; height: 44px; width: 421px;"
															title="">
										<div class="tabulator-col-content">
											<div class="tabulator-col-title-holder">
												<div class="tabulator-col-title">3333</div>
											</div>
										</div>
									</div>

									<div class="tabulator-col md:inline-flex textAlignCenter"
															role="columnheader" aria-sort="none"
															tabulator-field="actions"
															style="min-width: 200px; height: 44px; width: 424px;"
															title="">
										<div class="tabulator-col-content">
											<div class="tabulator-col-title-holder">
												<div class="tabulator-col-title">4444</div>
											</div>
										</div>
									</div>
								</div>
							</div>
                            <!-- END: Header -->

				
				
							
							<?php $rowOdd = true; ?>
        					<?php foreach($resultsOfUser as $result): ?>
        					<div
													class="tabulator-row tabulator-selectable noClick <?php echo ($rowOdd ? "tabulator-row-odd" : "tabulator-row-even"); ?>"
													role="row" style="padding-left: 0px;">

								<div class="tabulator-cell" role="gridcell"
														style="width: 121px; display: inline-flex; align-items: center; height: 64px;"
														tabulator-field="name" title="">
									<div>
										<div class="font-medium whitespace-nowrap">
										<?= date("d-m-Y", date_timestamp_get($result['date_lottery'])) ?>
										</div>
										<div class="text-gray-600 text-xs whitespace-nowrap">
										<?= date("d-m-Y", date_timestamp_get($result['date_lottery'])) ?>
										</div>
									</div>
								</div>

						        <!-- BEGIN: noMobile -->
								<div class="tabulator-cell md:inline-flex" role="gridcell"
														style="width: 421px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;"
														tabulator-field="images" title="">
									<div class="flex lg:justify-center">
										<?= $result['numbers_lottery'] ?>
									</div>
								</div>

								<div class="tabulator-cell md:inline-flex" role="gridcell"
														style="width: 421px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;"
														tabulator-field="remaining_stock" title="">
									<div class="flex lg:justify-center">
										<?= date("d-m-Y", date_timestamp_get($result['date_lottery'])) ?>
									</div>
								</div>

								<div class="tabulator-cell md:inline-flex" role="gridcell"
														style="width: 421px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;"
														tabulator-field="status" title="">
									<div class="flex lg:justify-center">
										<?= date("d-m-Y", date_timestamp_get($result['date_lottery'])) ?>
									</div>
								</div>

								<div class="tabulator-cell md:inline-flex" role="gridcell"
														style="width: 424px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;"
														tabulator-field="actions" title="">
									<div class="flex lg:justify-center">
										<?= date("d-m-Y", date_timestamp_get($result['date_lottery'])) ?>
									</div>
								</div>
                                <!-- END: noMobile -->

						        <!-- BEGIN: Mobile -->
								<div class="tabulator-responsive-collapse md:hidden">
									<table>
										<tr>
											<td><strong>1111</strong></td>
											<td><div class="flex lg:justify-center">
												<?= date("d-m-Y", date_timestamp_get($result['date_lottery'])) ?>
												</div></td>
										</tr>
										<tr>
											<td><strong>2222</strong></td>
											<td><div class="flex lg:justify-center">
												<?= date("d-m-Y", date_timestamp_get($result['date_lottery'])) ?>
												</div></td>
										</tr>
										<tr>
											<td><strong>3333</strong></td>
											<td><div class="flex lg:justify-center">
												<?= date("d-m-Y", date_timestamp_get($result['date_lottery'])) ?>
												</div></td>
										</tr>
										<tr>
											<td><strong>4444</strong></td>
											<td><div class="flex lg:justify-center">
												<?= date("d-m-Y", date_timestamp_get($result['date_lottery'])) ?>
												</div></td>
										</tr>
									</table>
								</div>
                                <!-- END: Mobile -->
								
								
								
								
								
								
								
								
								
								
								
								
								
							<!-- TODO: below is ok -->
							</div>
							<?php $rowOdd = $rowOdd ? false : true; ?>
							<?php endforeach; ?>
						</div>
					</div>
					<!-- END: Content table-->
					<?php echo $this->element('pagination', array('paginate' => $paginate)); ?>
				
									
									</div>
			</div>
		</div>
	</div>
	<!-- END: Content -->
</div>