	<div id="sidebar" class="span3">
		
		<ul id="sideManu" class="nav nav-tabs nav-stacked">
		<?php
				foreach ($produk_kategori as $cat_menu_li) { 
					$childit = $this->costume->get_child_kategory_product($cat_menu_li->id);
					
					if(!empty($childit)){
						echo '<li class="subMenu open"><a> '.$cat_menu_li->category.'</a><ul>';
						foreach ($childit as $childit_li) {
							echo '<li><a href="'.site_url($childit_li->url_category).'"><i class="icon-chevron-right"></i>'.$childit_li->category.'</a></li>';
						}
						echo '</ul> </li>';
					}else{
						if($cat_menu_li->id == 1){
							
						}else{
							echo '<li><a href="'.site_url($cat_menu_li->url_category).'">'.$cat_menu_li->category.'</a></li>';
						}
					}
					
				}
		?>
		</ul>
	</div>
	