
		<option value="0">--Semua Merek--</option>
<?php
	
	
	foreach ($merek_parent as $parent) { 
	?>

			<option value="<?php echo $parent->id; ?>" <?php if($merek_select == $parent->id){ echo'selected';} ?>><?php echo $parent->merek; ?></option>
<?php   

	} 
	?>