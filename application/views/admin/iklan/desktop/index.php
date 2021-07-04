<?php $this->load->view('theme/t_head'); ?>
<link href="<?php echo base_url('public/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('public/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script src="<?php echo base_url('public/bootstrap-datetimepicker-master/js/locales/bootstrap-datetimepicker.id.js'); ?>"></script>
<?php $this->load->view('theme_admin/t_sidebar_nav'); ?>
<?php $this->load->view('theme/t_top_nav'); ?>
<style>
.pagination {
    margin: 0px !important;
}
ul.list-image-media {
    list-style-type: none;
}

.list-image-media li {
    display: inline-block;
}

input[type="checkbox"][id^="check-"] {
    display: none;
}

input[type="radio"][id^="check-"] {
    display: none;
} 

label.select_image {
    border: 1px solid #fff;
    padding: 10px;
    display: block;
    position: relative;
    margin: 10px;
    cursor: pointer;
}

label.select_image:before {
    background-color: white;
    color: white;
    content: " ";
    display: block;
    border-radius: 50%;
    border: 1px solid #3c8dbc;
    position: absolute;
    top: -5px;
    left: -5px;
    width: 25px;
    height: 25px;
    text-align: center;
    line-height: 28px;
    transition-duration: 0.4s;
    transform: scale(0);
}

label.select_image img {
    height: 100px;
    width: 100px;
    transition-duration: 0.2s;
    transform-origin: 50% 50%;
}

:checked + label.select_image {
    border-color: #3c8dbc;
    /* background: #3c8dbc; */
}

:checked + label.select_image:before {
    content: "✔";
    background-color: #3c8dbc;
    transform: scale(1);
}

