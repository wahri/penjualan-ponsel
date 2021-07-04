<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="title" content="<?php echo !empty($title) ? $title : '';  ?> - <?php echo $website_judul;?>" />
		<meta name="description" content="<?php echo $website_deskripsi;?>" />
		<title><?php echo !empty($title) ? $title : '';  ?> | <?php echo $website_judul;?></title>
		<!-- Bootstrap -->
		<link href="<?php echo base_url('public/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="<?php echo base_url('public/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
		<!-- iCheck -->
		<link href="<?php echo base_url('public/iCheck/skins/flat/green.css'); ?>" rel="stylesheet">
		<!-- bootstrap-progressbar -->
		<link href="<?php echo base_url('public/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css'); ?>" rel="stylesheet">
		<!-- jQuery -->
		<script src="<?php echo base_url('public/jquery/dist/jquery.min.js'); ?>"></script>
		<!-- Bootstrap -->
		<script src="<?php echo base_url('public/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
		<!-- FastClick -->
		<!-- Skycons -->
		<script src="<?php echo base_url('public/skycons/skycons.js'); ?>"></script>
	</head>
	<body>
		<style>
			body {
			/* color: #73879C; */
			/* background: #2A3F54; */
			font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
			font-size: 13px;
			font-weight: 400;
			line-height: 1.471;
			}
		</style>
		<div class="x_content">
			<section class="content invoice">
				<!-- title row -->
				<div class="row">
					<div class="col-xs-12 invoice-header">
						<h1>
							<i class="fa fa-globe"></i> Invoice.
							<small class="pull-right">Date: <?php echo tgl_indo(date('Y-m-d', strtotime($inv->tanggal))); ?></small>
						</h1>
					</div>
					<!-- /.col -->
				</div>
				<!-- info row -->
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
				<!-- /.row -->
				<!-- Table row -->
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
				<!-- /.row -->
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
				<!-- /.row -->
				<!-- this row will not appear when printing -->
				<div class="row no-print">
					<div class="col-xs-12">
						<small>Engine System - <?php echo $website_judul;?></small>
					</div>
				</div>
			</section>
		</div>
		<!-- /page content -->