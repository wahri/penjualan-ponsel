<?php $this->load->view('theme/t_head'); ?>
<?php $this->load->view('theme_kasir/t_sidebar_nav'); ?>
<?php $this->load->view('theme/t_top_nav'); ?>

<div class="right_col" role="main">
  <div class="">
    <div class="row">
		<div class="col-xs-12 invoice-header">
			<h1><i class="fa fa-user"></i> <?php echo $title; ?> </h1>
		</div>
	</div>
    <div class="x_title"></div>
	
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			
			<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
				<div class="row">
					<div class="input-group">
						<input type="text" id="inputSearchArticle" data-href="<?php echo url_web('kasir/pelanggan/search'); ?>" class="form-control" placeholder="cari pelanggan...">
						<span class="input-group-btn">
						  <button class="btn btn-default active" type="button">Go!</button>
						</span>
					  </div>
				</div>
			</div>
			
			<div class="x_panel">
			<?php echo $result_count; ?>
				<div class="x_content">
					<table class="table">
						<thead>
							<tr>
								<th>Nama Pelanggan</th>
								<th>Telp</th>
								<th>Alamat</th>
								<th>Kota</th>
								<th>Kecamatan</th>
								<th>Kelurahan</th>
							</tr>
						</thead>
						<tbody id="tbodySearch">
							<?php $this->load->view('kasir/pelanggan/lib/search_table'); ?>
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
<script>
/*fungsi Pencarian*/
$('#inputSearchArticle').on('input', function (event) {
    var url = $(this).attr('data-href');
    var inputan = $(this).val();
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        dataType: 'html',
        data: {
            search: inputan
        },
        success: function (msg) {
            $('#tbodySearch').html(msg);
        }
    });
});

</script>

<?php $this->load->view('theme/t_footer'); ?>
<!-- /page content -->