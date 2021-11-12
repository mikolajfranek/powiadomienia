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
					<!-- top ok -->















					<!-- header -->
					<div class="tabulator-header noClick"
						style="padding-right: 0px; margin-left: 0px;">
						<div class="tabulator-headers" style="margin-left: 0px;">



							<div class="tabulator-col" role="columnheader" aria-sort="asc"
								tabulator-field="name"
								style="min-width: 200px; height: 44px; width: 421px;" title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">0000</div>
									</div>
								</div>
							</div>

							<div class="tabulator-col md:inline-flex" role="columnheader"
								aria-sort="none" tabulator-field="images"
								style="min-width: 200px; height: 44px; width: 421px;" title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">1111</div>
									</div>
								</div>
							</div>
							<div class="tabulator-col md:inline-flex" role="columnheader"
								aria-sort="none" tabulator-field="remaining_stock"
								style="min-width: 200px; height: 44px; width: 421px;" title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">2222</div>
									</div>
								</div>
							</div>
							<div class="tabulator-col md:inline-flex" role="columnheader"
								aria-sort="none" tabulator-field="status"
								style="min-width: 200px; height: 44px; width: 421px;" title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">3333</div>
									</div>
								</div>
							</div>
							<div class="tabulator-col md:inline-flex" role="columnheader"
								aria-sort="none" tabulator-field="actions"
								style="min-width: 200px; height: 44px; width: 424px;" title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">4444</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tabulator-frozen-rows-holder"></div>
					</div>




					<!-- content -->
					<div class="tabulator-tableHolder" tabindex="0">
						<div class="tabulator-table"
							style="padding-top: 0px; padding-bottom: 0px;">
						<?php $rowOdd = true; ?>
        				<?php foreach($resultsOfUser as $result): ?>
        					<div
								class="tabulator-row tabulator-selectable <?php echo ($rowOdd ? "tabulator-row-odd" : "tabulator-row-even"); ?>"
								role="row" style="padding-left: 0px;">



								<div class="tabulator-cell" role="gridcell"
									style="width: 421px; display: inline-flex; align-items: center; height: 64px;"
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

								<!--  @media (max-width:768px) {  -->
								
								
								<!-- md:inline-flex -->
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





								<!--  @media (min-width:768px) {  -->







								<!-- mobile -->
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
							</div>









						<?php $rowOdd = $rowOdd ? false : true; ?>
						<?php endforeach; ?>
						</div>
					</div>
					<?php echo $this->element('pagination', array('paginate' => $paginate)); ?>
				</div>
			</div>
		</div>
	</div>
	<!-- END: Content -->
</div>