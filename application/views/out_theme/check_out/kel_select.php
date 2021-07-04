<?php 
	$select_kel = json_decode($kelurahan_select,true);
	echo '<option value="">- Pilih Kelurahan -</option>';
	foreach($data_kelurahan as $list_kelurahan){
		if($select_kel == $list_kelurahan->id){
			echo '<option value="'.$list_kelurahan->id.'" selected>'.$list_kelurahan->name.'</option>';
		}else{
			echo '<option value="'.$list_kelurahan->id.'">'.$list_kelurahan->name.'</option>';
		}
	}
?>
