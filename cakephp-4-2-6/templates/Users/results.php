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
			<h2 class="text-lg font-medium mr-auto">Wyniki</h2>
		</div>
		<div class="intro-y box p-5 mt-5">
			<div class="overflow-x-auto scrollbar-hidden">
				<div class="tabulator">
					<div class="tabulator-footer">
    					<span class="tabulator-paginator justify-center">
    				
    				
    							<!--  
    							paginator na dole i na górze
    							todo  -->
                				
                					<button class="tabulator-page " type="button" role="button"
                						aria-label="First Page" title="First Page" data-page="first"
                						disabled="">First</button>
                						
                					<button class="tabulator-page" type="button" role="button"
                						aria-label="Prev Page" title="Prev Page" data-page="prev"
                						disabled="">Prev</button> 

                						<span class="tabulator-pages">
                    						<button
                    							class="tabulator-page active" type="button" role="button"
                    							aria-label="Show Page 1" title="Show Page 1" data-page="1">1</button>
                    							
                    						<button class="tabulator-page" type="button" role="button"
                    							aria-label="Show Page 2" title="Show Page 2" data-page="2">2</button>
                						</span>
                						
                					<button class="tabulator-page" type="button" role="button"
                						aria-label="Next Page" title="Next Page" data-page="next">Next</button>
                					<button class="tabulator-page" type="button" role="button"
                						aria-label="Last Page" title="Last Page" data-page="last">Last</button>

                				
    					</span>
        			</div>
				</div>
				<div class="mt-5 table-report table-report--tabulator tabulator" role="grid" tabulator-layout="fitColumns" >



			
    							<!--  todo  -->


				

					<div class="tabulator-header"
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

								<div class="tabulator-col-resize-handle"></div>
								<div class="tabulator-col-resize-handle prev"></div>
							</div>
							
							
							
							<div class="tabulator-col" role="columnheader"
								style="min-width: 200px; height: 44px; width: 200px;" title="">
								<div class="tabulator-col-content">
									<div class="tabulator-col-title-holder">
										<div class="tabulator-col-title">PRODUCT NAME</div>
									</div>
								</div>
							</div>
							
							
							
						</div>
						<div class="tabulator-frozen-rows-holder"></div>
					</div>

					<div class="tabulator-tableHolder" tabindex="0"
						style="height: 661px;">
						<div class="tabulator-table"
							style="padding-top: 0px; padding-bottom: 0px;">
							<div class="tabulator-row tabulator-selectable tabulator-row-odd"
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
									style="width: 546px; display: inline-flex; align-items: center; height: 64px;"
									tabulator-field="name" title="">
									<div>
										<div class="font-medium whitespace-nowrap">Samsung Q90 QLED TV</div>
										<div class="text-gray-600 text-xs whitespace-nowrap">Electronic</div>
									</div>

									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									style="width: 546px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;"
									tabulator-field="images" title="">
									<div class="flex lg:justify-center">
										<div class="intro-x w-10 h-10 image-fit">
											<img alt="Rubick Tailwind HTML Admin Template"
												class="rounded-full" src="/dist/images/preview-10.jpg">
										</div>
										<div class="intro-x w-10 h-10 image-fit -ml-5">
											<img alt="Rubick Tailwind HTML Admin Template"
												class="rounded-full" src="/dist/images/preview-4.jpg">
										</div>
										<div class="intro-x w-10 h-10 image-fit -ml-5">
											<img alt="Rubick Tailwind HTML Admin Template"
												class="rounded-full" src="/dist/images/preview-5.jpg">
										</div>
									</div>
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									style="width: 546px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;"
									tabulator-field="remaining_stock" title="">
									70
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									style="width: 546px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;"
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
									style="width: 546px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;"
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
									Samsung Q90 QLED TV
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									tabulator-field="category" style="display: none; height: 64px;"
									title="">
									Electronic
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									tabulator-field="remaining_stock"
									style="display: none; height: 64px;" title="">
									70
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
									preview-10.jpg,preview-4.jpg,preview-5.jpg
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									tabulator-field="images" style="display: none; height: 64px;"
									title="">
									preview-10.jpg,preview-4.jpg,preview-5.jpg
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									tabulator-field="images" style="display: none; height: 64px;"
									title="">
									preview-10.jpg,preview-4.jpg,preview-5.jpg
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-responsive-collapse"></div>
							</div>
							<div
								class="tabulator-row tabulator-selectable tabulator-row-even"
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
									style="width: 546px; display: inline-flex; align-items: center; height: 64px;"
									tabulator-field="name" title="">
									<div>
										<div class="font-medium whitespace-nowrap">Nike Tanjun</div>
										<div class="text-gray-600 text-xs whitespace-nowrap">Sport
											&amp; Outdoor</div>
									</div>
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									style="width: 546px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;"
									tabulator-field="images" title="">
									<div class="flex lg:justify-center">
										<div class="intro-x w-10 h-10 image-fit">
											<img alt="Rubick Tailwind HTML Admin Template"
												class="rounded-full" src="/dist/images/preview-8.jpg">
										</div>
										<div class="intro-x w-10 h-10 image-fit -ml-5">
											<img alt="Rubick Tailwind HTML Admin Template"
												class="rounded-full" src="/dist/images/preview-7.jpg">
										</div>
										<div class="intro-x w-10 h-10 image-fit -ml-5">
											<img alt="Rubick Tailwind HTML Admin Template"
												class="rounded-full" src="/dist/images/preview-13.jpg">
										</div>
									</div>
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									style="width: 546px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;"
									tabulator-field="remaining_stock" title="">
									101
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									style="width: 546px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;"
									tabulator-field="status" title="">
									<div class="flex items-center lg:justify-center text-theme-9">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
											viewBox="0 0 24 24" fill="none" stroke="currentColor"
											stroke-width="1.5" stroke-linecap="round"
											stroke-linejoin="round"
											class="feather feather-check-square w-4 h-4 mr-2">
											<polyline points="9 11 12 14 22 4"></polyline>
											<path
												d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
										Active
									</div>
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									style="width: 546px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;"
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
									Nike Tanjun
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									tabulator-field="category" style="display: none; height: 64px;"
									title="">
									Sport &amp; Outdoor
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									tabulator-field="remaining_stock"
									style="display: none; height: 64px;" title="">
									101
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									tabulator-field="status" style="display: none; height: 64px;"
									title="">
									1
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									tabulator-field="images" style="display: none; height: 64px;"
									title="">
									preview-8.jpg,preview-7.jpg,preview-13.jpg
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									tabulator-field="images" style="display: none; height: 64px;"
									title="">
									preview-8.jpg,preview-7.jpg,preview-13.jpg
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-cell" role="gridcell"
									tabulator-field="images" style="display: none; height: 64px;"
									title="">
									preview-8.jpg,preview-7.jpg,preview-13.jpg
									<div class="tabulator-col-resize-handle"></div>
									<div class="tabulator-col-resize-handle prev"></div>
								</div>
								<div class="tabulator-responsive-collapse"></div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>
	<!-- END: Content -->
</div>