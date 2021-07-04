<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo !empty($website_judul) ? $website_judul : '';  ?> </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('public/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('public/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url('assets/css/animate.min.css'); ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets/css/custom.min.css'); ?>" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
		  <?php echo $this->session->flashdata('message'); ?>
              <form action="<?php echo site_url('administrator/login'); ?>" method="post">
              <h1>Login Administrator</h1>
              <div>
                <input type="text" name="identity" class="form-control" placeholder="Email" required>
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
              </div>
              <div>
                <button class="btn btn-default submit" type="Submit">Masuk</button>
                
              </div>

              <div class="clearfix"></div>
			  <?php if (!empty($this->session->flashdata('success'))) { ?>
				  <div class="alert alert-success alert-dismissible fade in" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
						  </button>
						  <strong>Error..!!</strong>  <?php echo $this->session->flashdata('success'); ?>
				  </div>
				<?php } ?>

              <div class="separator">
                <p class="change_link">
                  <a href="<?php echo site_url(); ?>" class="to_register"> Kembali Ke Home </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><?php echo  $website_company; ?></h1>
                  <p><?php echo  $website_copyright; ?></p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
