<?php $this->load->view('theme/t_head'); ?>
<link href="<?php echo base_url('public/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet">
<?php $this->load->view('theme_admin/t_sidebar_nav'); ?>
<?php $this->load->view('theme/t_top_nav'); ?>

<form id="formUploadFitur" class="form-horizontal form-label-left"  action="<?php echo url_web('admin/penjualan/add/').$inv->id; ?>" method="post" id="upload-widget" >
						
	<div class="right_col" role="main">
		<div class="">
			<div class="row">
			<?php echo !empty($message) ? $message : ''; ?>
			<?php if (!empty($this->session->flashdata('success'))) { ?>
			  <div class="alert alert-success alert-dismissible fade in" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
					  </button>
					  <strong>Message alert..!!</strong>  <?php echo $this->session->flashdata('success'); ?>
			  </div>
			<?php }?>
				<div class="col-xs-12 invoice-header">
					<h1><i class="fa fa-globe"></i> Invoice Penjualan.</h1>
				</div>
			</div>
			<div class="x_title"></div>
			<div class="row invoice-info">
				<div class="col-sm-4 invoice-col">
					From
					<address>
						<strong><?php echo $website_judul;?></strong>
						<br><?php echo $website_alamat;?>
					</address>
				</div>
				<!-- /.col -->
				<div class="col-sm-4 invoice-col">
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
				<div class="col-sm-4 invoice-col">
					<b>Invoice #<?php echo $inv->no_transaksi; ?></b>
					<br>
					<br>
					<b>Tanggal:</b> <?php echo tgl_indo(date('Y-m-d', strtotime($inv->tanggal))); ?>
					<br>
					<b>Waktu:</b> <?php echo date('H:i:s', strtotime($inv->tanggal)); ?>
				</div>
				<!-- /.col -->
			</div>
			
			<div class="x_title"></div>
			<div class="row">
				<div class="col-xs-12 table">
					<label for="basic-url">Item Pembelian</label>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Qty</th>
								<th style="width: 40%">Nama Produk</th>
								<th>@harga</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody id="tbodySearch">
							<?php $this->load->view('admin/penjualan/lib/penjualan_item'); ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="x_title"></div>
			<div class="row">
				<!-- accepted payments column -->
				<div class="col-xs-6">
					<p class="lead">Keterangan:</p>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Catatan:</label>
						<div class="col-md-8 col-sm-8 col-xs-12">
							<?php echo form_textarea($catatan); ?>
						</div>
					</div>
				</div>
				<!-- /.col -->
				<div class="col-xs-6">
					
					<div class="table-responsive">
					<table class="table">
					  <tbody id="item-total">
						<tr>
						  <th><p class="lead">TOTAL </p></th>
						  <td>
							<div class="input-group">
								<p class="lead"><b>Rp.<?php echo get_harga($inv->total); ?></b></p>
							</div>
						  </td>
						</tr>
					  </tbody>
					</table>
					
					</div>
				</div>
				<!-- /.col -->
			</div>

			<div class="row">	
					<div class="col-md-12 col-sm-12 col-xs-12">
						<span class="section">Proses Pembayaran:</span>
							
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">Password anda</label>
								<div class="col-sm-4">
									<input type="password" class="form-control" name="input_pasword" placeholder="Password">
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<a href="<?php echo url_web('admin/penjualan'); ?>" type="button" class="btn btn-info">Batal</a>
									<button type="submit" class="btn btn-primary confirm" >Konfirmasi Pembayaran</button>
								</div>
							</div>
						
					</div>	
				</div>
</form>
</div>
</div>

<?php $this->load->view('theme/t_footer'); ?>
<!-- /page content -->