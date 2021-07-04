<?php $this->load->view('out_theme/lib/home_head'); ?>
<style>
.map-responsive{
    overflow:hidden;
    padding-bottom:56.25%;
    position:relative;
    height:0;
}
.map-responsive iframe{
    left:0;
    top:0;
    height:100%;
    width:100%;
    position:absolute;
}
</style>
<?php $this->load->view('out_theme/lib/home_menu'); ?>
<div id="mainBody">
	<div class="container">
		<div class="row">
		
			<!-- Sidebar ================================================== -->
				<?php $this->load->view('out_theme/lib/home_sidebar'); ?>
			<!-- Sidebar end=============================================== -->
			
			<div class="span9">	
		
				<?php $this->load->view('out_theme/invoice/content'); ?>
			
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('out_theme/lib/home_footer_menu'); ?>
<?php $this->load->view('out_theme/lib/home_footer'); ?>