:checked + label.select_image img {
    transform: scale(0.9);
    box-shadow: 0 0 5px #3c8dbc;
    z-index: -1;
}
</style>

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?php echo $title; ?></h3>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="x_title"></div>
	
	<div class="row">
    <?php if (!empty($this->session->flashdata('success'))) { ?>
      <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong>Pesan..!!</strong>  <?php echo $this->session->flashdata('success'); ?>
      </div>
    <?php } ?>
		
		<div class="col-md-4 col-sm-4 col-xs-12">
		</br>
				<div class="x_content">
					<form action="<?php echo url_web('admin/iklan/desktop') ?>" method="post" enctype="multipart/form-data">

					  <div class="form-group">
						<label>Nama Iklan <span class="required">*</span></label>
						  <?php echo form_input($nama_iklan); ?>
						  <p class="help-block">Nama iklan wajib anda isi.</p>
					  </div>
					  
					  <div class="form-group">
						<label>Posisi Iklan</label>
							<select class="form-control" id="posisi" name="posisi">
							  <option>- Pilihan -</option>
							  <?php
								foreach ($identity_link as $parent_menu) { 
									if($parent_menu['id'] == $posisi){
										echo '<option value="'.$parent_menu['id'].'" selected>'.$parent_menu['iklan'].'</option>';
									}else{
										echo '<option value="'.$parent_menu['id'].'">'.$parent_menu['iklan'].'</option>';
									}
								}
							 ?>
							</select>
						  <p class="help-block">Pilih posisi iklan sesuai permintaan, iklan akan tampil sesuai tempat yang anda tentukan</p>
					  </div>
					  
					  <div class="form-group">
						<button type="button" class="btn btn-primary btn-info" data-toggle="modal" data-target="#myModalindex"><i class="fa fa-file-image-o"></i> Lihat Iklan Index</button>
						<button type="button" class="btn btn-primary btn-info" data-toggle="modal" data-target="#myModalpost"><i class="fa fa-file-image-o"></i> Lihat Iklan Postingan</button>
					  </div>
					  
						<div class="form-group">
							<label>Harga Iklan</label>
							  <div class="input-group">
								  <div class="input-group-addon">Rp.</div>
								  <?php echo form_input($harga); ?>
							  </div>
							<p class="help-block">sebaiknya diisi untuk laporan keuangan anda</p>
						</div>
						
						<div class="form-group iklan-mulai">
							<label>Tanggal Tayang</label>
							<div class="input-group date form_date_star" data-date-format="dd MM yyyy" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
								<input type="text" class="form-control" id="subtanggal_start" name="subtanggal_start" aria-describedby="basic-addon1" disabled>
								<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							<p class="help-block">Masukkan tanggal untuk memulai tampilan iklan</p>
							<input type="hidden" id="tanggal-star" name="tanggal-star">
						</div>
						
						<div class="form-group iklan-akhir">
							<label>Tanggal Expired</label>
							<div class="input-group date form_date_end" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
								<input type="text" class="form-control" id="subtangga_end" name="subtangga_end" aria-describedby="basic-addon2" disabled>
								<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							<p class="help-block">Masukkan tanggal untuk mengakhiri tampilan iklan</p>
							<input type="hidden" id="tanggal-end" name="tanggal-end">
						</div>
					  
					  <div class="form-group">
						<a href="<?php echo url_web('admin/images/modal_fiture_library'); ?>" class="btn btn-info" data-toggle="modal" data-target="#modalAddMedia"><i class="fa fa-file-image-o"></i> Gambar Iklan</a>
						<p class="help-block">Logo akan tampil pada menu advertorial saja</p>
					  </div>
					  <?php
					  if (!empty($featuredimage)) { ?>
							<div class="thumbnail">
							  <img id="imageDetailFieture" src="<?php echo $featuredimage; ?>" alt="">
							  <input id="image_fitur" type="hidden" name="image_fitur" value="<?php echo $featuredimage; ?>" />
							  <input id="id_fitur" type="hidden" name="id_fitur" value="<?php echo $id_fitur; ?>" />
							</div>
					<?php 
						}else{ ?>
							<div class="thumbnail">
							  <img id="imageDetailFieture" src="<?php echo base_url('upload/images/blank.jpg'); ?>" alt="">
							  <input id="image_fitur" type="hidden" name="image_fitur" value="" />
							  <input id="id_fitur" type="hidden" name="id_fitur" value="" />
							</div>
					<?php 
						}
					?>
						<div class="form-group url-gambar">
							<label>Url Gambar</label>
							<?php echo form_input($iklan_url); ?>
							<p class="help-block">silahkan diisi dengan url tujuan saat gambar iklan di klik</p>
						</div>
						
					  <div class="form-group">
						<label>Keterangan <span class="required">*</span></label>
						  <?php echo form_textarea($keterangan); ?>
						  <p class="help-block">Keterangan ini Sebagai informasi panjang dari iklan yang ditayangkan.</p>
					  </div>
					  
					  <div class="ln_solid"></div>
					  <div class="form-group">
						  <button type="submit" class="btn btn-success">Tambah Iklan Baru</button>
					  </div>
					</form>
					  
				</div>
			
		
		</div>
		
		<div class="col-md-8 col-sm-8 col-xs-12">
			<div class="row">
			  <div class="col-lg-6">
				<div class="input-group">
				  <div class="input-group-btn">
					<?php
						$arrayKey = $this->costume->searchArrayKeyVal("id", $this->uri->segment(5), $identity_link);
							if ($arrayKey!==false) {
								$d_menu = $identity_link[$arrayKey]['iklan'];
							}else{
								$d_menu = 'Semua Posisi';
							}
					?>
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Posisi Iklan <span class="caret"></span></button>
					<ul class="dropdown-menu">
					<?php
						if($this->uri->segment(5) == 'all'){
							echo '<li class="disabled"><a href="'.url_web('admin/iklan/desktop/'.$this->uri->segment(4).'/all').'">Semua Posisi</a></li>';
						}else{
							echo '<li><a href="'.url_web('admin/iklan/desktop/'.$this->uri->segment(4).'/all').'">Semua Posisi</a></li>';
						}
						foreach ($identity_link as $posisi_li) { 
							if($posisi_li['id'] == $this->uri->segment(5)){
								echo '<li class="disabled"><a href="'.url_web('admin/iklan/desktop/'.$this->uri->segment(4).'/'.$posisi_li['id']).'">'.$posisi_li['iklan'].'</a></li>';
							}else{
								echo '<li><a href="'.url_web('admin/iklan/desktop/'.$this->uri->segment(4).'/'.$posisi_li['id']).'">'.$posisi_li['iklan'].'</a></li>';
							}
						}
					?>
					</ul>
				  </div><!-- /btn-group -->
				  <input type="text" class="form-control" aria-label="..." value="<?php echo $d_menu; ?>">
				</div><!-- /input-group -->
			  </div><!-- /.col-lg-6 -->
			  <div class="col-lg-6">
				<div class="input-group">
				  <div class="input-group-btn">
				    <?php
						$arraySet = $this->costume->searchArrayKeyVal("id", $this->uri->segment(4), $status_link);
							if ($arraySet!==false) {
								$d_status = $status_link[$arraySet]['status'];
							}else{
								$d_status = 'Semua Status';
							}
					?>
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Status Iklan <span class="caret"></span></button>
					<ul class="dropdown-menu dropdown-menu-right">
					  <?php
						if($this->uri->segment(4) == 'all'){
							echo '<li class="disabled"><a href="'.url_web('admin/iklan/desktop/all/'.$this->uri->segment(5)).'">Semua Status</a></li>';
						}else{
							echo '<li><a href="'.url_web('admin/iklan/desktop/all/'.$this->uri->segment(5)).'">Semua Status</a></li>';
						}
						foreach ($status_link as $status_li) { 
							if($status_li['id'] == $this->uri->segment(4)){
								echo '<li class="disabled"><a href="'.url_web('admin/iklan/desktop/'.$status_li['id']).'/'.$this->uri->segment(5).'">'.$status_li['status'].'</a></li>';
							}else{
								echo '<li><a href="'.url_web('admin/iklan/desktop/'.$status_li['id']).'/'.$this->uri->segment(5).'">'.$status_li['status'].'</a></li>';
							}
						}
					?>
					</ul>
				  </div><!-- /btn-group -->
				  <input type="text" class="form-control" aria-label="..." value="<?php echo $d_status; ?>">
				</div><!-- /input-group -->
			  </div><!-- /.col-lg-6 -->
			</div><!-- /.row -->

            <?php $this->load->view('admin/iklan/lib/list_iklan_desktop'); ?>
                      
		</div>
		
	</div>
  </div>
