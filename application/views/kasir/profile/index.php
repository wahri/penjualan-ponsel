<?php $this->load->view('theme/t_head'); ?>
<?php $this->load->view('theme_kasir/t_sidebar_nav'); ?>
<?php $this->load->view('theme/t_top_nav'); ?>

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><i class="fa fa-user"></i> <?php echo $title; ?></h3>
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
	<?php echo !empty($message) ? $message : ''; ?>
		<div class="col-md-12 col-sm-12 col-xs-12">
		</br>
				<div class="x_content">
					<form class="form-horizontal form-label-left" action="<?php echo url_web('kasir/profile') ?>" method="post" enctype="multipart/form-data">

					  <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">First name <span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
						  <?php echo form_input('first_name',set_value('first_name',$user->first_name),'class="form-control"'); ?>
						  <p class="help-block">Nama pertama pengguna.</p>
						</div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Last name <span class="required">*</span></label>
						  <div class="col-md-6 col-sm-6 col-xs-12">
						  <?php echo form_input('last_name',set_value('last_name',$user->last_name),'class="form-control"'); ?>
						  <p class="help-block">Nama Akhir pengguna.</p>
						  </div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Username <span class="required">*</span></label>
						  <div class="col-md-6 col-sm-6 col-xs-12">
						  <?php echo form_input('username',set_value('username',$user->username),'class="form-control"'); ?>
						  <p class="help-block">digunakan untuk login pengguna.</p>
						  </div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Phone <span class="required">*</span></label>
						  <div class="col-md-6 col-sm-6 col-xs-12">
						  <?php echo form_input('phone',set_value('phone',$user->phone),'class="form-control"'); ?>
						  <p class="help-block">informasi kontak telpon user.</p>
						  </div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
						  <div class="col-md-6 col-sm-6 col-xs-12">
						  <?php echo form_input('email',set_value('email',$user->email),'class="form-control"'); ?>
						  <p class="help-block">informasi email user.</p>
						  </div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span></label>
						  <div class="col-md-6 col-sm-6 col-xs-12">
						  <?php echo form_password('password','','class="form-control"'); ?>
						  <p class="help-block">isikan password untuk pengguna.</p>
						  </div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password <span class="required">*</span></label>
						  <div class="col-md-6 col-sm-6 col-xs-12">
						  <?php echo form_password('password_confirm','','class="form-control"'); ?>
						  <p class="help-block">silahkan ulangi password pengguna.</p>
						  </div>
					  </div>
					  
					  <div class="ln_solid"></div>
					  <div class="form-group">
						<div class="col-md-3 col-sm-3 col-xs-12">
						  <button type="submit" class="btn btn-success">Perbaharui</button>
						</div>
					  </div>
					</form>
					  
				</div>
			
		
		</div>		
	</div>
  </div>
</div>
<?php $this->load->view('theme/t_footer'); ?>
<!-- /page content -->