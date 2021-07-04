
		<option value="all">--Semua Kategori--</option>
<?php
	
	
	foreach ($kategori_parent as $parent) { 
	?>

			<option value="<?php echo $parent->id; ?>"><?php echo $parent->	category; ?></option>
<?php   

		$child = $this->costume->get_child_kategory_product($parent->id);
		foreach ($child as $child) {
    ?>			
				<option value="<?php echo $child->id ?>">- <?php echo $child->category; ?></option>
				
<?php 		
		$childest = $this->costume->get_child_kategory_product($child->id);
			foreach ($childest as $childest) {
    ?>
					<option value="<?php echo $childest->id; ?>">-- <?php echo $childest->category ?></option>
					
<?php 			
			}
		}
	} 
	?>