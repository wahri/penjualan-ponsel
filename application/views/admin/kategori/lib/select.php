<?php 
	if($induk == 0){
	?>
		<option value="0" selected>-- Pilih Kategori --</option>
<?php
	}else{
	?>
		<option value="0">-- Pilih Kategori --</option>
<?php
	}
	
	foreach ($kategori_parent as $parent) { 
		if($parent->id == 1){
			
		}
		else if($parent->id == $induk){
	?>
			<option value="<?php echo $parent->id; ?>" selected><?php echo $parent->kategori; ?></option>
			
<?php 	}else{ 
	?>
			<option value="<?php echo $parent->id; ?>"><?php echo $parent->kategori; ?></option>
<?php   }

		$child = $this->costume->get_child_kategory($parent->id);
		foreach ($child as $child) {
			if($child->id == $induk){
    ?>
				<option value="<?php echo $child->id ?>" selected>- <?php echo $child->kategori; ?></option>
				
<?php 		}else{ 
	?>				
				<option value="<?php echo $child->id ?>">- <?php echo $child->kategori; ?></option>
				
<?php 		}
		$childest = $this->costume->get_child_kategory($child->id);
			foreach ($childest as $childest) {
				if($childest->id == $induk){
    ?>
					<option value="<?php echo $childest->id; ?>" selected>-- <?php echo $childest->kategori ?></option>
					
<?php 			}else{ 					
	?>					
					<option value="<?php echo $childest->id; ?>">-- <?php echo $childest->kategori ?></option>
					
<?php 			} 
			}
		}
	} 
	?>