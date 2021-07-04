
	<option value="0">-- Pilih Kategori --</option>
<?php
	foreach ($kategori_parent as $parent) { 
	?>
		<option value="<?php echo $parent->url_kategori; ?>"><?php echo $parent->kategori; ?></option>
<?php   

		$child = $this->costume->get_child_kategory($parent->id);
		foreach ($child as $child) {
	?>				
				<option value="<?php echo $child->url_kategori; ?>">- <?php echo $child->kategori; ?></option>
				
<?php 		
		$childest = $this->costume->get_child_kategory($child->id);
			foreach ($childest as $childest) {
?>
					<option value="<?php echo $childest->url_kategori; ?>">-- <?php echo $childest->kategori ?></option>
					
<?php 			
			}
		}
	}
	?>