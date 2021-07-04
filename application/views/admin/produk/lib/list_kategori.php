<option>-- Pilih Kategori -- </option>
<?php
	foreach ($kategori_parent as $parent) { 
	?>
			<option value="<?php echo $parent->id; ?>" <?php if (!empty ($catagory_select[0])){ if($catagory_select[0] == $parent->id){echo 'selected';} }  ?> ><?php echo $parent->category; ?></option>
<?php 			
	} 
	?>