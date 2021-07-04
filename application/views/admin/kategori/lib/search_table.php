		<?php foreach ($kategori_parent as $category) { ?>	
		<tr>
			<td><input type="checkbox" name="select-checkbox[]" id="blankCheckbox" class="select-checkbox" value="<?php echo $category->id; ?>"aria-label="..."></td>
			<td><?php echo $category->kategori; ?></td>
			<td><?php echo $category->deskripsi; ?></td>
			<td>
				<a href="<?php echo url_web('admin/kategori/edit/' . $category->id); ?>" style="border-right: 1px solid #999;padding: 0 10px;"><i class="fa fa-edit"></i> Sunting</a>
				<a href="<?php echo url_web('admin/kategori/delete/' . $category->id); ?>" class="text-danger btn-delete-data" style="padding: 0 10px;"><i class="fa fa-trash"></i> Hapus</a>
			</td>
		</tr>
		<?php 
			
			$child = $this->costume->get_child_kategory($category->id);
			foreach ($child as $child) {
            ?>
			<tr>
				<td><input type="checkbox" name="select-checkbox[]" id="blankCheckbox"class="select-checkbox" value="<?php echo $child->id; ?>"aria-label="..."></td>
				<td>--> <?php echo $child->kategori; ?></td>
				<td><?php echo $child->deskripsi; ?></td>
				<td>
					<a href="<?php echo url_web('admin/kategori/edit/' . $child->id); ?>" style="border-right: 1px solid #999;padding: 0 10px;"><i class="fa fa-edit"></i> Sunting</a>
					<a href="<?php echo url_web('admin/kategori/delete/' . $child->id); ?>" class="text-danger btn-delete-data" style="padding: 0 10px;"><i class="fa fa-trash"></i> Hapus</a>
				</td>
			</tr>
		<?php $childest = $this->costume->get_child_kategory($child->id);
            foreach ($childest as $childest) {
                ?>
                <tr>
					<td><input type="checkbox" name="select-checkbox[]" id="blankCheckbox"class="select-checkbox" value="<?php echo $childest->id; ?>"aria-label="..."></td>
					<td>-- --> <?php echo $childest->kategori; ?></td>
					<td><?php echo $childest->deskripsi; ?></td>
					<td>
						<a href="<?php echo url_web('admin/kategori/edit/' . $childest->id); ?>" style="border-right: 1px solid #999;padding: 0 10px;"><i class="fa fa-edit"></i> Sunting</a>
						<a href="<?php echo url_web('admin/kategori/delete/' . $childest->id); ?>" class="text-danger btn-delete-data" style="padding: 0 10px;"><i class="fa fa-trash"></i> Hapus</a>
					</td>
			<?php } ?>
		<?php }?>
	<?php } ?>
	  