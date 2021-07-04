		<?php foreach ($kategori_parent as $category) { ?>	
		<tr>
			<td><?php echo $category->pelanggan; ?></td>
			<td><?php echo $category->hp; ?></td>
			<td><?php echo $category->alamat; ?></td>
			<td><?php echo $this->costume->get_regional($category->kabupaten,'kabupaten')->row()->name; ?></td>
			<td><?php echo $this->costume->get_regional($category->kecamatan,'kecamatan')->row()->name; ?></td>
			<td><?php echo $this->costume->get_regional($category->kelurahan,'kelurahan')->row()->name; ?></td>
		</tr>
	<?php } ?>
	  