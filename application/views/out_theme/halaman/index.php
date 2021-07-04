<?php $this->load->view('out_theme/lib/home_head'); ?>
<?php $this->load->view('out_theme/lib/home_menu'); ?>
<div id="mainBody">
	<div class="container">
		<div class="row">
		
			<!-- Sidebar ================================================== -->
				<?php $this->load->view('out_theme/lib/home_sidebar'); ?>
			<!-- Sidebar end=============================================== -->
			
			<div class="span9">	
		
				<?php $this->load->view('out_theme/halaman/content'); ?>
			
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('out_theme/lib/home_footer_menu'); ?>
<?php $this->load->view('out_theme/lib/home_footer'); ?>