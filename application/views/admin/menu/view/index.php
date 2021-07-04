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
					<form action="<?php echo url_web('admin/menu/index/'.$identity_menu) ?>" method="post" enctype="multipart/form-data">

					  <div class="form-group">
						<label>Nama Menu <span class="required">*</span></label>
						  <?php echo form_input($nama_menu); ?>
						  <p class="help-block">Nama ini akan tampil di menu situs Anda.</p>
					  </div>
					  
					  <div class="form-group">
						<label>Induk <span class="required">*</span></label>
						<select class="form-control" name="induk" id="">
							<?php $this->load->view('admin/menu/lib/select_menu'); ?>
						</select>
						<p class="help-block">Buat Hirarki untuk menu anda</p>
					  </div>
					  
					  <div class="form-group">
						<label>Pilih menu dari: <span class="required">*</span></label>
						<div class="radio">
						  <label>
							<input type="radio" name="options_menu" id="optionsRadios1" value="option_kategori">
							Pilih Dari Kategori
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="options_menu" id="optionsRadios1" value="option_kategori_produk">
							Pilih Dari Kategori Produk
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="options_menu" id="optionsRadios1" value="option_halaman">
							Pilih Dari Halaman
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="options_menu" id="optionsRadios1" value="option_url">
							Costume Url
						  </label>
						</div>
						<p class="help-block">Memungkinkan untuk menambah dari halaman dan kategori.</p>
					  </div>
					  
					  <div class="form-group show_kat" style="display:none">
						<label>Kategori <span class="required">*</span></label>
						<select class="form-control" name="url_kategori" id="url_kategori">
							<?php $this->load->view('admin/menu/lib/select_kategori'); ?>
						</select>
						<p class="help-block">Pilih menu dari kategori</p>
					  </div>
					  
					  <div class="form-group show_pro" style="display:none">
						<label>Kategori Produk<span class="required">*</span></label>
						<select class="form-control" name="url_kategori_produk" id="url_kategori_produk">
							<?php $this->load->view('admin/menu/lib/select_kategori_produk'); ?>
						</select>
						<p class="help-block">Pilih menu dari kategori Produk</p>
					  </div>
					  
					  <div class="form-group show_hal" style="display:none">
						<label>Halaman <span class="required">*</span></label>
						<select class="form-control" name="url_halaman" id="url_halaman">
							<?php $this->load->view('admin/menu/lib/select_halaman'); ?>
						</select>
						<p class="help-block">Pilih menu dari kategori</p>
					  </div>
					  
					  <div class="form-group show_url" style="display:none">
						<label>Costume URL <span class="required">*</span></label>
						<?php echo form_input($url_costume); ?>
						<p class="help-block">Masukkan URL costume</p>
					  </div>
					  
					  <div class="form-group">
						<a href="<?php echo url_web('admin/images/modal_fiture_library'); ?>" class="btn btn-default" data-toggle="modal" data-target="#modalAddMedia"><i class="fa fa-file-image-o"></i> Logo Menu</a>
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
							  <img id="imageDetailFieture" src="<?php echo base_url('upload/images/noimage.png'); ?>" alt="">
							  <input id="image_fitur" type="hidden" name="image_fitur" value="" />
							  <input id="id_fitur" type="hidden" name="id_fitur" value="" />
							</div>
					<?php 
						}
					?>
					  
					  <div class="form-group">
						<label>Deskripsi <span class="required">*</span></label>
						  <?php echo form_textarea($deskripsi); ?>
						  <p class="help-block">Deskripsi ini tidak tampil dalam keadaan standar. Namun, beberapa tema akan menampilkannya.</p>
					  </div>
					  
					  <div class="ln_solid"></div>
					  <div class="form-group">
						  <button type="submit" class="btn btn-success">Tambah Menu Baru</button>
					  </div>
					</form>
					  
				</div>
			
		
		</div>
		
		<div class="col-md-8 col-sm-8 col-xs-12">
		

			<div class="input-group">
			  <div class="input-group-btn">
			 <?php
				$arrayKey = $this->costume->searchArrayKeyVal("id", $identity_menu, $identity_link);
					if ($arrayKey!==false) {
						$d_menu = $identity_link[$arrayKey]['mn_nama'];
					}
			?>
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih Menu  <span class="caret"></span></button>
				<ul class="dropdown-menu dropdown-menu-right">
			<?php
				foreach ($identity_link as $parent_menu) { 
					if($parent_menu['id'] == $identity_menu){
						
					}else{
			?>
						<li><a href="<?php echo url_web('admin/menu/index/'.$parent_menu['id']); ?>"><?php echo $parent_menu['mn_nama'] ;?></a></li>
			<?php
					}
				}
			?>
				</ul>
			  </div><!-- /btn-group -->
			  <input type="text" class="form-control" value="<?php echo $d_menu; ?>" aria-label="...">
			</div><!-- /input-group -->

			
			<div class="x_panel">
				<div class="x_content">

					<?php $this->load->view('admin/menu/lib/search_table'); ?>
					
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

$('input:radio[name="options_menu"]').change(function(){
	var cek = $("input:radio[name='options_menu']:checked").val()
	if(cek == 'option_kategori'){
		$(".show_kat").show();
		$(".show_pro").hide();
		$(".show_hal").hide();
		$(".show_url").hide();
		$('#url_costume').attr('value', '');
	}else if(cek == 'option_kategori_produk'){
		$(".show_pro").show();
		$(".show_hal").hide();
		$(".show_kat").hide();
		$(".show_url").hide();
		$('#url_costume').attr('value', '');
	}else if(cek == 'option_halaman'){
		$(".show_hal").show();
		$(".show_kat").hide();
		$(".show_pro").hide();
		$(".show_url").hide();
		$('#url_costume').attr('value', '');
	}else if(cek == 'option_url'){
		$(".show_url").show();
		$(".show_kat").hide();
		$(".show_hal").hide();
		$(".show_pro").hide();
		$('#url_costume').attr('value', '');
	}else{
		$(".show_kat").hide();
		$(".show_hal").hide();
		$(".show_url").hide();
		$(".show_pro").hide();
	}
 });
 
 $('#url_kategori').change(function(){
	 $('#url_costume').attr('value', $(this).val());
 });
 
 $('#url_halaman').change(function(){
	 $('#url_costume').attr('value', $(this).val());
 });
 
 $('#url_kategori_produk').change(function(){
	 $('#url_costume').attr('value', $(this).val());
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