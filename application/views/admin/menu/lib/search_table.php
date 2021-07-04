<?php foreach ($menu_parent as $category) { ?>
	<div class="product_price">
		<button type="button" class="close btn-delete-data" data-href="<?php echo url_web('admin/menu/delete'); ?>" data-id="<?php echo $category->id; ?>" data-title="<?php $category->nama_menu; ?>"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <h1 class="price-tax"><?php echo $category->nama_menu; ?></h1>
	  <p><?php echo $category->deskripsi_menu; ?></p>
	</div>
<?php 
	$child = $this->costume->get_child_menu($category->id);
	foreach ($child as $child) {
?>
		<div class="product_price" style="margin: 20px 0 0 40px !important">
			<button type="button" class="close btn-delete-data" data-href="<?php echo url_web('admin/menu/delete'); ?>" data-id="<?php echo $child->id; ?>" data-title="<?php $child->nama_menu; ?>"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <h1 class="price-tax"><?php echo $child->nama_menu; ?></h1>
		  <p><?php echo $child->deskripsi_menu; ?></p>
		</div>
<?php 
		$childest = $this->costume->get_child_menu($child->id);
		foreach ($childest as $childest) {
?>
			<div class="product_price" style="margin: 20px 0 0 80px !important">
				<button type="button" class="close btn-delete-data" data-href="<?php echo url_web('admin/menu/delete'); ?>" data-id="<?php echo $childest->id; ?>" data-title="<?php $childest->nama_menu; ?>"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <h1 class="price-tax"><?php echo $childest->nama_menu; ?></h1>
			  <p><?php echo $childest->deskripsi_menu; ?></p>
			</div>
<?php
		}
	}
}
?>