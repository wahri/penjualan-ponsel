<?php $this->load->view('theme/t_head'); ?>
<?php $this->load->view('theme_admin/t_sidebar_nav'); ?>
<?php $this->load->view('theme/t_top_nav'); ?>

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
					<form action="<?php echo url_web('admin/menu') ?>" method="post" enctype="multipart/form-data">

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
					  
					  <div class="form-group show_hal" style="display:none">
						<label>Halaman <span class="required">*</span></label>
						<select class="form-control" name="url_halaman" id="url_halaman">
							<?php $this->load->view('admin/menu/lib/select_halaman'); ?>
						</select>
						<p class="help-block">Pilih menu dari kategori</p>
					  </div>
					  
					  <div class="form-group show_url" style="display:none">
						<label>Costume URL <span class="required">*</span></label>
						<input type="text" name="url_costume" id="url_costume" value="" class="form-control" />
						<p class="help-block">Masukkan URL costume</p>
					  </div>
					  
					  <div class="form-group">
						<a href="<?php echo url_web('admin/berita/modal_fiture_library'); ?>" class="btn btn-default" data-toggle="modal" data-target="#modalAddMedia"><i class="fa fa-file-image-o"></i> Tambah Gambar Utama</a>
					</div>
					  
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
<script>

$('input:radio[name="options_menu"]').change(function(){
	var cek = $("input:radio[name='options_menu']:checked").val()
	if(cek == 'option_kategori'){
		$(".show_kat").show();
		$(".show_hal").hide();
		$(".show_url").hide();
		$('#url_costume').attr('value', '');
	}else if(cek == 'option_halaman'){
		$(".show_hal").show();
		$(".show_kat").hide();
		$(".show_url").hide();
		$('#url_costume').attr('value', '');
	}else if(cek == 'option_url'){
		$(".show_url").show();
		$(".show_kat").hide();
		$(".show_hal").hide();
		$('#url_costume').attr('value', '');
	}else{
		$(".show_kat").hide();
		$(".show_hal").hide();
		$(".show_url").hide();
	}
 });
 
 $('#url_kategori').change(function(){
	 $('#url_costume').attr('value', $(this).val());
 });
 
 $('#url_halaman').change(function(){
	 $('#url_costume').attr('value', $(this).val());
 });
 
</script>

<?php $this->load->view('theme/t_footer'); ?>
<!-- /page content -->