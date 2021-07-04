<?php $this->load->view('theme/t_head'); ?>
<link href="<?php echo base_url('public/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet">
<?php $this->load->view('theme_pemilik/t_sidebar_nav'); ?>
<?php $this->load->view('theme/t_top_nav'); ?>
<style>
.ui-autocomplete {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    float: left;
    display: none;
    min-width: 160px;
    _width: 160px;
    padding: 4px 0;
    margin: 2px 0 0 0;
    list-style: none;
    background-color: #ffffff;
    border-color: #ccc;
    border-color: rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
    background-clip: padding-box;
    *border-right-width: 2px;
    *border-bottom-width: 2px;
}
.ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;
}
.ui-state-hover, &.ui-state-active {
      color: #ffffff;
      text-decoration: none;
      background-color: #0088cc;
      border-radius: 0px;
      -webkit-border-radius: 0px;
      -moz-border-radius: 0px;
      background-image: none;
    }
</style>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<script>
 $(function () {
		$("#nama").autocomplete({
		  source: "<?php echo url_web('admin/penjualan/get_search'); ?>", // path to the get_birds method
		  select:function(event, ui){
			  $('#exampleModal').modal('show');
			  $('#m-produk,#m-normal-harga,#m-normal-baru,#m-jumlah,#m-id').val('');
			  $('#m-produk').val(ui.item.produk);
			  $('#m-normal-harga').val(ui.item.jual);
			  $('#m-id').val(ui.item.id);
			  $('#m-kategori').val(ui.item.kategori);
		  }
		});
		
		$("#s-pelanggan").autocomplete({
		  source: "<?php echo url_web('admin/penjualan/search_pelanggan'); ?>", // path to the get_birds method
		  select:function(event, ui){
			$('#sp_nama,#sp_alamat,#sp_kec,#sp_kab,#sp_pro,#sp_hp').html("");
			$('#pelanggan').val('');
			$('#pelanggan').val(ui.item.id);
			$('#sp_nama').html(ui.item.pelanggan);
			$('#sp_alamat').html(ui.item.alamat);
			$('#sp_kec').html(ui.item.kecamatan);
			$('#sp_kab').html(ui.item.kabupaten);
			$('#sp_pro').html(ui.item.propinsi+' KodePos: '+ui.item.kodepos);
			$('#sp_hp').html(ui.item.hp);
		  }
		});
	});
</script>

<form class="form-horizontal form-label-left" action="<?php echo url_web('admin/penjualan/add'); ?>" method="post" enctype="multipart/form-data">
<div class="right_col" role="main">
  <div class="">
  <?php echo !empty($message) ? $message : ''; ?>
	<div class="row">
		<div class="col-xs-12 invoice-header">
			<h1><i class="fa fa-globe"></i> Invoice Penjualan.</h1>
		</div>
	</div>
	
	<div class="x_title"></div>
	
	<div class="row invoice-info">
		<div class="col-sm-4 invoice-col">
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-xs-12">No.Transaksi :</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <?php echo form_input($invoice); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal :</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						<?php echo form_input($subtanggal); ?>
						<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
					</div>
					 <?php echo form_input($tanggal); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-xs-12">Pelanggan :</label>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<input type="text" class="form-control" id="s-pelanggan" name="s-nama" placeholder="Cari Pelanggan" aria-describedby="basic-addon2">
					<input type="hidden" class="form-control" id="pelanggan" name="pelanggan">
				</div>
				<div class="col-md-2 col-sm-2 col-xs-2">
				  <a href="<?php echo url_web('pemilik/pelanggan/add'); ?>" class="btn btn-default btn-sm"><i class="fa fa-plus-square"></i> New</a>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-xs-12">Sales :</label>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<select class="form-control input-sm sales" name="sales">
						<?php $this->load->view('pemilik/penjualan/select_sales'); ?>
					</select>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-2">
				  <a href="<?php echo url_web('pemilik/sales/add'); ?>" class="btn btn-default btn-sm"><i class="fa fa-plus-square"></i> New</a>
				</div>
			</div>
		</div>
		<!-- /.col -->
		<div class="col-sm-4 invoice-col">
		  <p class="lead">Data Sales:</p>
		  <dl class="dl-horizontal">
			  <dt>Nama Sales:</dt>
				<dd id="sl_sales"></dd>
			  <dt>Alamat:</dt>
				<dd id="sl_alamat"></dd>
			  <dt>Telp:</dt>
				<dd id="sl_hp"></dd>
		  </dl>
		</div>
		<!-- /.col -->
		<div class="col-sm-4 invoice-col">
		  <p class="lead">Data Pelanggan:</p>
		  <dl class="dl-horizontal">
			  <dt>Nama Pelanggan:</dt>
				<dd id="sp_nama"></dd>
			  <dt>Alamat:</dt>
				<dd id="sp_alamat"></dd>
			  <dt>Kecamatan:</dt>
				<dd id="sp_kec"></dd>
			  <dt>Kabupaten:</dt>
				<dd id="sp_kab"></dd>
			  <dt>Provinsi:</dt>
				<dd id="sp_pro"></dd>
			  <dt>Telp:</dt>
				<dd id="sp_hp"></dd>
		  </dl>
		</div>
	</div>
	
	<div class="x_title"></div>
	
	<div class="row">	
		<div class="col-xs-10">
		  <input type="text" class="form-control" id="nama" name="nama" placeholder="Telusuri nama produk" aria-describedby="basic-addon2">
		</div>
		<div class="col-xs-2">
			<a href="<?php echo url_web('pemilik/produk/add'); ?>" class="btn btn-default" type="button"><i class="fa fa-plus-square"></i> New</a>
		</div>
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
					<th>Kategori#</th>
					<th>@harga</th>
					<th>Subtotal</th>
					<th>#Edit</th>
				  </tr>
				</thead>
				<tbody id="tbodySearch">
					<?php $this->load->view('pemilik/penjualan/penjualan_item'); ?>
				</tbody>
			</table>
		</div>
	</div>
	
	<div class="x_title"></div>
	
	<div class="row">
		<!-- accepted payments column -->
		<div class="col-xs-6">
		  <p class="lead">Metode Pembayaran:</p>
				
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <select class="form-control input-sm pembayaran" name="pembayaran">
					<option value="tunai">Tunai</option>
					<option value="hutang">Hutang</option>
					<option value="transper">Transper Bank</option>
				 </select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Bank:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <select class="form-control input-sm bank" name="bank" disabled>
					<?php $this->load->view('pemilik/penjualan/select_bank'); ?>
				 </select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Portal Pembelian:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				   <?php echo form_input($portal); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Catatan:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				   <?php echo form_textarea($catatan); ?>
				</div>
			</div>
		</div>
		<!-- /.col -->
		<div class="col-xs-6">
		  <p class="lead">TOTAL</p>
		  <div class="table-responsive">
			<?php $this->load->view('pemilik/pembelian/total'); ?>
		  </div>
		</div>
		<!-- /.col -->
	</div>
	
	<div class="row no-print">
		<div class="col-xs-12">
		  <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Simpan Dan Cetak</button>
		  <button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Simpan Penjualan</button>
		</div>
	</div>
