<?php $this->load->view('theme/t_head'); ?>
<link href="<?php echo base_url('public/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet">
<?php $this->load->view('theme_kasir/t_sidebar_nav'); ?>
<?php $this->load->view('theme/t_top_nav'); ?>

<div class="right_col" role="main">
	<div class="">
		<div class="row">
			<div class="col-xs-12 invoice-header">
				<h1><i class="fa fa-globe"></i> Invoice Penjualan.</h1>
			</div>
		</div>
	
		<div class="x_title"></div>
	
		<div class="row invoice-info">
			<div class="col-xs-4 invoice-col">
				<b>No: <?php echo $inv->no_transaksi; ?></b>
				<br>
				<b>Tanggal:</b> <?php echo tgl_indo(date('Y-m-d', strtotime($inv->tanggal))); ?>
				<br>
				<b>Waktu:</b> <?php echo date('H:i:s', strtotime($inv->tanggal)); ?>
				<br>
				<b>Status:</b> 
				<?php echo $inv->status;?>
			</div>
			<div class="col-xs-4 invoice-col">
				From
				<address>
					<strong><?php echo $website_judul;?></strong>
					<br><?php echo $website_alamat;?>
				</address>
			</div>
			<!-- /.col -->
			<div class="col-xs-4 invoice-col">
				To
				<address>
					<strong><?php echo $pelanggan->pelanggan; ?></strong>
					<br><?php echo $pelanggan->alamat; ?>
					<br>KEL : <?php echo $this->costume->get_regional($pelanggan->kelurahan , 'kelurahan')->row()->name; ?> 
					<br>KEC : <?php echo $this->costume->get_regional($pelanggan->kecamatan , 'kecamatan')->row()->name; ?> 
					<br>KOTA : <?php echo $this->costume->get_regional($pelanggan->kabupaten , 'kabupaten')->row()->name; ?> 
					<br>PROVINSI : <?php echo $this->costume->get_regional($pelanggan->propinsi , 'provinsi')->row()->name; ?> 
					<br>Telp/Hp: <?php echo $pelanggan->hp; ?>
				</address>
			</div>
			<!-- /.col -->
		</div>
	
		<div class="x_title"></div>
	
		<div class="row">
			<div class="col-xs-12 table">
			  <table class="table table-striped">
				<thead>
				  <tr>
					<th>Qty</th>
					<th>Product</th>
					<th>Harga #</th>
					<th>Subtotal</th>
				  </tr>
				</thead>
				<tbody>
				  <?php $this->load->view('kasir/penjualan/lib/list_item'); ?>
				</tbody>
			  </table>
			</div>
			<!-- /.col -->
		</div>
	
		<div class="x_title"></div>
	
		<div class="row">
			<!-- accepted payments column -->
			<div class="col-xs-6">
				<p class="lead">Keterangan:</p>
				<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
					catatan: <?php echo $inv->catatan; ?>
				</p>
			</div>
			<!-- /.col -->
			<div class="col-xs-6">
				<p class="lead">Total Pembelian</p>
				<div class="table-responsive">
					<table class="table">
						<tbody>
							<tr>
								<th>Total:</th>
								<td><b>Rp.<?php echo get_harga($inv->total); ?></b></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<!-- /.col -->
		</div>
	
		<div class="row no-print">
			<div class="col-xs-12">
			  <a href="<?php echo url_web('kasir/penjualan/inv/'.$inv->id); ?>" target="_blank" type="button" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Cetak INV</a>
			  <a href="<?php echo url_web('kasir/penjualan'); ?>" type="button" class="btn btn-info pull-right">Kembali</a>
			</div>
		</div>
	
	</div>
</div>

<?php $this->load->view('theme/t_footer'); ?>
<!-- /page content -->