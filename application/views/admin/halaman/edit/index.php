<?php $this->load->view('theme/t_head'); ?>
<link href="<?php echo base_url('public/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet">
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

<script src="<?php echo base_url('public/admin/tinymce/js/tinymce/tinymce.min.js') ?>"></script>

<script>
        tinyMCE.init({
			selector: "textarea",
			height: 580,
			theme: 'modern',
			plugins: ['paste,codesample,code,link'],
			toolbar1: 'undo redo | styleselect | bold italic link | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | codesample code',
			paste_data_images: true,
			relative_urls : false,
			remove_script_host : true,
			document_base_url : "/",
			convert_urls : true,
		});
</script>

<form class="form-horizontal form-label-left" action="<?php echo url_web('admin/halaman/edit_halaman'); ?>" method="post" enctype="multipart/form-data">
<div class="right_col" role="main">
  <div class="">
  <?php echo !empty($message) ? $message : ''; ?>
	<div class="row">
		<div class="col-xs-12 invoice-header">
			<h1><i class="fa fa-rss"></i> <?php echo $title; ?></h1>
		</div>
	</div>
	
	<div class="x_title"></div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
			<div class="form-group">
				<label for="exampleInputEmail1">Judul Halaman</label>
				<?php echo form_input($judul); ?>
			</div>
			
			<div class="form-group">
                <a href="<?php echo url_web('admin/halaman/modal_image_library'); ?>" class="btn btn-default" data-toggle="modal" data-target="#modalAddMedia"><i class="fa fa-file-image-o"></i> Tambah Media</a>
            </div>
			
			<div class="form-group">
				<?php echo form_textarea($content); ?>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">					
			<div class="x_panel">
                <div class="x_title">
                    <h2>Penerbitan</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="form-group">
						<?php echo form_input($id_halaman); ?>
						<button type="submit" class="btn btn-primary" >Simpan</button>
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
	
<script>
$(document).ready(function() {
	
	/*Settiig height ketika modal diload untuk media gallery*/
	$('#modalAddMedia').on('show.bs.modal', function () {
		$('.modal-body').css('height', $(window).height() * 0.6);
	});
	
	/*Memilih gambar modal gallery untuk add image*/
	$("body").on('click', 'input[type=checkbox].checkbox-image-list', function () {
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
				success: function (msg) {
					$('#urlDetailImage').val(msg.url);
					$('#titleDetailImage').val(msg.title);
					$('#imageDetailImage').attr('src', msg.url);
					//$('#btnDeleteImage').attr('data-title', msg.title);
					//$('#btnDeleteImage').attr('data-id', id);
				}
			});
		}

	});
	
	/*Ketika Button Insert pada media gallery ditekan maka akan memasukkan gambar kedalam text editor*/
	$('body').on('click', '#btnInsertImage', function () {
		var href = $(this).attr('data-href');
		var val = [];
		$('.checkbox-image-list:checked').each(function (i) {
			val[i] = $(this).attr('data-id');
		});

		/*Jika memilih lebih dari satu gambar*/
		if (val.length > 1) {
			var image = '';
			for (var a = 0; a < val.length; a++) {
				$.ajax({
					url: href,
					data: {
						id: val[a]
					},
					type: 'post',
					dataType: 'json',
					success: function (msg) {
						image = "<img style='' src='" + msg.url + "' alt='" + msg.title + "' />"
						tinymce.get('editor').execCommand('mceInsertContent', true, image);
					}
				});
			}

			$('#modalAddMedia').modal('hide');

		} else {
			/*Jika hanya satu gambar saja*/
			$.ajax({
				url: href,
				data: {
					id: val[0]
				},
				type: 'post',
				dataType: 'json',
				success: function (msg) {
					var image = "<img style='' src='" + msg.url + "' alt='" + msg.title + "' />";
					tinymce.get('editor').execCommand('mceInsertContent', true, image);
					$('#modalAddMedia').modal('hide');
				}
			});
		}
	});
	
	/*Ketika sudah memilih gambar yang akan diupload maka otomatis langsung upload*/
	$('body').on('change', '#btnUploadImage', function () {
		$('#formUploadImage').submit();
	});
	
	/*Ketika form upload sudah diupload maka langsung membuka tab gallery*/
	$('body').on('submit', '#formUploadImage', function (e) {
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

		
	});	
</script>

<?php $this->load->view('theme/t_footer'); ?>
<!-- /page content -->