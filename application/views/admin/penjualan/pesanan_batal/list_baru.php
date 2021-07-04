<?php if (!empty($penjualan_baru)) { ?>
    <?php foreach ($penjualan_baru as $lists) { ?>
        <tr class="even pointer">
			<td><img src="<?php echo base_url($lists->qr_image); ?>" height="40" alt=""></img></td>
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
				<p>Waktu Transaksi <?php echo tgl_indo_timestamp($lists->tanggal); ?> </p>
				<?php 
					$pengurangan 	= strtotime($lists->tanggal) + 60*60*2;
					$sisa_waktu		= date("Y-m-d H:i:s",$pengurangan);
					$eks			= dateDiff($sisa_waktu);
					if($eks == " Waktu Habis"){
						if($lists->status == 'batal'){
						?>
							<p>Batas konfirmasi <span class="label label-info"><?php echo $eks; ?></span></p>	
							<p><i class="fa fa-times"></i> Pesanan Otomatis Dibatalkan</p>
						<?php
						}else{
						?>
							<p><i class="fa fa-check-square-o"></i> Transaksi Selesai</p>
						<?php			
						}
					}else{
				?>
					<p>Batas konfirmasi <span class="label label-default"><?php echo $eks; ?></span></p>	
					<p><a href="<?php echo url_web('admin/penjualan/transaksi/'); ?>" type="button" class="btn btn-sm btn-success">Konfirmasi Pembayaran</a></p>
				<?php
					}
				?>	
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
		<tr>
			<td colspan="5">Tidak ada data</td>
		</tr>
<?php } ?>
