
	<option value="0">-- Pilih halaman --</option>
<?php
	foreach ($halaman_parent as $parent) { 
	?>
		<option value="<?php echo $parent->url_page; ?>"><?php echo $parent->judul_page; ?></option>

<?php 			
	}
	?>