<?php if (!empty($penjualan_parent)) { ?>
    <?php foreach ($penjualan_parent as $lists) { ?>
        <tr class="even pointer">
			<td>
				<b style="color:#dc3232"><?php echo $lists->no_transaksi; ?></b> - <span style="font-size:11px;font-style: italic;"> <?php echo $lists->status; ?></span>
				<br>
				<span style="font-size:11px">Tanggal :  <?php echo tgl_indo_timestamp($lists->tanggal); ?></span>
			</td>
			<td>
				<b><?php echo $lists->pelanggan; ?></b>
				<p><?php echo $lists->hp; ?></p>
			</td>
			<td>
					<p>Rp.<?php echo get_harga($lists->total); ?></p>
			</td>
			<td>
					<div class="btn-group">
					  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?php echo $lists->status; ?> <span class="caret"></span>
					  </button>
						<ul class="dropdown-menu">
						<?php 
							$mimin = array('proses', 'selesai', 'retur', 'batal');
							foreach($mimin as $group)
							{
								if($group != $lists->status){
									echo '<li class="change-data" data-id="'.$lists->id.'" data-status="'.$group.'" data-href="'.url_web('admin/penjualan/update_status').'"><a class="btn-link">'.$group.'</a></li>';
								}
							}
						?>
						</ul>
					  </div>
					 
	
			</td>
			<td>
				<a href="<?php echo url_web('admin/penjualan/inv/'.$lists->id); ?>" target="_blank">
					<span style="font-size:12px"><i class="fa fa-print"></i> inv</span>
				</a>
				<br>
				<a href="<?php echo url_web('admin/penjualan/view/'.$lists->id); ?>">
					<span style="font-size:12px"><i class="fa fa-eye"></i> View</span>
				</a>
	
			</td>
        </tr>
    <?php } ?>
<?php } else { ?>
    
<?php } ?>
