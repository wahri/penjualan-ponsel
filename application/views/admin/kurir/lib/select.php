<?php 
	if($induk == 0){
	?>
		<option value="0" selected>-- Pilih kurir --</option>
<?php
	}else{
	?>
		<option value="0">-- Pilih kurir --</option>
<?php
	}
	
	foreach ($kategori_parent as $parent) { 
		if($parent->id == $induk){
	?>
			<option value="<?php echo $parent->id; ?>" selected><?php echo $parent->kurir; ?></option>
			
<?php 	}else{ 
	?>
			<option value="<?php echo $parent->id; ?>"><?php echo $parent->kurir; ?></option>
<?php   }

		$child = $this->costume->get_child_kurir($parent->id);
		foreach ($child as $child) {
			if($child->id == $induk){
    ?>
				<option value="<?php echo $child->id ?>" selected>- <?php echo $child->kurir; ?></option>
				
<?php 		}else{ 
	?>				
				<option value="<?php echo $child->id ?>">- <?php echo $child->kurir; ?></option>
				
<?php 		}
		$childest = $this->costume->get_child_kurir($child->id);
			foreach ($childest as $childest) {
				if($childest->id == $induk){
    ?>
					<option value="<?php echo $childest->id; ?>" selected>-- <?php echo $childest->kurir; ?></option>
					
<?php 			}else{ 					
	?>					
					<option value="<?php echo $childest->id; ?>">-- <?php echo $childest->kurir; ?></option>
					
<?php 			} 
			}
		}
	} 
	?>