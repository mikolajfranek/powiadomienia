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
							<div class="tabulator-col" role="columnheader" aria-sort="none"
								style="min-width: 30px; width: 40px; display: none; height: 44px;"
								title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">&nbsp;</div>
									</div>
								</div>
							</div>
							<div class="tabulator-col" role="columnheader" aria-sort="asc"
								tabulator-field="name"
								style="min-width: 200px; height: 44px; width: 421px;" title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">PRODUCT NAME</div>
									</div>
								</div>
							</div>
							<div class="tabulator-col" role="columnheader" aria-sort="none"
								tabulator-field="images"
								style="min-width: 200px; height: 44px; width: 421px;" title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">IMAGES</div>
									</div>
								</div>
							</div>
							<div class="tabulator-col" role="columnheader" aria-sort="none"
								tabulator-field="remaining_stock"
								style="min-width: 200px; height: 44px; width: 421px;" title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">REMAINING STOCK</div>
									</div>
								</div>
							</div>
							<div class="tabulator-col" role="columnheader" aria-sort="none"
								tabulator-field="status"
								style="min-width: 200px; height: 44px; width: 421px;" title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">STATUS</div>
									</div>
								</div>
							</div>
							<div class="tabulator-col" role="columnheader" aria-sort="none"
								tabulator-field="actions"
								style="min-width: 200px; height: 44px; width: 424px;" title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">ACTIONS</div>
									</div>
								</div>
							</div>
							<div class="tabulator-col" role="columnheader" aria-sort="none"
								style="display: none; min-width: 40px; height: 44px;"
								tabulator-field="name" title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">PRODUCT NAME</div>
									</div>
								</div>
							</div>
							<div class="tabulator-col" role="columnheader" aria-sort="none"
								style="display: none; min-width: 40px; height: 44px;"
								tabulator-field="category" title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">CATEGORY</div>
									</div>
								</div>
							</div>
							<div class="tabulator-col" role="columnheader" aria-sort="none"
								style="display: none; min-width: 40px; height: 44px;"
								tabulator-field="remaining_stock" title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">REMAINING STOCK</div>
									</div>
								</div>
							</div>
							<div class="tabulator-col" role="columnheader" aria-sort="none"
								style="display: none; min-width: 40px; height: 44px;"
								tabulator-field="status" title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">STATUS</div>
									</div>
								</div>
							</div>
							<div class="tabulator-col" role="columnheader" aria-sort="none"
								style="display: none; min-width: 40px; height: 44px;"
								tabulator-field="images" title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">IMAGE 1</div>
									</div>
								</div>
							</div>
							<div class="tabulator-col" role="columnheader" aria-sort="none"
								style="display: none; min-width: 40px; height: 44px;"
								tabulator-field="images" title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">IMAGE 2</div>
									</div>
								</div>
							</div>
							<div class="tabulator-col" role="columnheader" aria-sort="none"
								style="display: none; min-width: 40px; height: 44px;"
								tabulator-field="images" title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">IMAGE 3</div>
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




								<div class="tabulator-cell tabulator-row-handle" role="gridcell"
									style="width: 40px; text-align: center; display: none; height: 64px;"
									title="">
									<div class="tabulator-responsive-collapse-toggle open">
										<span class="tabulator-responsive-collapse-toggle-open">+</span><span
											class="tabulator-responsive-collapse-toggle-close">-</span>
									</div>
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									style="width: 421px; display: inline-flex; align-items: center; height: 64px;"
									tabulator-field="name" title="">
									<div>
										<div class="font-medium whitespace-nowrap">Apple MacBook Pro
											13</div>
										<div class="text-gray-600 text-xs whitespace-nowrap">PC &amp;
											Laptop</div>
									</div>
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>

