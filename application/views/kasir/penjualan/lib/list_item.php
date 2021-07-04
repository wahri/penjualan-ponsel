
	<?php 
		if(!empty($produk)){
			foreach ($produk as $parent){
	?>
			<tr>
				<td><?php echo $parent->kuantitas; ?></td>
				<td><?php echo $this->costume->get_nama_produk($parent->produk_id)->row()->nama_produk; ?></td>
				<td>Rp.<?php echo get_harga($parent->harga);?></td>
				<td>Rp.<?php echo get_harga($parent->jumlah_harga);?></td>
			</tr>
	<?php
			}
		}else{
	?>
			<tr>
				<td colspan="4">belum ada item penjualan</td>
			</tr>
	<?php
		}
	?>
