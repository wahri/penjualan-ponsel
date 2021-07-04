
<div class="span9">
	<ul class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>">Home</a> <span class="divider">/</span></li>
		<li class="active"> Invoice</li>
	</ul>
	<h3>  Invoice</h3>
	<hr class="soft"/>
	<h4>Item Pembelian</h4>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Produk</th>
				<th>deskripsi</th>
				<th>Qty</th>
				<th>Harga</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody id="tb_checkout">
		<?php 
			foreach($data_produk as $list_produk){
				$rowss = $this->costume->get_produk($list_produk->produk_id);
				echo'
				<tr>
					<td> <img width="60" src="'.base_url($this->costume->get_thumbnail($rowss->gambar_utama,'100x100')->row()->url).'" alt=""/></td>
					<td>'.$rowss->nama_produk.'</td>
					<td>'.$list_produk->kuantitas.'</td>
					<td>Rp'.get_harga($list_produk->harga).'</td>
					<td>Rp'.get_harga($list_produk->jumlah_harga).'</td>
				</tr>
				';
			}
			echo '
			<tr id="tr_total">
				<td colspan="4" style="text-align:right"><strong>TOTAL =</strong></td>
				<td colspan="2"> <strong id="span_all_total"> Rp '.get_harga($data_transaksi->total).' </strong></td>
			</tr>';
			
		?>
			
		</tbody>
	</table>
	<h4>Cara Pembayaran</h4>
	<div class="well">
	<div class="text-center">
		<h5>Anda di tunggu selama 2 jam untuk melakukan pembayaran langsung ke kasir kami dengan menunjukkan QRcode yang ada dibawah ini: <h5>
		<img src="<?php echo base_url($data_transaksi->qr_image); ?>" class="img-responsive center-block" alt="Bootshop panasonoc New camera"/></br>
		<a href="<?php echo site_url('store/download_gambar/'.$data_transaksi->no_transaksi); ?>" type="button" class="btn btn-large btn-success">Unduh Kode Boking</a>
	</div>
	</div>
	<h4>Lokasi Toko Kami</h4>
	<div class="well">
		<div class="map-responsive">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6766790045945!2d101.43470931410153!3d0.4827889996477785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5aed289978611%3A0x5f31a7411e31a76f!2sSahabatkoe+Ponsel!5e0!3m2!1sid!2sid!4v1537922040860" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	</div>
</div>