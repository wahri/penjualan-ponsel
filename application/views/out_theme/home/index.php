<?php $this->load->view('out_theme/lib/home_head'); ?>
<?php $this->load->view('out_theme/lib/home_menu'); ?>
<?php $this->load->view('out_theme/lib/home_slide'); ?>

<div id="mainBody">
	<div class="container">
		<div class="row">
		
			<!-- Sidebar ================================================== -->
				<?php $this->load->view('out_theme/lib/home_sidebar'); ?>
			<!-- Sidebar end=============================================== -->
			
			<div class="span9">	
		
				<!-- Hot Promo ================================================ -->
					<?php $this->load->view('out_theme/home/promo'); ?>
				<!-- Sidebar end=============================================== -->
					
				<!-- Latest Product =========================================== -->
					<?php $this->load->view('out_theme/home/list_produk'); ?>
				<!-- Sidebar end=============================================== -->

			</div>
		</div>
	</div>
</div>

<?php $this->load->view('out_theme/lib/home_footer_menu'); ?>
<?php $this->load->view('out_theme/lib/home_footer'); ?>