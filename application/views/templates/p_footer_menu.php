<footer>
		
		<div class="sub-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						&copy; Fakta Media Group. All Rights Reserved.
                        <!-- <div class="credits">
                            <!-- 
                                All the links in the footer should remain intact. 
                                You can delete the links only if you purchased the pro version.
                                Licensing information: https://bootstrapmade.com/license/
                                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Multi
                            -->
                        <!--     <a href="https://bootstrapmade.com/">Bootstrap Themes</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                        </div> -->
					</div>
					<div class="col-md-6">
						<ul class="pull-right">
							<li><a href="<?php echo site_url(); ?>">Home</a></li>
								<?php
									foreach ($main_menu as $parent_menu) { 
										echo '<li><a href="'.site_url($parent_menu->url_menu).'">'.$parent_menu->nama_menu.'</a></li>';
									}
								?>	
						</ul>
					</div>
				</div>
				<div class="pull-right">
					<a href="#home" class="scrollup"><i class="fa fa-angle-up fa-3x"></i></a>
				</div>
			</div>
		</div>		
	</footer>