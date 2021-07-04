<?php 
	$select_kab = json_decode($kabupaten_select,true);
	echo '<option value="">- Pilih Kabupaten -</option>';
	foreach($data_kabupaten as $list_kabupaten){
		if($select_kab == $list_kabupaten->id){
			echo '<option value="'.$list_kabupaten->id.'" selected>'.$list_kabupaten->name.'</option>';
		}else{
			echo '<option value="'.$list_kabupaten->id.'">'.$list_kabupaten->name.'</option>';
		}
	}
?>
