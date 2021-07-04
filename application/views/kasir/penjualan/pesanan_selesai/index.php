<?php $this->load->view('theme/t_head'); ?>
<?php $this->load->view('theme_kasir/t_sidebar_nav'); ?>
<?php $this->load->view('theme/t_top_nav'); ?>
<style>
	.dl-horizontal dt {
	float: left;
	width: 80px;
	overflow: hidden;
	clear: left;
	text-align: right;
	text-overflow: ellipsis;
	white-space: nowrap;
	}
	.dl-horizontal dd {
	margin-left: 100px;
	}
</style>
<div class="right_col" role="main">
	<div class="">
		<div class="row">
			<div class="col-xs-12 invoice-header">
				<h1><i class="fa fa-rss"></i> <?php echo $title; ?> </h1>
			</div>
		</div>
		<div class="x_title"></div>
		<div class="row">
			<?php if (!empty($this->session->flashdata('success'))) { ?>
			<div class="alert alert-success alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
				</button>
				<strong>Pesan..!!</strong>  <?php echo $this->session->flashdata('success'); ?>
			</div>
			<?php }?>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
						<li role="presentation" class=""><a href="<?php echo url_web('kasir/penjualan/pesanan_baru'); ?>" aria-expanded="true">Pesanan Baru (<?php echo $jumlah_baru; ?>)</a></li>
						<li role="presentation" class="active"><a href="#" role="tab" aria-expanded="false">Selesai (<?php echo $jumlah_selesai; ?>)</a></li>
						<li role="presentation" class=""><a href="<?php echo url_web('kasir/penjualan/pesanan_batal'); ?>" role="tab" aria-expanded="false">Batal (<?php echo $jumlah_batal; ?>)</a></li>
						<li role="presentation" class=""><a href="<?php echo url_web('kasir/penjualan'); ?>" role="tab" aria-expanded="false">Semua Pesanan (<?php echo $jumlah_semua; ?>)</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
							<div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
								<div class="row">
									<div class="form-group">
										<div class="input-group">
											<input type="text" id="inputSearchArticle" data-href="<?php echo url_web('kasir/penjualan/search/'); ?>" class="form-control" placeholder="cari INV/pembeli...">
											<span class="input-group-btn">
											<button class="btn btn-default active" type="button">Go!</button>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="x_panel">
								<?php echo $result_count; ?>
								<div class="x_content">
									<table class="table">
										<thead>
											<tr>
												<th>NO.INV</th>
												<th>Info Pembeli</th>
												<th>Total</th>
												<th>Status</th>
												<th><i class="fa fa-cogs"></i></th>
											</tr>
										</thead>
										<tbody id="tbodySearch">
											<?php $this->load->view('kasir/penjualan/pesanan_selesai/list_baru'); ?>
										</tbody>
									</table>
								</div>
								<nav id="nav-index">
									<?php 
										echo $this->pagination->create_links();
										?>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	/*fungsi Pencarian*/
	$('#inputSearchArticle').on('input', function (event) {
	    var url = $(this).attr('data-href');
	    var inputan = $(this).val();
		var status_url = 'selesai';
	    $.ajax({
	        url: url,
	        type: 'post',
	        dataType: 'json',
	        dataType: 'html',
	        data: {
	            search: inputan,
				status: status_url
	        },
	        success: function (msg) {
	            $('#tbodySearch').html(msg);
	        }
	    });
	});
	
</script>
<?php $this->load->view('theme/t_footer'); ?>
<!-- /page content -->