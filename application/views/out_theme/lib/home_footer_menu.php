<!-- Footer ================================================================== -->
	<div  id="footerSection">
	<div class="container">
		<div class="row">
			<div class="span6">
				<div class="box logo-ft">
				<h5>TOKO KAMI</h5>
				<?php 
				if(!empty($website_logo)){
				?>
				  <img src="<?php echo base_url($this->costume->get_original($website_logo,'original')->row()->url); ?>" alt="<?php echo $website_judul; ?>" class="img-responsive" />
				<?php 
				}else{
				?>  
					<img src="<?php echo base_url('upload/system/logo_default.png'); ?>" alt="<?php echo $website_judul; ?>" class="img-responsive" />
				<?php 
				}
				?>
				</div>
				<div class="about">
				   <?php echo $website_deskripsi;?>
				   </br>
				   <?php echo $website_alamat;?>
				</div>
			 </div>
			<div class="span3">
				<h5>INFORMATION</h5>
				<?php
					foreach ($footer_menu as $footer_menu_li) { 
						echo '<a href="'.$footer_menu_li->url_menu.'">'.$footer_menu_li->nama_menu.'</a>';
					}
				?>
			 </div>
			<div id="socialMedia" class="span3 pull-right">
				<h5>SOCIAL MEDIA </h5>
				<a href="#"><img width="60" height="60" src="<?php echo base_url('bootstrap-shop/themes/images/facebook.png'); ?>" title="facebook" alt="facebook"/></a>
				<a href="#"><img width="60" height="60" src="<?php echo base_url('bootstrap-shop/themes/images/twitter.png'); ?>" title="twitter" alt="twitter"/></a>
				<a href="#"><img width="60" height="60" src="<?php echo base_url('bootstrap-shop/themes/images/youtube.png'); ?>" title="youtube" alt="youtube"/></a>
			 </div> 
		 </div>
		<p class="pull-right">&copy; Copyright 2018 <?php echo $website_judul;?></p>
	</div><!-- Container End -->
	</div>