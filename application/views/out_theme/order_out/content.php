<div class="span9">
    <ul class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>">Home</a> <span class="divider">/</span></li>
		<li class="active"> Keranjang Belanja</li>
    </ul>
	<h3>  Keranjang Belanja [ <small id="update_cart_2"><?php if($cart_session){echo array_sum($cart_session);} else { echo '0'; } ?> Item(s) </small>]</h3>	
	<hr class="soft"/>
		
	<div class="alert alert-block alert-error fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<h4>Mohon Maaf!!!</h4>
		<strong>Lokasi Anda</strong> Diluar dari area <strong>Pekanbaru</strong>, Sehingga anda tidak bisa membeli langsung ke toko fisik kami, namun jangan khawatir, anda dapat membeli produk kami melalui portal online kami di bawah ini.</div>		
	 	
	<table class="table table-bordered">
              <thead>
                <tr>
                  <th>Produk</th>
                  <th>deskripsi</th>
				  <th>Harga</th>
                  <th>Portal</th>
				</tr>
              </thead>
              <tbody id="tb_checkout">
				<?php
					
					if($cart_session){
					$i = 0;
					$total =0;
					foreach($cart_session as $cs=>$value){
						$rowss = $this->costume->get_produk($cs);
						$total += $rowss->harga*$value;
						$total_s = $rowss->harga*$value;
				?>
                <tr id="tr<?php echo $cs;?>">
                  <td> <img width="60" src="<?php echo base_url($this->costume->get_thumbnail($rowss->gambar_utama,'100x100')->row()->url); ?>" alt=""/></td>
                  <td><?php echo $rowss->nama_produk;?><br/>in Stok : <?php echo $rowss->stok;?> PCS</td>
                  <td>Rp<?php echo get_harga($rowss->harga); ?></td>
                  <td>
				  <?php 
						foreach($portal as $portas_list){
							$url_prtal = $this->costume->get_url_portal_product($portas_list->id , $cs);
							if($url_prtal->num_rows() > 0){
								echo '<p><a href="'.$url_prtal->row()->url_portal.'" class="btn btn-mini" target="_blank" ><img width="80" src="'.base_url($this->costume->get_original($portas_list->gambar,'original')->row()->url).'" /></a></p>';
							}else{
								echo '<p><a href="#" class="btn btn-mini disabled" ><img width="80" src="'.base_url($this->costume->get_original($portas_list->gambar,'original')->row()->url).'" /></a></p>';
							}
						}
				  ?>
				  </td>
                </tr>
				<?php
					}	
				?>	
				
				<?php
					}else{
						echo '<tr><td colspan="4" align="center">Cart empty</td></tr>';
					}
				?>	
				</tbody>
            </table>
	
	<a href="<?php echo site_url(); ?>" class="btn btn-large"><i class="icon-arrow-left"></i> Lihat Produk Lainnya </a>

</div>

