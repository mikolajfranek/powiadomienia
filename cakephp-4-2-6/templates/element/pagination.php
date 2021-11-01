<?php if ($paginate['pageCount'] > 1): ?>
<div class="tabulator-footer">
	<span class="tabulator-paginator justify-center textAlignCenter mt-5 mb-5">
		<?php 
		     $classesFirst = "tabulator-page";
		     if($paginate['page'] === 1)
		     {
		         $classesFirst .= " noClick"; 
		     }
	   	     echo $this->Html->link("Pierwsza",
	   	         array("controller" => "users", "action" => "results"),
	   	         array("class" => $classesFirst));
	    ?>
		<span class="tabulator-pages">
			<?php if($paginate['prevPage'] === true): ?>
			   	<?php
			   	     echo $this->Html->link(($paginate['page'] - 1),
			   	         array("controller" => "users", "action" => "results" . "/". ($paginate['page'] - 1)),
			   	         array("class" => "tabulator-page"));
	            ?>
			<?php endif;?>
			<button class="tabulator-page active noClick"><?=$paginate['page'] ?></button>
			<?php if($paginate['nextPage'] === true): ?>
				<?php
			   	     echo $this->Html->link(($paginate['page'] + 1),
			   	         array("controller" => "users", "action" => "results" . "/". ($paginate['page'] + 1)),
			   	         array("class" => "tabulator-page"));
	            ?>
			<?php endif;?>
		</span>
		<?php 
		     $classesLast = "tabulator-page";
		     if($paginate['page'] === $paginate['pageCount'])
		     {
		         $classesLast .= " noClick"; 
		     }
	   	     echo $this->Html->link("Ostatnia",
	   	         array("controller" => "users", "action" => "results" . "/". ($paginate['pageCount'])),
	   	         array("class" => $classesLast));
	    ?>
	</span>
</div>
<?php endif; ?>