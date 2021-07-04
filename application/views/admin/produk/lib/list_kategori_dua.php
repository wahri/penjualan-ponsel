<?php
	if(!empty($kategori_parent_dua)){
?>

	<option>-- Pilih Kategori --</option>
<?php
	foreach ($kategori_parent_dua as $parent_dua) { 
	?>
			<option value="<?php echo $parent_dua->id; ?>" <?php if (!empty ($catagory_select[1])){ if($catagory_select[1] == $parent_dua->id){echo 'selected';} }  ?>><?php echo $parent_dua->category; ?></option>
<?php 			
	} 
	}
?>