<!--  @media (max-width:768px) {  -->
<!-- md:inline-flex -->
								<div class="tabulator-cell md:inline-flex" role="gridcell"
									style="width: 421px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;"
									tabulator-field="images" title="">
									<div class="flex lg:justify-center">
										<div class="intro-x w-10 h-10 image-fit">
											<img alt="Rubick Tailwind HTML Admin Template"
												class="rounded-full" src="/dist/images/preview-7.jpg">
										</div>
										<div class="intro-x w-10 h-10 image-fit -ml-5">
											<img alt="Rubick Tailwind HTML Admin Template"
												class="rounded-full" src="/dist/images/preview-9.jpg">
										</div>
										<div class="intro-x w-10 h-10 image-fit -ml-5">
											<img alt="Rubick Tailwind HTML Admin Template"
												class="rounded-full" src="/dist/images/preview-1.jpg">
										</div>
									</div>
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									style="width: 421px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;"
									tabulator-field="remaining_stock" title="">
									89
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									style="width: 421px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;"
									tabulator-field="status" title="">
									<div class="flex items-center lg:justify-center text-theme-6">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
											viewBox="0 0 24 24" fill="none" stroke="currentColor"
											stroke-width="1.5" stroke-linecap="round"
											stroke-linejoin="round"
											class="feather feather-check-square w-4 h-4 mr-2">
									<polyline points="9 11 12 14 22 4"></polyline>
									<path
												d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
										Inactive
									</div>
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									style="width: 424px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;"
									tabulator-field="actions" title="">
									<div class="flex lg:justify-center items-center">
										<a class="edit flex items-center mr-3" href="javascript:;"> <svg
												xmlns="http://www.w3.org/2000/svg" width="24" height="24"
												viewBox="0 0 24 24" fill="none" stroke="currentColor"
												stroke-width="1.5" stroke-linecap="round"
												stroke-linejoin="round"
												class="feather feather-check-square w-4 h-4 mr-1">
										<polyline points="9 11 12 14 22 4"></polyline>
										<path
													d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
											Edit
										</a> <a class="delete flex items-center text-theme-6"
											href="javascript:;"> <svg xmlns="http://www.w3.org/2000/svg"
												width="24" height="24" viewBox="0 0 24 24" fill="none"
												stroke="currentColor" stroke-width="1.5"
												stroke-linecap="round" stroke-linejoin="round"
												class="feather feather-trash-2 w-4 h-4 mr-1">
										<polyline points="3 6 5 6 21 6"></polyline>
										<path
													d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
										<line x1="10" y1="11" x2="10" y2="17"></line>
										<line x1="14" y1="11" x2="14" y2="17"></line></svg> Delete
										</a>
									</div>
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									tabulator-field="name" style="display: none; height: 64px;"
									title="">
									Apple MacBook Pro 13
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									tabulator-field="category" style="display: none; height: 64px;"
									title="">
									PC &amp; Laptop
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									tabulator-field="remaining_stock"
									style="display: none; height: 64px;" title="">
									89
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									tabulator-field="status" style="display: none; height: 64px;"
									title="">
									0
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									tabulator-field="images" style="display: none; height: 64px;"
									title="">
									preview-7.jpg,preview-9.jpg,preview-1.jpg
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									tabulator-field="images" style="display: none; height: 64px;"
									title="">
									preview-7.jpg,preview-9.jpg,preview-1.jpg
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									tabulator-field="images" style="display: none; height: 64px;"
									title="">
									preview-7.jpg,preview-9.jpg,preview-1.jpg
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>




<!--  @media (min-width:768px) {  -->


			                     <!-- mobile -->
								<div class="tabulator-responsive-collapse md:hidden">
									<table>
										<tr>
											<td><strong>AIMAGES</strong></td>
											<td><div class="flex lg:justify-center">
													<div class="intro-x w-10 h-10 image-fit">
														<img alt="Rubick Tailwind HTML Admin Template"
															class="rounded-full" src="/dist/images/preview-7.jpg">
													</div>
													<div class="intro-x w-10 h-10 image-fit -ml-5">
														<img alt="Rubick Tailwind HTML Admin Template"
															class="rounded-full" src="/dist/images/preview-9.jpg">
													</div>
													<div class="intro-x w-10 h-10 image-fit -ml-5">
														<img alt="Rubick Tailwind HTML Admin Template"
															class="rounded-full" src="/dist/images/preview-1.jpg">
													</div>
												</div></td>
										</tr>
										<tr>
											<td><strong>REMAINING STOCK</strong></td>
											<td>89</td>
										</tr>
										<tr>
											<td><strong>STATUS</strong></td>
											<td><div
													class="flex items-center lg:justify-center text-theme-6">
													<svg xmlns="http://www.w3.org/2000/svg" width="24"
														height="24" viewBox="0 0 24 24" fill="none"
														stroke="currentColor" stroke-width="1.5"
														stroke-linecap="round" stroke-linejoin="round"
														class="feather feather-check-square w-4 h-4 mr-2">
														<polyline points="9 11 12 14 22 4"></polyline>
														<path
															d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
													Inactive
												</div></td>
										</tr>
										<tr>
											<td><strong>ACTIONS</strong></td>
											<td><div>
													<div class="flex lg:justify-center items-center">
														<a class="edit flex items-center mr-3" href="javascript:;">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
																height="24" viewBox="0 0 24 24" fill="none"
																stroke="currentColor" stroke-width="1.5"
																stroke-linecap="round" stroke-linejoin="round"
																class="feather feather-check-square w-4 h-4 mr-1">
																<polyline points="9 11 12 14 22 4"></polyline>
																<path
																	d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
															Edit
														</a> <a class="delete flex items-center text-theme-6"
															href="javascript:;"> <svg
																xmlns="http://www.w3.org/2000/svg" width="24"
																height="24" viewBox="0 0 24 24" fill="none"
																stroke="currentColor" stroke-width="1.5"
																stroke-linecap="round" stroke-linejoin="round"
																class="feather feather-trash-2 w-4 h-4 mr-1">
																<polyline points="3 6 5 6 21 6"></polyline>
																<path
																	d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
																<line x1="10" y1="11" x2="10" y2="17"></line>
																<line x1="14" y1="11" x2="14" y2="17"></line></svg>
															Delete
														</a>
													</div>
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