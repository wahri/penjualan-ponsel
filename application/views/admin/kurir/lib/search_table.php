		<?php foreach ($kategori_parent as $category) { ?>	
		<tr>
			<td><input type="checkbox" name="select-checkbox[]" id="blankCheckbox" class="select-checkbox" value="<?php echo $category->id; ?>"aria-label="..."></td>
			<td>
				<?php 
				if($category->gambar == 0){
					echo "---";
				}else{
					echo "<img src='".base_url($this->costume->get_original($category->gambar,'original')->row()->url)."' height='30'></img>";
					
				}
				?>
			</td>
			<td><?php echo $category->kurir; ?></td>
			<td>
				<a href="<?php echo url_web('admin/kurir/edit/' . $category->id); ?>" style="border-right: 1px solid #999;padding: 0 10px;"><i class="fa fa-edit"></i> Sunting</a>
				<a href="<?php echo url_web('admin/kurir/delete/' . $category->id); ?>" class="text-danger btn-delete-data" style="padding: 0 10px;"><i class="fa fa-trash"></i> Hapus</a>
			</td>
		</tr>
		<?php 
			
			$child = $this->costume->get_child_kurir($category->id);
			foreach ($child as $child) {
            ?>
				<tr>
					<td><input type="checkbox" name="select-checkbox[]" id="blankCheckbox"class="select-checkbox" value="<?php echo $child->id; ?>"aria-label="..."></td>
					<td>
					<?php 
					if($child->gambar == 0){
						echo "---";
					}else{
						echo "<img src='".base_url($this->costume->get_original($child->gambar,'original')->row()->url)."' height='30'></img>";
						
					}
					?>
					</td>
					<td><?php echo $child->kurir; ?></td>
					<td>
						<a href="<?php echo url_web('admin/kurir/edit/' . $child->id); ?>" style="border-right: 1px solid #999;padding: 0 10px;"><i class="fa fa-edit"></i> Sunting</a>
						<a href="<?php echo url_web('admin/kurir/delete/' . $child->id); ?>" class="text-danger btn-delete-data" style="padding: 0 10px;"><i class="fa fa-trash"></i> Hapus</a>
					</td>
			</tr>
		<?php $childest = $this->costume->get_child_kurir($child->id);
            foreach ($childest as $childest) {
                ?>
                <tr>
					<td><input type="checkbox" name="select-checkbox[]" id="blankCheckbox"class="select-checkbox" value="<?php echo $childest->id; ?>"aria-label="..."></td>
					<td>
					<?php 
					if($childest->gambar == 0){
						echo "---";
					}else{
						echo "<img src='".base_url($this->costume->get_original($childest->gambar,'original')->row()->url)."' height='30'></img>";
						
					}
					?>
					</td>
					<td><?php echo $childest->kurir; ?></td>
					<td>
						<a href="<?php echo url_web('admin/kurir/edit/' . $childest->id); ?>" style="border-right: 1px solid #999;padding: 0 10px;"><i class="fa fa-edit"></i> Sunting</a>
						<a href="<?php echo url_web('admin/kurir/delete/' . $childest->id); ?>" class="text-danger btn-delete-data" style="padding: 0 10px;"><i class="fa fa-trash"></i> Hapus</a>
					</td>
			<?php } ?>
		<?php }?>
	<?php } ?>
	  