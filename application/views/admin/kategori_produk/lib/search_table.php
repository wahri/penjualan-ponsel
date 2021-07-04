		<?php foreach ($kategori_parent as $category) { ?>	
		<tr>
			<td><input type="checkbox" name="select-checkbox[]" id="blankCheckbox" class="select-checkbox" value="<?php echo $category->id; ?>"aria-label="..."></td>
			<td><?php echo $category->category; ?></td>
			<td><?php echo $category->deskripsi; ?></td>
			<td>
				<a href="<?php echo url_web('admin/kategori_produk/edit/' . $category->id); ?>" style="border-right: 1px solid #999;padding: 0 10px;"><i class="fa fa-edit"></i> Sunting</a>
				<a href="<?php echo url_web('admin/kategori_produk/delete/' . $category->id); ?>" class="text-danger btn-delete-data" style="padding: 0 10px;"><i class="fa fa-trash"></i> Hapus</a>
			</td>
		</tr>
		<?php 
			
			$child = $this->costume->get_child_kategory_product($category->id);
			foreach ($child as $child) {
            ?>
			<tr>
				<td><input type="checkbox" name="select-checkbox[]" id="blankCheckbox"class="select-checkbox" value="<?php echo $child->id; ?>"aria-label="..."></td>
				<td>--> <?php echo $child->category; ?></td>
				<td><?php echo $child->deskripsi; ?></td>
				<td>
					<a href="<?php echo url_web('admin/kategori_produk/edit/' . $child->id); ?>" style="border-right: 1px solid #999;padding: 0 10px;"><i class="fa fa-edit"></i> Sunting</a>
					<a href="<?php echo url_web('admin/kategori_produk/delete/' . $child->id); ?>" class="text-danger btn-delete-data" style="padding: 0 10px;"><i class="fa fa-trash"></i> Hapus</a>
				</td>
			</tr>
		<?php $childest = $this->costume->get_child_kategory_product($child->id);
            foreach ($childest as $childest) {
                ?>
                <tr>
					<td><input type="checkbox" name="select-checkbox[]" id="blankCheckbox"class="select-checkbox" value="<?php echo $childest->id; ?>"aria-label="..."></td>
					<td>-- --> <?php echo $childest->category; ?></td>
					<td><?php echo $childest->deskripsi; ?></td>
					<td>
						<a href="<?php echo url_web('admin/kategori_produk/edit/' . $childest->id); ?>" style="border-right: 1px solid #999;padding: 0 10px;"><i class="fa fa-edit"></i> Sunting</a>
						<a href="<?php echo url_web('admin/kategori_produk/delete/' . $childest->id); ?>" class="text-danger btn-delete-data" style="padding: 0 10px;"><i class="fa fa-trash"></i> Hapus</a>
					</td>
			<?php } ?>
		<?php }?>
	<?php } ?>
	  