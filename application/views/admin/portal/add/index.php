<?php $this->load->view('theme/t_head'); ?>
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
					<form action="<?php echo url_web('admin/portal') ?>" method="post" enctype="multipart/form-data">

					  <div class="form-group">
						<label>Nama Portal <span class="required">*</span></label>
						  <?php echo form_input($portal); ?>
					  </div>
					  <div class="form-group">
						<a href="<?php echo url_web('admin/images/modal_fiture_library'); ?>" class="btn btn-default" data-toggle="modal" data-target="#modalAddMedia"><i class="fa fa-file-image-o"></i> Logo Menu</a>
						<p class="help-block">Pilih Logo Portal agar lebih di kenal </p>
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
							  <img id="imageDetailFieture" src="<?php echo base_url('upload/images/noimage.png'); ?>" alt="">
							  <input id="image_fitur" type="hidden" name="image_fitur" value="" />
							  <input id="id_fitur" type="hidden" name="id_fitur" value="" />
							</div>
					<?php 
						}
					?>
					  
					  <div class="ln_solid"></div>
					  <div class="form-group">
						  <button type="submit" class="btn btn-success">Tambah Portal Baru</button>
					  </div>
					</form>
					  
				</div>
			
		
		</div>
		
		<div class="col-md-8 col-sm-8 col-xs-12">

			<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-left ">
				<div class="row">
				<p>
				  <?php echo $jumlah_item; ?> items
				  <button type="button" class="btn btn-default btn-sm btn-navigate " data-href="<?php echo url_web('admin/portal/page'); ?>" data-value="<?php echo $jumlah_prev; ?>"><<</button>
				  <button type="button" id="btnPrev" class="btn btn-default btn-sm btn-navigate " data-href="<?php echo url_web('admin/portal/page'); ?>" data-value="<?php echo $btn_prev; ?>"><</button>
				  <span id="btn_now_span"><?php echo $jumlah_now; ?></span> dari <?php echo $jumlah_next; ?>
				  <input type="hidden" id="btn_now" value="<?php echo $jumlah_next; ?>" >
				  <button type="button" id="btnNext" class="btn btn-default btn-sm btn-navigate" data-href="<?php echo url_web('admin/portal/page'); ?>" data-value="<?php echo $btn_next; ?>" >></button>
				  <button type="button" id="btnJumlahNext" class="btn btn-default btn-sm btn-navigate" data-href="<?php echo url_web('admin/portal/page'); ?>" data-value="<?php echo $jumlah_next; ?>">>></button>
				</p>
			  </div>
			</div>
			
			<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
				<div class="row">
					<div class="input-group">
						<input type="text" id="inputSearchArticle" data-href="<?php echo url_web('admin/portal/search'); ?>" class="form-control" placeholder="cari portal...">
						<span class="input-group-btn">
						  <button class="btn btn-default active" type="button">Go!</button>
						</span>
					  </div>
				</div>
			</div>
			
			<div class="x_panel">
				<div class="x_content">
					<table class="table">
						<thead>
							<tr>
								<th><input type="checkbox" id="selectAllCheckbox" value="option1" aria-label="..."></th>
								<th>Logo</th>
								<th>Portal</th>
								<th>Operasi</th>
							</tr>
						</thead>
						<tbody id="tbodySearch">
							<?php $this->load->view('admin/portal/lib/search_table'); ?>
						</tbody>
					</table>
				</div>
			</div>
                      
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
<script>
/*Membuat semua checklist*/
$('#selectAllCheckbox').on('click', function () {
    var checkbox = document.getElementsByName('select-checkbox[]');
    for (var i in checkbox)
        checkbox[i].checked = this.checked;
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
            $('#tbodySearch').html(msg);
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
				$('#tbodySearch').html(msg.view);
				$('#btnNext').attr('data-value', msg.btn_next);
				$('#btnPrev').attr('data-value', msg.btn_prev);
				$('#btn_now').attr('value', msg.btn_now);
				$('#btn_now_span').html(msg.btn_now);

			}
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