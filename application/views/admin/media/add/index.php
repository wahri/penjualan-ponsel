<?php $this->load->view('theme/t_head'); ?>
<link href="<?php echo base_url('public/dropzone/dist/min/dropzone.min.css'); ?>" rel="stylesheet">
<?php $this->load->view('theme_admin/t_sidebar_nav'); ?>
<?php $this->load->view('theme/t_top_nav'); ?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo $title; ?></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
			  
				<div class="well well-sm no-shadow text-center">
                    
                    <form id="formUploadFitur"  action="<?php echo url_web('admin/media/upload_image/'); ?>" method="post" enctype="multipart/form-data" id="upload-widget" >
					<br />
					<br />
					<label class="btn btn-info" for="imageItem">
						<input type="file" name="image" id="btnUploadFitur">
					</label>
					<br />
					<br />
					<p id="coment">Ukuran maksimal unggahan berkas: 8 MB.</p>
					</form>
                    
                    <br />
                  </div>
				
				
				<div class="x_panel">
                  <div class="x_title">
					<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-left ">
						<div class="row">
						<p>
						  <?php echo $jumlah_item; ?> items
						  <button type="button" class="btn btn-default btn-sm btn-navigate " data-href="<?php echo url_web('admin/media/page'); ?>" data-value="<?php echo $jumlah_prev; ?>"><<</button>
						  <button type="button" id="btnPrev" class="btn btn-default btn-sm btn-navigate " data-href="<?php echo url_web('admin/media/page'); ?>" data-value="<?php echo $btn_prev; ?>"><</button>
						  <span id="btn_now_span"><?php echo $jumlah_now; ?></span> dari <?php echo $jumlah_next; ?>
						  <input type="hidden" id="btn_now" value="<?php echo $jumlah_next; ?>" >
						  <button type="button" id="btnNext" class="btn btn-default btn-sm btn-navigate" data-href="<?php echo url_web('admin/media/page'); ?>" data-value="<?php echo $btn_next; ?>" >></button>
						  <button type="button" id="btnJumlahNext" class="btn btn-default btn-sm btn-navigate" data-href="<?php echo url_web('admin/media/page'); ?>" data-value="<?php echo $jumlah_next; ?>">>></button>
						</p>
					  </div>
					</div>
				  
					<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
						<div class="row">
							<div class="input-group">
								<input type="text" id="inputSearchArticle" data-href="<?php echo url_web('admin/media/search'); ?>" class="form-control" placeholder="cari gambar...">
								<span class="input-group-btn">
								  <button class="btn btn-default active" type="button">Go!</button>
								</span>
							  </div>
						</div>
					</div>
				  
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row data-image">
						<?php $this->load->view('admin/media/lib/list_image'); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<script>
$(document).ready(function() {
    /*Ketika sudah memilih gambar yang akan diupload maka otomatis langsung upload*/
	$('body').on('change', '#btnUploadFitur', function () {
		$('#formUploadFitur').submit();
	});
	
	/*Ketika form upload sudah diupload maka langsung membuka tab gallery*/
	$('body').on('submit', '#formUploadFitur', function (e) {
		e.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: formData,
			dataType: 'json',
			cache: false,
			contentType: false,
			processData: false,
			success: function (data) {
				$( ".data-image" ).prepend( $('<div class="col-md-55"><div class="thumbnail"><a href="#"><img style="width: 100%; display: block;" src="<?php echo base_url('upload/images/');?>'+data.url_image+'" alt="'+data.title_image+'"><div class="mask"></a></div></div>') );
				$("#coment").html('');
				$("#coment").html('<i class="fa fa-check-square-o"></i> Berhasil Upload Gambar');
				setTimeout(function(){ 
					$("#formUploadFitur").trigger('reset'); 
					$("#coment").html('');
					$("#coment").html('Ukuran maksimal unggahan berkas: 8 MB.');
				}, 3000);
			},
			error: function (data) {
			}
		});
	});

		$("#upload-widget").on('submit',function(e){
			e.preventDefault();
			if($("image-file").val() == ''){
				alert('Mohon Pilih file terlebih dahulu');
			}else{
				$.ajax({
					url:'<?php echo url_web('admin/media/image') ?>',
					method:'post',
					data:new FormData(this),
					dataType: 'json',
					contentType: false,
					chache: false,
					processData: false,
					success: function(data){
						//alert(data.url_image);
						$( ".data-image" ).prepend( $('<div class="col-md-55"><div class="thumbnail"><a href="#"><img style="width: 100%; display: block;" src="<?php echo base_url('upload/images/');?>'+data.url_image+'" alt="'+data.title_image+'"><div class="mask"></a></div></div>') );
						//$(".data-image").append('<div class="col-md-55"><div class="thumbnail"><div class="image view view-first"><img style="width: 100%; display: block;" src="<?php echo base_url('upload/images/');?>'+data.url_image+'" alt="image"><div class="mask"><p>'+data.title_image+'</p><div class="tools tools-bottom"><a href="#"><i class="fa fa-link"></i></a><a href="#"><i class="fa fa-pencil"></i></a><a href="#"><i class="fa fa-times"></i></a></div></div></div><div class="caption"><p>'+data.image_name+'</p></div></div></div>');	
						$("#formUploadFitur").trigger('reset');
					}
				});
			}
		});
		
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
					$('.data-image').html(msg);
				}
			});
		});
		
		$('body').on('click', '.btn-navigate', function (e) {
			e.preventDefault();
			var page = $(this).attr('data-value');
			var maxPage = $('#btnJumlahNext').val();
			var href = $(this).attr('data-href');
			page = parseInt(page);
			maxPage = parseInt(maxPage);
			
			if (page == 0) {
				return false;
			} else if (page > maxPage) {
				console.log(page);
				console.log(maxPage);
				swal("Kamu sudah berada di maximal data!");
				return false;
			} else {
				
			}
				$.ajax({
					url: href,
					type: 'post',
					dataType: 'json',
					// dataType: 'html',
					data: {
						start: page, maxpage: maxPage
					},
					cache: false,
					success: function (msg) {
						$('.data-image').html(msg.view);
						$('#btnNext').attr('data-value', msg.btn_next);
						$('#btnPrev').attr('data-value', msg.btn_prev);
						$('#btn_now').attr('value', msg.btn_now);
						$('#btn_now_span').html(msg.btn_now);

					}
				});
		});
    });
</script>
<script src="<?php echo base_url('public/fastclick/lib/fastclick.js'); ?>"></script>
<!-- NProgress -->
<script src="<?php echo base_url('public/nprogress/nprogress.js'); ?>"></script>
<!-- Dropzone.js -->
<script src="<?php echo base_url('public/dropzone/dist/min/dropzone.min.js'); ?>"></script>
<?php $this->load->view('theme/t_footer'); ?>
<!-- /page content -->