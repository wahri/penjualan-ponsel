
		<option value="0">-- Semua Estalase --</option>
<?php
	
	
	foreach ($estalase_parent as $parent) { 
	?>

			<option value="<?php echo $parent->id; ?>" <?php if($etalase_select == $parent->id){ echo'selected';} ?>><?php echo $parent->estalase; ?></option>
<?php   

	} 
	?>