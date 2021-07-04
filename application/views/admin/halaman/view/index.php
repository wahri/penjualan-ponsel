<?php $this->load->view('theme/t_head'); ?>
<?php $this->load->view('theme_admin/t_sidebar_nav'); ?>
<?php $this->load->view('theme/t_top_nav'); ?>

<div class="right_col" role="main">
  <div class="">
	<div class="row">
		<div class="col-xs-12 invoice-header">
			<h1><i class="fa fa-rss"></i> <?php echo $title; ?> <a href="<?php echo url_web('admin/halaman/add'); ?>" class="btn btn-default submit">+ Tambah Baru</a></h1>
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
    <?php } ?>
	
		<div class="col-md-12 col-sm-12 col-xs-12">
		</br>
			    <div class="x_panel">
                  <div class="x_title">
					<h2>Jumlah Semua (<?php echo $jumlah_semua; ?>)</h2>
                    <ul class="nav navbar-right panel_toolbox">
					  <li><button type="submit" class="btn btn-sm btn-navigate"data-href="<?php echo url_web('admin/halaman/page'); ?>" data-value="<?php echo $jumlah_prev; ?>"> << </button></li>
					  <li><button id="btnPrev" data-href="<?php echo url_web('admin/halaman/page'); ?>" type="submit" class="btn btn-sm btn-navigate" data-value="<?php echo $btn_prev; ?>"> < </button></li>
                      <li><input readonly style="background-color: #fff;text-align: center;" id="btn_now" type="text" class="form-control input-sm " value="<?php echo $jumlah_now; ?>"></li>
					  <li><button id="btnNext" data-href="<?php echo url_web('admin/halaman/page'); ?>" type="submit" class="btn btn-sm btn-navigate"  data-value="<?php echo $btn_next; ?>"> > </button></li>
					  <li><button id="btnJumlahNext" data-href="<?php echo url_web('admin/halaman/page'); ?>" type="submit" class="btn btn-sm btn-navigate" data-value="<?php echo $jumlah_next; ?>"> >> </button></li>
					                       
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table">
                      <thead>
                        <tr>
                          <th>Judul</th>
						  <th>tanggal</th>
						  <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="tbodySearch">
                        <?php $this->load->view('admin/halaman/lib/list_page'); ?>
                      </tbody>
                    </table>
                  </div>
                </div>
		</div>
		
	</div>
  </div>
</div>
<script>
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

</script>

<?php $this->load->view('theme/t_footer'); ?>
<!-- /page content -->