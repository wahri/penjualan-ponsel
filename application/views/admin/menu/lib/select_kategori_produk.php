
	<option value="0">-- Pilih Kategori Produk --</option>
<?php
	foreach ($kategori_produk_parent as $parent) { 
	?>
		<option value="search_produk?cat=<?php echo $parent->id; ?>"><?php echo $parent->category; ?></option>
<?php   

		$child = $this->costume->get_kategori_produk($parent->id);
		foreach ($child as $child) {
	?>				
				<option value="search_produk?cat=<?php echo $child->id; ?>">- <?php echo $child->category; ?></option>
				
<?php 		
		$childest = $this->costume->get_kategori_produk($child->id);
			foreach ($childest as $childest) {
?>
					<option value="search_produk?cat=<?php echo $childest->id; ?>">-- <?php echo $childest->category; ?></option>
					
<?php 			
			}
		}
	}
	?>