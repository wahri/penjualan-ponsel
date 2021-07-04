<?php $this->load->view('theme/t_head'); ?>
<link href="<?php echo base_url('public/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('public/starrr/dist/starrr.css'); ?>" rel="stylesheet">
<?php $this->load->view('theme_admin/t_sidebar_nav'); ?>
<?php $this->load->view('theme/t_top_nav'); ?>
<style>
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

	:checked+label.select_image {
		border-color: #3c8dbc;
		/* background: #3c8dbc; */
	}

	:checked+label.select_image:before {
		content: "✔";
		background-color: #3c8dbc;
		transform: scale(1);
	}

	:checked+label.select_image img {
		transform: scale(0.9);
		box-shadow: 0 0 5px #3c8dbc;
		z-index: -1;
	}

	.caption {
		border-color: #3c8dbc;
		/* background: #3c8dbc; */
	}

	.caption:before {
		content: "✔";
		background-color: #3c8dbc;
		transform: scale(1);
	}

	.caption img {
		transform: scale(0.9);
		box-shadow: 0 0 5px #3c8dbc;
		z-index: -1;
	}

	.form-controli-feedback {
		margin-top: 8px;
		height: 23px;
		color: #bbb;
		line-height: 20px;
		font-size: 15px;
	}

	.form-controli-feedback.left {
		border-right: 1px solid #ccc;
		left: 12px;
	}

	.form-control.has-feedbacki-left {
		padding-left: 45px;
	}

	.has-feedbacki .form-control {
		padding-right: 42.5px;
	}

	.form-controli-feedback {
		position: absolute;
		top: 0;
		right: 0;
		z-index: 2;
		display: block;
		width: 34px;
		text-align: center;
		pointer-events: none;
	}
</style>

<script src="<?php echo base_url('public/admin/tinymce/js/tinymce/tinymce.min.js') ?>"></script>

<script>
	tinyMCE.init({
		selector: "textarea",
		height: 300,
		theme: 'modern',
		plugins: ['paste,codesample,code,link'],
		toolbar1: 'undo redo | styleselect | bold italic link | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | codesample code',
		paste_data_images: true,
		relative_urls: false,
		remove_script_host: true,
		document_base_url: "/",
		convert_urls: true,
	});
</script>

