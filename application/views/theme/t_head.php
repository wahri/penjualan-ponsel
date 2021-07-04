<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="title" content="<?php echo !empty($title) ? $title : '';  ?> - <?php echo $website_judul;?>" />
	<meta name="description" content="<?php echo $website_deskripsi;?>" />

    <title><?php echo !empty($title) ? $title : '';  ?> | <?php echo $website_judul;?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('public/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('public/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('public/iCheck/skins/flat/green.css'); ?>" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url('public/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css'); ?>" rel="stylesheet">
    <!-- sweet allert -->
    <link href="<?php echo base_url('public/sweetalert/sweetalert.css'); ?>" rel="stylesheet">
    <!-- jVectorMap -->
    <link href="<?php echo base_url('assets/css/maps/jquery-jvectormap-2.0.3.css'); ?>" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets/css/custom.css'); ?>" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?php echo base_url('public/jquery/dist/jquery.min.js'); ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('public/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('public/fastclick/lib/fastclick.js'); ?>"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url('public/nprogress/nprogress.js'); ?>"></script>
    
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url('public/bootstrap-progressbar/bootstrap-progressbar.min.js'); ?>"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('public/iCheck/icheck.min.js'); ?>"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url('public/skycons/skycons.js'); ?>"></script>
    
    <script src="<?php echo base_url('public/sweetalert/sweetalert.min.js'); ?>"></script>
    
  </head>
