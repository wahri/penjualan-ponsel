<div class="span9">
	<ul class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>">Home</a> <span class="divider">/</span></li>
		<li class="active"> Check Out</li>
	</ul>
	<h3>  Check Out</h3>
	<hr class="soft"/>
	<h4>Daftar Pembelian</h4>
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
				$total =0;
				if($cart_session){
				$i = 0;
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
			<tr id="tr_total">
				<td colspan="4" style="text-align:right"><strong>TOTAL =</strong></td>
				<td colspan="2"> <strong id="span_all_total"> Rp <?php echo get_harga($total); ?> </strong></td>
			</tr>
			<?php
				}else{
					echo '<tr><td colspan="6" align="center">Cart empty</td></tr>';
				}
				?>	
			<input type="hidden" id="total" value="<?php echo $total;?>">
		</tbody>
	</table>
	<h4>Informasi Pembeli</h4>
	<div class="well">
		<form class="form-horizontal" id="myform"  action="<?php echo site_url('create_order'); ?>" method="post" >
			<div class="control-group" >
				<label class="control-label" for="inputFname1">Nama Lengkap <sup>*</sup></label>
				<div class="controls">
					<input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap Anda" required>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputFname1">Telpon <sup>*</sup></label>
				<div class="controls">
					<input type="text" name="telpon" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="aditionalInfo">Alamat <sup>*</sup></label>
				<div class="controls">
					<textarea name="alamat" id="alamat" cols="26" rows="3" required></textarea>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="address">Provinsi<sup>*</sup></label>
				<div class="controls">
					<select id="provinsi" name="provinsi" required>
						<option value="">- Pilih Provinsi -</option>
					<?php 
						foreach($data_provinsi as $list_provinsi){
							if($list_provinsi == $select_provinsi){
								echo '<option value="'.$list_provinsi->id.'" selected>'.$list_provinsi->name.'</option>';
							}else{
								echo'<option value="'.$list_provinsi->id.'">'.$list_provinsi->name.'</option>';
							}
						}
					?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="address2">Kabupaten/Kota<sup>*</sup></label>
				<div class="controls">
					<select id="kabupaten" name="kabupaten" disabled required>
						<option value="">- Pilih Kabupaten -</option>
						
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="city">Kecamatan<sup>*</sup></label>
				<div class="controls">
					<select id="kecamatan" name="kecamatan" disabled required>
						<option value="">- Pilih Kecamatan -</option>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="city">Kelurahan<sup>*</sup></label>
				<div class="controls">
					<select id="kelurahan" name="kelurahan" disabled required>
						<option value="">- Pilih Kelurahan -</option>
					</select>
				</div>
			</div>
			
			<div class="control-group">
				<div class="controls">
					<button type="submit" name="order_button" class="btn btn-large btn-success">Order</button>
				</div>
			</div>
		</form>
	</div>
</div>