<div class="span9">
    <ul class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>">Home</a> <span class="divider">/</span></li>
		<li class="active"> Keranjang Belanja</li>
    </ul>
	<h3>  Keranjang Belanja [ <small id="update_cart_2"><?php if($cart_session){echo array_sum($cart_session);} else { echo '0'; } ?> Item(s) </small>]</h3>	
	<hr class="soft"/>
	
	<table class="table table-bordered">
              <thead>
                <tr>
                  <th>Produk</th>
                  <th>deskripsi</th>
                  <th>Qty</th>
				  <th>Harga</th>
                  <th>Total</th>
				  <th><i class="icon-cogs icon-white"></i></th>
				</tr>
              </thead>
              <tbody id="tb_checkout">
				<?php
					
					if($cart_session){
					$i = 0;
					$total =0;
					foreach($cart_session as $cs=>$value){
						$rowss = $this->costume->get_produk($cs);
						
						//$row = $this->product_model->product_detail($cs);
						$total += $rowss->harga*$value;
						$total_s = $rowss->harga*$value;
				?>
                <tr id="tr<?php echo $cs;?>">
                  <td> <img width="60" src="<?php echo base_url($this->costume->get_thumbnail($rowss->gambar_utama,'100x100')->row()->url); ?>" alt=""/></td>
                  <td><?php echo $rowss->nama_produk;?><br/>in Stok : <?php echo $rowss->stok;?> PCS</td>
				  <td>
					<input class="span1" id="qty[<?php echo $cs;?>]" value="<?php echo $value;?>" style="max-width:34px" placeholder="1" id="appendedInputButtons" size="16" type="number" disabled>
				  </td>
                  <td>Rp<?php echo get_harga($rowss->harga); ?></td>
				  <td>Rp<?php echo get_harga($total_s); ?></td>
                  <td><button class="btn btn-danger delete_cart" type="button" product_id="<?php echo $cs;?>"><i class="icon-trash"></i></button></td>
                </tr>
				<input type="hidden" class="product_id"  id="product_id[<?php echo $cs;?>]" value="<?php echo $cs;?>">
				<input type="hidden" class="product_price"  id="product_price[<?php echo $cs;?>]" value="<?php echo $rowss->harga;?>">
				<?php
					}	
				?>	
				<input type="hidden" id="total" value="<?php echo $total;?>">
				 <tr id="tr_total">
                  <td colspan="4" style="text-align:right"><strong>TOTAL =</strong></td>
                  <td colspan="2"> <strong id="span_all_total"> Rp <?php echo get_harga($total); ?> </strong></td>
                </tr>
				<?php
					}else{
						echo '<tr><td colspan="6" align="center">Cart empty</td></tr>';
					}
				?>	
				</tbody>
            </table>
	
	<a href="<?php echo site_url(); ?>" class="btn btn-large"><i class="icon-arrow-left"></i> Tambah Produk Lainnya </a>
	<a href="<?php echo site_url('check-out'); ?>" class="btn btn-large pull-right nex-button <?php if($cart_session){ }else{ echo 'disabled';} ?>" >Lanjut ke proses Check out <i class="icon-arrow-right"></i></a>
	
</div>

