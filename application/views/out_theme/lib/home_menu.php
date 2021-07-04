<div id="header">
<div class="container">
<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
    <a class="brand" href="<?php echo site_url(); ?>"><img src="<?php echo base_url($this->costume->get_original($website_logo,'original')->row()->url); ?>" alt="Bootsshop"/></a>
		<form class="form-inline navbar-search" method="post" action="<?php echo site_url('search_produk') ;?>" >
		<input id="srchFld" name="names" class="srchTxt" type="text" />
		<button type="submit" id="submitButton" name="cari_button" class="btn btn-primary">Go</button>
    </form>
    <ul id="topMenu" class="nav pull-right">
	<?php 
	foreach ($main_menu as $main_menu_list){
		echo '<li class=""><a href="'.site_url($main_menu_list->url_menu).'">'.$main_menu_list->nama_menu.'</a></li>';
		
	}
	?>
	 <li class="">
	 <a href="<?php echo site_url('order'); ?>"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ <span id="update_cart"><?php if($cart_session){echo array_sum($cart_session);} else { echo '0'; } ?></span> ] Itemes in your cart </span> </a> 
	</li>
    </ul>
  </div>
</div>
</div>
</div>
<!-- Header End====================================================================== -->