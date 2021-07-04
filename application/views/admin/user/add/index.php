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
					<strong>Pesan..!!</strong> <?php echo $this->session->flashdata('success'); ?>
				</div>
			<?php } ?>
			<?php echo !empty($message) ? $message : ''; ?>
			<div class="col-md-4 col-sm-4 col-xs-12">
				</br>
				<div class="x_content">
					<form action="<?php echo url_web('admin/user') ?>" method="post" enctype="multipart/form-data">

						<div class="form-group">
							<label>First name <span class="required">*</span></label>
							<?php echo form_input($first_name); ?>
							<p class="help-block">Nama pertama pengguna.</p>
						</div>
						<div class="form-group">
							<label>Last name <span class="required">*</span></label>
							<?php echo form_input($last_name); ?>
							<p class="help-block">Nama Akhir pengguna.</p>
						</div>
						<div class="form-group">
							<label>Username <span class="required">*</span></label>
							<?php echo form_input($username); ?>
							<p class="help-block">digunakan untuk login pengguna.</p>
						</div>
						<div class="form-group">
							<label>Phone <span class="required">*</span></label>
							<?php echo form_input($phone); ?>
							<p class="help-block">informasi kontak telpon user.</p>
						</div>
						<div class="form-group">
							<label>Email <span class="required">*</span></label>
							<?php echo form_input($email); ?>
							<p class="help-block">informasi email user.</p>
						</div>
						<div class="form-group">
							<label>Group <span class="required">*</span></label>
							<?php
							if (isset($groups)) {
								$mimin = array("admin", "redaktur", "reporter");
								foreach ($groups as $group) {
									if (!in_array($group->name, $mimin)) {
										echo '<div class="radio"><label>';
										echo '<input type="radio" value="' . $group->id . '" id="optionsRadios1" name="groups" required>' . $group->name;
										echo '</label>';
										echo '</div>';
									}
								}
							}
							?>
							<p class="help-block">pilih group pengguna.</p>
						</div>
						<div class="form-group">
							<label>Password <span class="required">*</span></label>
							<?php echo form_password($password); ?>
							<p class="help-block">isikan password untuk pengguna.</p>
						</div>
						<div class="form-group">
							<label>Confirm Password <span class="required">*</span></label>
							<?php echo form_password($password_confirm); ?>
							<p class="help-block">silahkan ulangi password pengguna.</p>
						</div>

						<div class="ln_solid"></div>
						<div class="form-group">
							<button type="submit" class="btn btn-success">Tambah Pengguna Baru</button>
						</div>
					</form>

				</div>


			</div>

			<div class="col-md-8 col-sm-8 col-xs-12">

				<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-left ">
					<div class="row">
						<p>
							<?php echo $jumlah_item; ?> items
							<button type="button" class="btn btn-default btn-sm btn-navigate " data-href="<?php echo url_web('admin/user/page'); ?>" data-value="<?php echo $jumlah_prev; ?>">
								<<</button> <button type="button" id="btnPrev" class="btn btn-default btn-sm btn-navigate " data-href="<?php echo url_web('admin/user/page'); ?>" data-value="<?php echo $btn_prev; ?>">
									<</button> <span id="btn_now_span"><?php echo $jumlah_now; ?></span> dari <?php echo $jumlah_next; ?>
										<input type="hidden" id="btn_now" value="<?php echo $jumlah_next; ?>">
										<button type="button" id="btnNext" class="btn btn-default btn-sm btn-navigate" data-href="<?php echo url_web('admin/user/page'); ?>" data-value="<?php echo $btn_next; ?>">></button>
										<button type="button" id="btnJumlahNext" class="btn btn-default btn-sm btn-navigate" data-href="<?php echo url_web('admin/user/page'); ?>" data-value="<?php echo $jumlah_next; ?>">>></button>
						</p>
					</div>
				</div>

				<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
					<div class="row">
						<div class="input-group">
							<input type="text" id="inputSearchArticle" data-href="<?php echo url_web('admin/user/search'); ?>" class="form-control" placeholder="cari pengguna...">
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
									<th>Group</th>
									<th>Username</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Status</th>
									<th>Setting</th>
								</tr>
							</thead>
							<tbody id="tbodySearch">
								<?php $this->load->view('admin/user/lib/search_table'); ?>
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
	$('#selectAllCheckbox').on('click', function() {
		var checkbox = document.getElementsByName('select-checkbox[]');
		for (var i in checkbox)
			checkbox[i].checked = this.checked;
	});

	/*fungsi Pencarian*/
	$('#inputSearchArticle').on('input', function(event) {
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
			success: function(msg) {
				$('#tbodySearch').html(msg);
			}
		});
	});

	$('body').on('click', '.btn-status', function(e) {
		e.preventDefault();
		var href = $(this).attr('data-href');
		var id = $(this).attr('data-value');
		var status = $(this).attr('data-status');
		$.ajax({
			url: href,
			type: 'post',
			dataType: 'json',
			dataType: 'html',
			data: {
				id: id,
				status: status
			},
			cache: false,
			success: function(msg) {
				$('#tbodySearch').html(msg);
			}
		});
	});

	$('body').on('click', '.btn-navigate', function(e) {
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
				start: page,
				maxpage: maxPage
			},
			cache: false,
			success: function(msg) {
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