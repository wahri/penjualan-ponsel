<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="title" content="<?php echo !empty($title) ? $title : '';  ?> - <?php echo $website_judul;?>" />
	<meta name="description" content="<?php echo $website_deskripsi;?>" />
	<!-- facebook META -->
	<meta property="fb:pages" 		  content="1779802948999318" />
	<meta property="fb:app_id" 		  content="2301433020081248"/>
	<meta property="og:url"           content="<?php echo current_url(); ?>" />
	<meta property="og:type"          content="article" />
	<meta property="og:title"         content="<?php echo !empty($title) ? $title : '';  ?> - <?php echo $website_judul;?>" />
	<meta property="og:description"   content="<?php echo $og_description;?>" />
	<meta property="og:image"         content="<?php echo $image_og;?>" />
	<meta property="og:site_name" 	  content="<?php echo $website_judul;?>">
	<meta property="article:author"   content="https://www.facebook.com/faktatv" />
	<meta property="article:publisher" content="https://www.facebook.com/faktatv" />
	
	<link rel="shortcut icon" href="<?php echo base_url('assets/icon/favicon.ico'); ?>"/>
    <title><?php echo !empty($title) ? $title : '';  ?> | <?php echo $website_judul;?></title>
	
	<link rel="stylesheet" href="<?php echo base_url('theme/css/normalize.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('theme/css/typography.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('theme/css/fontawesome.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('theme/css/colors.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('public/starrr/dist/starrr.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('public/video-js/src/video-js.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('theme/css/style.css'); ?>">
	
	
	<!-- Responsive -->
	<link rel="stylesheet" media="(max-width:767px)"  href="<?php echo base_url('theme/css/0-responsive.css'); ?>" >
	<link rel="stylesheet" media="(min-width:768px) and (max-width:1024px)" href="<?php echo base_url('theme/css/768-responsive.css'); ?>">
	<link rel="stylesheet" media="(min-width:1025px) and (max-width:1199px)" href="<?php echo base_url('theme/css/1025-responsive.css'); ?>">
	<link rel="stylesheet" media="(min-width:1200px)" href="<?php echo base_url('theme/css/1200-responsive.css'); ?>">
        
	<!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Domine:400,700' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
	<script src="<?php echo base_url('public/starrr/dist/starrr.js'); ?>"></script>
	<script src="<?php echo base_url('public/starrr/src/video.min.js'); ?>"></script>
    
  </head>
  <body>
  <!-- Comment #2: SDK -->
  <div id="fb-root"></div>
  <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '2301433020081248',
      xfbml      : true,
      version    : 'v2.9'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.9&appId=2301433020081248";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
  <!-- Wrapper -->
        <div id="wrapper" class="wide">
            <!-- Header -->
            <header id="header">