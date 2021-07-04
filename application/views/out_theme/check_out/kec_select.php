<?php 
	$select_kec = json_decode($kecamatan_select,true);
	echo '<option value="">- Pilih Kecamatan -</option>';
	foreach($data_kecamatan as $list_kecamatan){
		if($select_kec == $list_kecamatan->id){
			echo '<option value="'.$list_kecamatan->id.'" selected>'.$list_kecamatan->name.'</option>';
		}else{
			echo '<option value="'.$list_kecamatan->id.'">'.$list_kecamatan->name.'</option>';
		}
	}
?>
