	<div class="td-container">	
		<nav class="navbar navbar-default navbar-static-top" role="navigation">
			<div class="navigation">
				<div class="td-container">					
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse.collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div class="navbar-brand">
							<a href="<?php echo site_url(); ?>"><span><img src="<?php echo base_url('upload/profile/logo.png'); ?>" alt=""/></span></a>
						</div>
					</div>
					
					<div class="navbar-collapse collapse">							
						<div class="menu">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation"><a href="<?php echo site_url(); ?>">Home</a></li>
								<?php
									foreach ($main_menu as $parent_menu) { 
										echo '<li role="presentation"><a href="'.site_url($parent_menu->url_menu).'">'.$parent_menu->nama_menu.'</a></li>';
									}
								?>				
							</ul>
						</div>
					</div>						
				</div>
			</div>	
		</nav>		
	</div>	