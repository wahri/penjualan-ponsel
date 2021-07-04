<div class="x_panel">
	  <div class="x_title">
		<h2>Jumlah Semua (<?php echo $jumlah_semua; ?>)</h2>
		<div class="dataTables_paginate paging_simple_numbers nav navbar-right panel_toolbox" id="datatable-keytable_paginate">
		<?php 
			echo $this->pagination->create_links();
		?>
		</div>
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content">

		<table class="table">
		  <thead>
			<tr>
			  <th>Nama Iklan</th>
			  <th>posisi</th>
			  <th>mulai</th>
			  <th>akhir</th>
			  <th>harga</th>
			  <th>status</th>
			  <th>Aksi</th>
			</tr>
		  </thead>
		  <tbody id="tbodySearch">
			<?php 
			if (!empty($list_iklan_desktop)) { 
					foreach ($list_iklan_desktop as $lists) { 
			?>
				<tr class="even pointer list-baris-article">
					<td><?php echo $lists->nama_iklan; ?></td>
					<td><?php 
						$arrayKey = $this->costume->searchArrayKeyVal("id", $lists->posisi , $identity_link);
						if ($arrayKey!==false) {
							echo $identity_link[$arrayKey]['iklan'];
						}
						?>
					</td>
					<td><?php echo tgl_indo($lists->mulai); ?></td>
					<td><?php echo tgl_indo($lists->akhir); ?></td>
					<td>IDR. <?php echo $lists->harga_iklan; ?></td>
					<td><?php 
							if($lists->status == 1){
								echo '<span class="label label-default">Terjadwal</span>';
							}else if($lists->status == 2){
								echo '<span class="label label-primary">Aktive</span>';
							}else if($lists->status == 3){
								echo '<span class="label label-success">Expired</span>';
							}else{
								echo '<span class="label label-warning">batal</span>';
							}
						?>
					</td>
					<td>
						<a data-href="<?php echo url_web('admin/iklan/delete_'); ?>" data-id="<?php echo $lists->id; ?>" data-title="<?php echo $lists->nama_iklan; ?>"  class="text-danger btn-delete-data" style="padding: 0 10px;"><i class="fa fa-trash"></i> Hapus</a>
					</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr class="even pointer list-baris-article"><td colspan="8">Data Belum Terisi</td></tr>
		<?php } ?>
		  </tbody>
		</table>

	  </div>
</div>

