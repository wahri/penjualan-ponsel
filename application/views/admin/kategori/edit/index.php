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
					<form action="<?php echo url_web('admin/kategori/edit/'.$id_cat) ?>" method="post" enctype="multipart/form-data">

					  <div class="form-group">
						<label>Nama Kategori <span class="required">*</span></label>
						  <?php echo form_input($kategori); ?>
						  <p class="help-block">Nama ini mencerminkan bagaimana tampil di situs Anda.</p>
					  </div>
					  <div class="form-group">
						<label>Induk <span class="required">*</span></label>
						<select class="form-control" name="induk" id="">
							<?php $this->load->view('admin/kategori/lib/select'); ?>
						</select>
						<p class="help-block">Kategori, tidak seperti tag, dapat memiliki hierarki. Anda boleh saja memiliki kategori Jazz dan di bawahnya ada kategori anak Bebop dan Big Band. Seluruhnya terserah Anda.</p>
					  </div>
					  <div class="form-group">
						<label>Deskripsi <span class="required">*</span></label>
						  <?php echo form_textarea($deskripsi); ?>
						  <p class="help-block">Deskripsi ini tidak tampil dalam keadaan standar. Namun, beberapa tema akan menampilkannya.</p>
					  </div>
					  <input type="hidden" name="id_cat" value="<?php echo $id_cat;?>">
					  <div class="ln_solid"></div>
					  <div class="form-group">
						  <button type="submit" class="btn btn-success">Ubah Kategori</button>
					  </div>
					</form>
					  
				</div>
			
		
		</div>
		
		<div class="col-md-8 col-sm-8 col-xs-12">

			<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-left ">
				<div class="row">
				<p>
				  <?php echo $jumlah_item; ?> items
				  <button type="button" class="btn btn-default btn-sm btn-navigate " data-href="<?php echo url_web('admin/kategori/page'); ?>" data-value="<?php echo $jumlah_prev; ?>"><<</button>
				  <button type="button" id="btnPrev" class="btn btn-default btn-sm btn-navigate " data-href="<?php echo url_web('admin/kategori/page'); ?>" data-value="<?php echo $btn_prev; ?>"><</button>
				  <span id="btn_now_span"><?php echo $jumlah_now; ?></span> dari <?php echo $jumlah_next; ?>
				  <input type="hidden" id="btn_now" value="<?php echo $jumlah_next; ?>" >
				  <button type="button" id="btnNext" class="btn btn-default btn-sm btn-navigate" data-href="<?php echo url_web('admin/kategori/page'); ?>" data-value="<?php echo $btn_next; ?>" >></button>
				  <button type="button" id="btnJumlahNext" class="btn btn-default btn-sm btn-navigate" data-href="<?php echo url_web('admin/kategori/page'); ?>" data-value="<?php echo $jumlah_next; ?>">>></button>
				</p>
			  </div>
			</div>
			
			<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
				<div class="row">
					<div class="input-group">
						<input type="text" id="inputSearchArticle" data-href="<?php echo url_web('admin/kategori/search'); ?>" class="form-control" placeholder="cari kategori...">
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
								<th>Kategori</th>
								<th>Deskripsi</th>
								<th>Operasi</th>
							</tr>
						</thead>
						<tbody id="tbodySearch">
							<?php $this->load->view('admin/kategori/lib/search_table'); ?>
						</tbody>
					</table>
				</div>
			</div>
                      
		</div>
		
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

</script>

<?php $this->load->view('theme/t_footer'); ?>
<!-- /page content -->