<form class="form-horizontal form-label-left" action="<?php echo url_web('admin/produk/add_produk'); ?>" method="post" enctype="multipart/form-data">
	<div class="right_col" role="main">
		<div class="">
			<?php echo !empty($message) ? $message : ''; ?>
			<div class="row">
				<div class="col-xs-12 invoice-header">
					<h1><i class="fa fa-globe"></i> <?php echo $title; ?></h1>
				</div>
			</div>

			<div class="x_title"></div>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="x_panel">
						<div class="x_title">
							<h2><i class="fa fa-cube"></i> Apa yang anda jual?</h2>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div class="form-group">
								<label for="exampleInputEmail1" class="col-md-2 control-label">Nama Produk</label>
								<div class="col-md-10">
									<?php echo form_input($nama_produk); ?>
									<p class="help-block">Isi judul produk sesuai dengan produk yang akan diinput</p>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1" class="col-md-2 control-label">Kategori</label>
								<div class="col-md-3">
									<select data-href="<?php echo url_web('admin/produk/search_category'); ?>" class="form-control" name="kat1" id="kat1">
										<?php $this->load->view('admin/produk/lib/list_kategori'); ?>
									</select>
								</div>
								<div class="col-md-3 list_kategori_dua" style="display:none">
									<select data-href="<?php echo url_web('admin/produk/search_category'); ?>" class="form-control" name="kat2" id="kat2">

									</select>
								</div>
								<div class="col-md-3 list_kategori_tiga" style="display:none">
									<select class="form-control" name="kat3" id="kat3">

									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1" class="col-md-2 control-label">Merek</label>
								<div class="col-md-3">
									<select class="form-control" name="merek" id="merek">
										<option value="0">-- Pilih Merek --</option>
										<?php
										foreach ($merek as $merek_ven) {
											echo '<option value="' . $merek_ven->id . '">' . $merek_ven->merek . '</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1" class="col-md-2 control-label">Type</label>
								<div class="col-md-3 form-group">
									<?php echo form_input($type_produk); ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="x_panel">
						<div class="x_title">
							<h2><i class="fa fa-area-chart"></i> Gambar Produk</h2>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<input type="hidden" id="imageThumb" name="image_thumb" value="<?php echo !empty($image_thumb) ? $image_thumb : ''; ?>" />
							<div class="clearfix"></div>
							<div id="imageItemBox">
								<?php $this->load->view('admin/produk/lib/image_produk'); ?>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="x_panel">
						<div class="x_title">
							<h2><i class="fa fa-puzzle-piece"></i> Detil Produk</h2>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div class="form-group">
								<label for="exampleInputEmail1" class="col-md-2 control-label">Harga</label>
								<div class="col-md-3 form-group has-feedback">
									<?php echo form_input($harga_produk); ?>
									<span class="form-controli-feedback left" aria-hidden="true">Rp.</span>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1" class="col-md-2 control-label">Berat</label>
								<div class="col-md-2 form-group has-feedback">
									<?php echo form_input($berat_produk); ?>
									<span class="form-control-feedback right" aria-hidden="true"> gram</span>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1" class="col-md-2 control-label">Status</label>
								<div class="col-md-4">
									<select class="form-control" name="status" required>
										<option>-Pilihan-</option>
										<option value="1" <?php if ($status_produk == 1) {
																echo 'selected';
															} ?>>dijual</option>
										<option value="0" <?php if ($status_produk == 0) {
																echo 'selected';
															} ?>>Tidak dijual</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1" class="col-md-2 control-label">Stok</label>
								<div class="col-md-4">
									<?php echo form_input($stok_produk); ?>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1" class="col-md-2 control-label">Kondisi Produk</label>
								<div class="col-md-4">
									<select class="form-control" name="kondisi" required>
										<option>-Pilihan-</option>
										<option value="Baru" <?php if ($kondisi_produk == 'Baru') {
																	echo 'selected';
																} ?>>Baru</option>
										<option value="Bekas" <?php if ($kondisi_produk == 'Bekas') {
																	echo 'selected';
																} ?>>Bekas</option>
										<option value="Rekondisi" <?php if ($kondisi_produk == 'Rekondisi') {
																		echo 'selected';
																	} ?>>Rekondisi</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1" class="col-md-2 control-label">Estalase</label>
								<div class="col-md-4">
									<select class="form-control" name="estalase">
										<option>-Pilihan-</option>
										<?php
										if (isset($estalase)) {
											foreach ($estalase as $estalase_group) {
										?>
												<option value='<?php echo $estalase_group->id; ?>' <?php if ($estalase_produk == $estalase_group->id) {
																										echo 'selected';
																									} ?>><?php echo $estalase_group->estalase; ?></option>
										<?php
											}
										}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="x_panel">
						<div class="x_title">
							<h2><i class="fa fa-truck"></i> Portal Penjualan</h2>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<?php
							if (isset($portal)) {
								foreach ($portal as $group) {
							?>
									<div class="form-group">
										<label class="col-sm-2 control-label"></label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="<?php echo $group->portal; ?>" placeholder="URL <?php echo $group->portal; ?>">
										</div>
										<div class="col-sm-4">
											<img src="<?php echo base_url($this->costume->get_original($group->gambar, 'original')->row()->url); ?>" height="30" alt=""></img>
										</div>
									</div>
							<?php
								}
							}
							?>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="x_panel">
						<div class="x_title">
							<h2><i class="fa fa-flag"></i> Deskripsi Produk</h2>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div class="form-group">
								<label for="exampleInputEmail1" class="col-lg-2 control-label">Deskripsi Produk</label>
								<div class="col-lg-10">
									<?php echo form_textarea($editor); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><img src="<?php echo base_url('upload/system/youtube-logo.jpg'); ?>" height="25" alt=""></img></label>
								<div class="col-sm-4">
									<?php echo form_input($id_video); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2">Promo</label>
								<div class="col-md-9 col-sm-9">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="promo" value="1" <?php if (!empty($tampil_utama)) {
																								echo "checked";
																							} ?>>
											Tampilkan di promo produk
										</label>
									</div>
								</div>
							</div>

						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<a href="<?php echo url_web('admin/produk'); ?>" type="button" class="btn btn-primary">Batal</a>
							<button type="submit" class="btn btn-success">Simpan</button>
						</div>
					</div>
				</div>
			</div>
		</div>

</form>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAddMedia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

		</div>
	</div>
</div>

<script src="<?php echo base_url('public/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script src="<?php echo base_url('public/bootstrap-datetimepicker-master/js/locales/bootstrap-datetimepicker.id.js'); ?>"></script>
<script src="<?php echo base_url('public/jquery.tagsinput/src/jquery.tagsinput.js'); ?>"></script>
<script src="<?php echo base_url('public/starrr/dist/starrr.js'); ?>"></script>
<script>
	$(document).ready(function() {

		$('#kat1').on('change', function() {
			$('.list_kategori_dua').hide();
			$('.list_kategori_tiga').hide();
			var url = $(this).attr('data-href');
			var category = $(this).val();
			if (category != '') {
				$.ajax({
					url: url,
					type: 'post',
					dataType: 'json',
					dataType: 'html',
					data: {
						category: category
					},
					success: function(msg) {
						if (msg == "") {
							$('.list_kategori_dua').hide();
						} else {
							$('.list_kategori_dua').show();
							$('#kat2').html(msg);
						}
					}
				});

			}
		});
		$('#kat2').on('change', function() {
			$('.list_kategori_tiga').hide();
			var url = $(this).attr('data-href');
			var category = $(this).val();
			if (category != '') {
				$.ajax({
					url: url,
					type: 'post',
					dataType: 'json',
					dataType: 'html',
					data: {
						category: category
					},
					success: function(msg) {
						if (msg == "") {
							$('.list_kategori_tiga').hide();
						} else {
							$('.list_kategori_tiga').show();
							$('#kat3').html(msg);
						}
					}
				});

			}
		});

		/*Settiig height ketika modal diload untuk media gallery*/
		$('#modalAddMedia').on('show.bs.modal', function() {
			$('.modal-body').css('height', $(window).height() * 0.6);
		});

		/*Settiig height ketika modal diload untuk media gallery*/
		$('#modalAddMedia').on('hidden.bs.modal', function() {
			$(this).removeData('bs.modal');
		});

		/*Memilih gambar modal gallery untuk set featured image*/
		$("body").on('click', 'input[type=radio].checkbox-image-list', function() {
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
					success: function(msg) {
						$('#urlDetailImage').val(msg.url);
						$('#titleDetailImage').val(msg.title);
						$('#imageDetailImage').attr('src', msg.url);
						$('#btnSetFeaturedImage').attr('data-id', msg.id_image);
					}
				});
			}

		});

		/*Add image Item*/
		$('body').on('click', '#btnSetFeaturedImage', function() {
			var id_image = $('input[name="input_radio"]:checked').attr('data-id');
			var url = $(this).attr('data-href');
			var target = $(this).attr('data-box-id');
			$.ajax({
				url: url,
				type: 'post',
				dataType: 'json',
				data: {
					id: id_image
				},
				success: function(msg) {
					$('#addImageItem-' + target).attr('src', msg.url);
					$('#btnImageItem-' + target).attr('data-id', msg.id_image);

					var images = '<input type="hidden" name="images[]" value="' + msg.id_image + '">';

					$('#inputHiddenImage-' + target).val(msg.id_image);

					$('#modalAddMedia').modal('hide');
				}
			});
		});

		/*Set main image item*/
		$('body').on('click', '.btn-set-main-image', function() {
			var id_image = $(this).attr('data-id');
			$(".box-add-image-item").removeClass("caption");
			$("#addImageItem-" + id_image).addClass("caption");
			$('#imageThumb').val(id_image);
		});

	});

	var $s2input = $('#star2_input');
	$('#star2').starrr({
		max: 5,
		rating: $s2input.val(),
		change: function(e, value) {
			$s2input.val(value).trigger('input');
		}
	});

	/*Ketika sudah memilih gambar yang akan diupload maka otomatis langsung upload*/
	$('body').on('change', '#btnUploadFitur', function() {
		$('#formUploadFitur').submit();
	});

	/*Ketika form upload sudah diupload maka langsung membuka tab gallery*/
	$('body').on('submit', '#formUploadFitur', function(e) {
		e.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data) {
				$('#tabUpload').removeClass('active');
				$('#upload_media').removeClass('active');
				$('#tabMediaLibrary').addClass('active');
				$('#media_library').addClass('active');

				$('#media_library > div ').remove();
				$.get($('#tabMediaLibrary a').attr('href'), function(hasil) {
					$($('#tabMediaLibrary a').attr('data-target')).html(hasil);
				});
			},
			error: function(data) {}
		});
	});


	/*Add image Item*/
	$('body').on('click', '#btnAddImageItem', function() {
		var href = $(this).attr('data-href');
		var batasPilih = $(this).attr('data-batas-pilih');
		var type = $(this).attr('data-type');
		var boxImage = $('.box-image-item').length;

		if (boxImage != 0) {
			batasPilih = 5 - boxImage;
		}
		var val = [];
		$('.checkbox-item-image-list:checked').each(function(i) {
			val[i] = $(this).attr('data-id');
		});
		if (val.length <= batasPilih) {
			$.ajax({
				url: href,
				type: 'post',
				dataType: 'json',
				data: {
					id: val,
					type: type
				},
				success: function(msg) {
					if (msg.type == 'replace') {
						$('#imageItemBox').html(msg.view);
					} else {
						$('.btn-add-image-item-box').remove();
						$('#imageItemBox').append(msg.view);
					}

					var boxImage = $('.box-image-item').length;
					if (parseInt(boxImage) == 5) {
						$('.btn-add-image-item-box').hide();
					}
					$('#modalAddMedia').modal('hide');
				}
			});
		} else {
			swal("Opps", "Maximal gambar adalah " + batasPilih, 'error');
		}

	});

	function get_count_image_item() {
		var count = $('.box-image-item').length;
		return count;
	}

	/*Memilih gambar modal gallery untuk add image*/
	$("body").on('click', 'input[type=checkbox].checkbox-item-image-list', function() {
		if (this.checked) {
			var id = $(this).attr('data-id');
			var href = $(this).attr('data-href');
			$.ajax({
				url: href,
				data: {
					id: id
				},
				type: 'post',
				dataType: 'json',
				success: function(msg) {
					$('#urlDetailImage').val(msg.url);
					$('#titleDetailImage').val(msg.title);
					$('#imageDetailImage').attr('src', msg.url);
				}
			});
		}

	});

	/*Set main image item*/
	$('body').on('click', '.btn-set-main-image', function() {
		var id_image = $(this).attr('data-id');
		$('.btn-set-main-image').removeClass('disabled');
		$(this).addClass('disabled');
		$('#imageThumb').val(id_image);
	});

	$('body').on('click', '.btn-delete-image-item', function() {
		var boxId = $(this).attr('data-box');
		var Id = $(this).attr('data-id');
		var imageThumb = $('#imageThumb').val();

		if (parseInt(Id) == parseInt(imageThumb)) {

			$('#imageThumb').val('');
		}
		$('.btn-add-image-item-box').show();
		$('#' + boxId).remove();
	});
</script>
<!-- jQuery Tags Input -->
<script>
	function onAddTag(tag) {
		alert("Added a tag: " + tag);
	}

	function onRemoveTag(tag) {
		alert("Removed a tag: " + tag);
	}

	function onChangeTag(input, tag) {
		alert("Changed a tag: " + tag);
	}

	$(document).ready(function() {
		$('#tags_1').tagsInput({
			width: 'auto'
		});
	});
</script>

<?php $this->load->view('theme/t_footer'); ?>
<!-- /page content -->