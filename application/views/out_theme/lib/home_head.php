<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
     <title><?php echo !empty($title) ? $title : '';  ?> - <?php echo $website_judul;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo $website_deskripsi;?>"/>
	<meta name="description" content="<?php echo $website_deskripsi;?>">
    <meta name="author" content="">
<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="<?php echo base_url('bootstrap-shop/themes/bootshop/bootstrap.min.css');?>" media="screen"/>
    <link href="<?php echo base_url('bootstrap-shop/themes/css/base.css');?>" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->	
	<link href="<?php echo base_url('bootstrap-shop/themes/css/bootstrap-responsive.min.css');?>" rel="stylesheet"/>
	<link href="<?php echo base_url('bootstrap-shop/themes/css/font-awesome.css');?>" rel="stylesheet" type="text/css">
<!-- Google-code-prettify -->	
	<link href="<?php echo base_url('bootstrap-shop/themes/js/google-code-prettify/prettify.css');?>" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url('upload/icon/favicon.ico'); ?>">
	<!-- sweet allert -->
    <link href="<?php echo base_url('public/sweetalert/sweetalert.css'); ?>" rel="stylesheet">
	<script src="<?php echo base_url('bootstrap-shop/themes/js/jquery.js');?>" type="text/javascript"></script>
	<style type="text/css" id="enject"></style>
  </head>
<body>