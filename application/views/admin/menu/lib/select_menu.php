
	<option value="0">-- Tanpa Induk --</option>
<?php
	foreach ($menu_parent as $parent) { 
	?>
		<option value="<?php echo $parent->id; ?>"><?php echo $parent->nama_menu; ?></option>
<?php   

		$child = $this->costume->get_child_menu($parent->id);
		foreach ($child as $child) {
	?>				
				<option value="<?php echo $child->id ?>">- <?php echo $child->nama_menu; ?></option>
				
<?php 		
			$childest = $this->costume->get_child_menu($child->id);
			foreach ($childest as $childest) {
?>
					<option value="<?php echo $childest->id; ?>">-- <?php echo $childest->nama_menu; ?></option>
					
<?php 			
			}
		}
	}
	?>