</div>

<!-- Modal -->
    <div class="modal fade" id="modalAddMedia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
	
<!-- Modal -->
<div class="modal fade" id="myModalindex" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Posisi Iklan Index Home</h4>
      </div>
      <div class="modal-body">
        <img src="<?php echo base_url('upload/system/Desktop.png'); ?>" class="imagepreview" style="width: 100%;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModalpost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Posisi Iklan Artikal Postingan</h4>
      </div>
      <div class="modal-body">
        <img src="<?php echo base_url('upload/system/post_page.png'); ?>" class="imagepreview" style="width: 100%;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
	//aksi posisi
	
	$('body').on('change', '#posisi', function (e) {
		$.ajaxSetup ({
			// Disable caching of AJAX responses
			cache: false
		});
		e.preventDefault();
			var timestamp = Number(new Date()); // current time as number
			var posisi = $(this).val();
			var tampil = 'desktop';
			$.ajax({
				url:'<?php echo url_web('admin/iklan/search_tanggal/') ?>'+timestamp,
				type: 'post',
				cache: false,
				dataType: 'json',
				dataType: 'html',
				data: {
					s_tampil: tampil, s_posisi: posisi
				},
				success: function (msg) {
					$('.form_date_star').datetimepicker('remove');
					$('.form_date_end').datetimepicker('remove');
					$('.form_date_star').datetimepicker({
						update:msg,
						timepicker:false,
						initialDate:msg,
						startDate: msg,
						minDate : 0,
						language:  'id',
						weekStart: 1,
						todayBtn:  false,
						autoclose: 1,
						todayHighlight: false,
						startView: 2,
						minView: 2,
						forceParse: 0,
						linkField: "tanggal-star"
					}).on('changeDate', function(ev) {
						$('.form_date_end').datetimepicker({
							timepicker:false,
							initialDate:ev.date,
							startDate: ev.date,
							minDate : 0,
							language:  'id',
							weekStart: 1,
							todayBtn:  false,
							autoclose: 1,
							todayHighlight: false,
							startView: 2,
							minView: 2,
							forceParse: 0,
							linkField: "tanggal-end"
						});
						//swc($('#jenis').val());
					});
				}
			});
	});
	
 
 $('body').on('click', '.btn-delete-data', function () {
    var idItem = $(this).attr('data-id');
    var title = $(this).attr('data-title');
    var href = $(this).attr('data-href');
	
    swal({
            title: "Are you sure?",
            text: "Your will delete " + title + "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function () {
			swal("Deleted!", "Your data " + title + " has been deleted.", "success");
            $.ajax({
                url: href,
                type: 'post',
                dataType: 'json',
                data: {
                    id: idItem
                }, success: function (msg) {
					
                }
            });
			setTimeout(function () {
				location.reload();
			}, 800);
        });
 }); 
 
	/*Settiig height ketika modal diload untuk media gallery*/
	$('#modalAddMedia').on('show.bs.modal', function () {
		$('.modal-body').css('height', $(window).height() * 0.6);
	});

	/*Settiig height ketika modal diload untuk media gallery*/
	$('#modalAddMedia').on('hidden.bs.modal', function () {
		$(this).removeData('bs.modal');
	});
	
	/*Memilih gambar modal gallery untuk set featured image*/
	$("body").on('click', 'input[type=radio].checkbox-image-list', function () {
		if (this.checked) {
			var id = $(this).attr('data-id');
			var href = $('#btnSetFeaturedImage').attr('data-href');
			$.ajax({
				url: href,
				data: {
					id: id
				},
				type: 'post',
				dataType: 'json',
				cache: false,
				success: function (msg) {
					$('#urlDetailImage').val(msg.url);
					$('#titleDetailImage').val(msg.title);
					$('#imageDetailImage').attr('src', msg.url);
					$('#btnSetFeaturedImage').attr('data-id', msg.id_image);
				}
			});
		}

	});
	
	/*Ketika Button Insert pada media gallery ditekan maka akan memasukkan gambar kedalam Fieture Image*/
	$('body').on('click', '#btnSetFeaturedImage', function () {
		var href = $(this).attr('data-href');
		var val = [];
		$('.checkbox-image-list:checked').each(function (i) {
			val[i] = $(this).attr('data-id');
		});
			/*Jika hanya satu gambar saja*/
			$.ajax({
				url: href,
				data: {
					id: val[0]
				},
				type: 'post',
				dataType: 'json',
				cache: false,
				success: function (msg) {
					$('#imageDetailFieture').attr('src', msg.url);
					$('#image_fitur').val(msg.url);
					$('#id_fitur').val(msg.id);
					$('#modalAddMedia').modal('hide');
				}
			});
		
	});
	
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
			cache: false,
			contentType: false,
			processData: false,
			success: function (data) {
				$('#tabUpload').removeClass('active');
				$('#upload_media').removeClass('active');
				$('#tabMediaLibrary').addClass('active');
				$('#media_library').addClass('active');

				$('#media_library > div ').remove();
				$.get($('#tabMediaLibrary a').attr('href'), function (hasil) {
					$($('#tabMediaLibrary a').attr('data-target')).html(hasil);
				});
			},
			error: function (data) {
			}
		});
	});
	
	/*Ajax content ketika membuka tab media gallery*/
	$('body').on('click', '[data-toggle="tabajax"]', function (e) {
		var $this = $(this),
			loadurl = $this.attr('href'),
			targ = $this.attr('data-target');

		$.get(loadurl, function (data) {
			$(targ).html(data);
		});

		$this.tab('show');
		return false;
	});
 
</script>

<?php $this->load->view('theme/t_footer'); ?>
<!-- /page content -->