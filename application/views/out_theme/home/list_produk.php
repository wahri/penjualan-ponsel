<h4>Latest Products </h4>
  <ul class="thumbnails">
	<?php 
		foreach($latest_produk as $latest_produk_list){
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