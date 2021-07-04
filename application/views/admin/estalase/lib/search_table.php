		<?php foreach ($kategori_parent as $category) { ?>	
		<tr>
			<td><input type="checkbox" name="select-checkbox[]" id="blankCheckbox" class="select-checkbox" value="<?php echo $category->id; ?>"aria-label="..."></td>
			<td><?php echo $category->estalase; ?></td>
			<td><?php echo $category->deskripsi; ?></td>
			<td>
				<a href="<?php echo url_web('admin/estalase/edit/' . $category->id); ?>" style="border-right: 1px solid #999;padding: 0 10px;"><i class="fa fa-edit"></i> Sunting</a>
				<a href="<?php echo url_web('admin/estalase/delete/' . $category->id); ?>" class="text-danger btn-delete-data" style="padding: 0 10px;"><i class="fa fa-trash"></i> Hapus</a>
			</td>
		</tr>
	<?php } ?>
	  