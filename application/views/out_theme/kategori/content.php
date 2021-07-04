
	<ul class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>">Home</a> <span class="divider">/</span></li>
		<li class="active">Kategori</li>
	</ul>
	<h4><?php echo $title; ?> <small class="pull-right"> <?php echo $result_count; ?></small></h4>
	<hr class="soft"/>
	
	
	<br class="clr"/>
	<div class="tab-content">
		<div class="tab-pane  active" id="blockView">
			<ul class="thumbnails">
			
			<?php 
				foreach($produk_list as $latest_produk_list){
			?>
				<li class="span3">
				  <div class="thumbnail">
					<a  href="<?php echo base_url($latest_produk_list->url_produk); ?>"><img src="<?php echo base_url($this->costume->get_thumbnail($latest_produk_list->gambar_utama,'200x200')->row()->url); ?>" alt=""/></a>
					<div class="caption">
						<h5><?php echo get_content_excerpt($latest_produk_list->nama_produk, 70); ?></h5>
						<p>Rp <?php echo get_harga($latest_produk_list->harga); ?></p>
					</div>
				  </div>
				</li>
			<?php
				}
			?>
				
			</ul>
			<hr class="soft"/>
		</div>
	</div>
	
	<div class="pagination">
		<?php 
			echo $this->pagination->create_links();
		?>
	</div>
	<br class="clr"/>
