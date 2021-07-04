<?php
	if(!empty($kategori_parent_tiga)){
?>

	<option>-- Pilih Kategori --</option>
<?php
	foreach ($kategori_parent_tiga as $parent_tiga) { 
	?>
			<option value="<?php echo $parent_tiga->id; ?>" <?php if (!empty ($catagory_select[2])){ if($catagory_select[2] == $parent_tiga->id){echo 'selected';} }  ?>><?php echo $parent_tiga->category; ?></option>
<?php 			
	} 
	}
?>