</form>	
  </div>
</div>
<?php $this->load->view('pemilik/penjualan/modal'); ?>
<script src="<?php echo base_url('public/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script src="<?php echo base_url('public/bootstrap-datetimepicker-master/js/locales/bootstrap-datetimepicker.id.js'); ?>"></script>
<script>
$(document).ready(function() {
	cek();
	$("#warning-alert").hide();
	
	$(document).on("change", ".sales", function(){	
		$('#sl_sales,#sl_alamat,#sl_hp').html("");
		if($(this).val() != ''){
			var sales = $(this).find(':selected').data('nama');
			var alamat = $(this).find(':selected').data('alamat');
			var hp = $(this).find(':selected').data('hp');
			$('#sl_sales').html(sales);
			$('#sl_alamat').html(alamat);
			$('#sl_hp').html(hp);
		}
	});
	
	$('.form_date').datetimepicker({
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0,
		linkField: "tanggal",
    });
	
	$(document).on("click", ".add-item", function(){
		if($('input[type=radio][name=pilih-harga]:checked').val() == 'lama'){
			var harga = $("#m-normal-harga").val();
		}else{
			var harga = $("#m-harga-baru").val();
		}
		if($("#m-harga").val() != '' && $("#m-jumlah").val() != '' && harga != ''){
			var id = $("#m-id").val();
			var jumlah = $("#m-jumlah").val();
			var url = '<?php echo url_web('pemilik/penjualan/add_item'); ?>';
			$.ajax({
				url: url,
				type: 'post',
				dataType: 'json',
				//dataType: 'html',
				data: {id_produk: id, harga_produk: harga, jumlah_produk: jumlah},
				success: function (msg) {
					
					$('#exampleModal').modal('hide');
					$('#tbodySearch').html(msg.view);
					$('#subtotal').val(msg.subtotal);
					$('#nama').val('');
					//$('#total').val('');
					cek();
					//alert(msg.subtotal);
				}
			});
			return false;
		}else{
			$("#warning-alert").fadeTo(2000, 500).slideUp(500, function(){
               $("#warning-alert").slideUp(500);
            });   
		}
	});

	$(".pembayaran").change(function(){
		if($(this).val() == 'transper'){
			$(".bank").prop('disabled', false);
		}else{
			$(".bank").prop('disabled', true);
		}
	});
	
	
	$("#bea_kirim").on("input", function() {
		cek();
	});
	
	$("#bea_lain").on("input", function() {
		cek();
	});
	
	$(document).on("click", ".delete-item", function(){	
		var id_item = $(this).data('id');
		var url = '<?php echo url_web('pemilik/penjualan/delete_item'); ?>';
		$.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
			data: {id: id_item},
			success: function (msg) {
				$('#tbodySearch').html(msg.view);
				$('#subtotal').val(msg.subtotal);
				cek();
			}
		});
		return false;
	});
	
	
	$('input[type=radio][name=pilih-harga]').change(function() {
		if ($(this).val() == 'baru') {
			$("#m-harga-baru").prop('disabled', false);
		}
		else {
			$("#m-harga-baru").prop('disabled', true);
		}
	});

	
	function cek(){
		if($("#bea_lain").val() !=''){
			var d_lain = $("#bea_lain").val();
		}else{
			var d_lain = 0;
		}
		if($("#bea_kirim").val() !=''){
			var d_kirim = $("#bea_kirim").val();
		}else{
			var d_kirim = 0;
		}
		if($("#subtotal").val() != ''){
			var d_sub = $("#subtotal").val();
		}else{
			var d_sub = 0;
		}
		var jum = parseInt(d_kirim) + parseInt(d_sub) + parseInt(d_lain);
		var numi = isNaN(parseInt(jum)) ? 0 : parseInt(jum);
		if(numi == 0){
			$('#total').attr('value',$("#subtotal").val());
		}else{
			$('#total').attr('value',numi);
		}	
	}
	
});	
</script>

<?php $this->load->view('theme/t_footer'); ?>
<!-- /page content -->