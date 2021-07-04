<?php if (!empty($produk_parent)) { ?>
    <?php foreach ($produk_parent as $lists) { ?>
        <tr class="even pointer">
			<td><img src="<?php echo base_url($this->costume->get_thumbnail($lists->gambar_utama,'100x100')->row()->url); ?>" alt=""></img></td>
			<td>
				<b style="color:#dc3232"><?php echo $lists->nama_produk; ?></b> - <span style="font-size:11px;font-style: italic;"> <?php echo $lists->kondisi; ?></span>
				<br>
				<span style="font-size:11px">Kategori : 
					<?php 
						foreach( $this->costume->get_kategori_produk($lists->id) as $cati){
							echo $cati->category .' - ';
						}
					?>
				</span>
				<br>
				<span style="font-size:11px">Estalase : 
					<?php 
						foreach( $this->costume->get_estalase_produk($lists->estalase) as $esta){
							echo '- '.$esta->estalase;
						}
					?>
				</span>
			</td>
			<td>
				<span style="font-size:12px">SKU : <?php echo $lists->sku; ?></span>
				<br>
				<span style="font-size:12px">Stok : <?php echo $lists->stok; ?> unit</span>
				<br>
				<span style="font-size:12px">Harga : Rp.<?php echo $lists->harga; ?></span>
				
			</td>
			<td>
				<span style="font-size:11px; color:#5bc0de;">
				<?php 
					if($lists->status = 1){
						echo "Pubhils";
					}else{
						echo "Non Pubhils";
					}
				?>
				<br>
				<?php 
					if($lists->promo > 0){
						echo "Promo";
					}else{
						echo "Non Promo";
					}
				?>
				<br>
					<?php 
						echo $lists->real_viewer.' Viewer'; 
					?>
				</span>
			</td>
			<td>
				<a href="<?php echo url_web('admin/produk/edit/'.$lists->id); ?>">
					<span style="font-size:12px"><i class="fa fa-edit"></i></span>
				</a>
				<br>
				<a data-href="<?php echo url_web('admin/produk/delete'); ?>" data-id="<?php echo $lists->id; ?>" data-title="<?php echo $lists->nama_produk; ?>" class="btn-delete-data">
					<span style="font-size:12px"><i class="fa fa-trash"></i></span>
				</a>
			</td>
        </tr>
    <?php } ?>
<?php } else { ?>
    
<?php } ?>
