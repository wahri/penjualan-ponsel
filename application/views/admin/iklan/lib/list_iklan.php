<?php if (!empty($list_iklan)) { ?>
    <?php foreach ($list_iklan as $lists) { ?>
        <tr class="even pointer list-baris-article">
			<td><?php echo $lists->nama_iklan; ?></td>
			<td><?php echo $lists->posisi; ?></td>
			<td><?php echo $lists->tampilan; ?></td>
			<td><?php echo tgl_indo($lists->mulai); ?></td>
			<td><?php echo tgl_indo($lists->akhir); ?></td>
			<td>IDR. <?php echo $lists->harga_iklan; ?></td>
			<td><?php 
					if($lists->status == 0){
						echo '<span class="label label-default">Terjadwal</span>';
					}else if($lists->status == 1){
						echo '<span class="label label-primary">Aktive</span>';
					}else{
						echo '<span class="label label-success">Expired</span>';
					}
				?>
			</td>
			<td>
                <a data-href="<?php echo url_web('admin/iklan/delete_'); ?>" data-id="<?php echo $lists->id; ?>" data-title="<?php echo $lists->nama_iklan; ?>"  class="text-danger btn-delete-data" style="padding: 0 10px;"><i class="fa fa-trash"></i> Hapus</a>
			</td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <div><p>Data tidak ditemukan</p></div>
<?php } ?>